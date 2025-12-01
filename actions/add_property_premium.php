<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Add Property as Premium Seller &mdash; EstateConnect</title>
    <link rel="stylesheet" href="../css/style.css" />
    <style>
      .site-section { padding-top: 100px; }
      video { background:#000; max-width:100%; }
      .rec-controls { gap:8px; }
    </style>
  </head>
  <body>
    <nav class="site-nav">
      <div class="container">
        <div class="menu-bg-wrap">
          <div class="site-navigation">
            <a href="../index.php" class="logo m-0 float-start">EstateConnect</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="site-section">
      <div class="container">
        <?php if (!empty($_SESSION['property_error'])): ?>
          <div class="alert alert-danger"><?php echo htmlspecialchars($_SESSION['property_error']); unset($_SESSION['property_error']); ?></div>
        <?php endif; ?>
        <div class="row">
          <div class="col-md-8 mx-auto">
            <h3 class="mb-3">Premium Seller Flow</h3>
            <div id="summary" class="bg-light p-3 mb-3 shadow-sm">
              <strong>Property summary will appear here.</strong>
              <div id="summaryBody" class="mt-2"></div>
            </div>

            <form id="premiumForm" class="bg-light p-3 shadow-sm" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="premium_id" class="form-label">Premium Seller ID</label>
                <input type="text" id="premium_id" name="premium_id" class="form-control" placeholder="Enter your premium seller ID (any value)" required>
                <div class="form-text">No verification is required at this demo stage.</div>
              </div>

              <div class="mb-3">
                <label for="images" class="form-label">Re-upload Images (optional)</label>
                <input type="file" id="images" name="images[]" accept="image/*" multiple class="form-control">
              </div>

              <div class="mb-3">
                <label class="form-label">Record Property Video</label>
                <div class="mb-2">
                  <video id="preview" playsinline muted></video>
                </div>
                <div class="d-flex rec-controls">
                  <button type="button" id="startRec" class="btn btn-success">Start</button>
                  <button type="button" id="stopRec" class="btn btn-danger" disabled>Stop</button>
                  <a id="downloadLink" class="btn btn-outline-secondary" style="display:none;">Download</a>
                </div>
                <small class="form-text text-muted">Recorded video will be uploaded with the property.</small>
              </div>

              <div class="text-end">
                <button type="submit" class="btn btn-primary">Add Property</button>
                <a href="add_property.php" class="btn btn-secondary">Back</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      // Load saved form data from localStorage
      const pendingRaw = localStorage.getItem('pending_property');
      if (!pendingRaw) {
        // nothing to do - redirect back to the add form
        window.location.href = 'add_property.php';
      }
      const pending = pendingRaw ? JSON.parse(pendingRaw) : {};
      const summaryBody = document.getElementById('summaryBody');
      summaryBody.innerHTML = `
        <div><strong>Title:</strong> ${escapeHtml(pending.title || '')}</div>
        <div><strong>Type:</strong> ${escapeHtml(pending.type || '')} • <strong>Price:</strong> ${escapeHtml(pending.price || '')}</div>
        <div><strong>Location:</strong> ${escapeHtml(pending.location || '')}</div>
        <div class="mt-2"><strong>Description:</strong><div>${escapeHtml(pending.description || '')}</div></div>
      `;

      function escapeHtml(s){ return String(s).replace(/[&<>\"']/g, function(m){ return {'&':'&amp;','<':'&lt;','>':'&gt;','\"':'&quot;',"'":"&#39;"}[m]; }); }

      // Video recorder setup
      let mediaStream = null;
      let mediaRecorder = null;
      let recordedChunks = [];
      const preview = document.getElementById('preview');
      const startRec = document.getElementById('startRec');
      const stopRec = document.getElementById('stopRec');
      const downloadLink = document.getElementById('downloadLink');

      startRec.addEventListener('click', async function(){
        try {
          mediaStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });
          preview.srcObject = mediaStream;
          preview.play().catch(()=>{});
          recordedChunks = [];
          mediaRecorder = new MediaRecorder(mediaStream, { mimeType: 'video/webm;codecs=vp8,opus' });
          mediaRecorder.ondataavailable = function(e){ if(e.data && e.data.size) recordedChunks.push(e.data); };
          mediaRecorder.onstop = function(){
            const blob = new Blob(recordedChunks, { type: 'video/webm' });
            const url = URL.createObjectURL(blob);
            downloadLink.href = url;
            downloadLink.download = 'property_video.webm';
            downloadLink.style.display = 'inline-block';
            // show playback in the preview element
            preview.srcObject = null;
            preview.src = url;
            preview.controls = true;
            preview.play().catch(()=>{});
            // store blob for submission
            preview._recordedBlob = blob;
          };
          mediaRecorder.start();
          startRec.disabled = true; stopRec.disabled = false;
        } catch(err){
          alert('Could not access camera/microphone: ' + err.message);
        }
      });

      stopRec.addEventListener('click', function(){
        if (mediaRecorder && mediaRecorder.state !== 'inactive') mediaRecorder.stop();
        if (mediaStream) {
          mediaStream.getTracks().forEach(t=>t.stop());
          mediaStream = null;
        }
        startRec.disabled = false; stopRec.disabled = true;
      });

      // Submit handler: send pending data + premium id + images + video
      const form = document.getElementById('premiumForm');
      form.addEventListener('submit', async function(e){
        e.preventDefault();
        const premiumId = document.getElementById('premium_id').value.trim();
        if (!premiumId) { alert('Please enter your Premium Seller ID'); return; }
        const fd = new FormData();
        // append saved fields
        fd.append('title', pending.title || '');
        fd.append('description', pending.description || '');
        fd.append('type', pending.type || '');
        fd.append('price', pending.price || '');
        fd.append('location', pending.location || '');
        fd.append('beds', pending.beds || '');
        fd.append('baths', pending.baths || '');
        fd.append('area', pending.area || '');
        fd.append('amenities', pending.amenities || '');
        fd.append('availability', pending.availability || '');
        fd.append('premium_id', premiumId);

        // append images from file input
        const imagesInput = document.getElementById('images');
        if (imagesInput && imagesInput.files.length) {
          Array.from(imagesInput.files).forEach((f, i)=> fd.append('images[]', f));
        }

        // append recorded video blob if present
        const recordedBlob = preview._recordedBlob;
        if (recordedBlob) {
          fd.append('video', recordedBlob, 'property_video.webm');
        }

        // Send to server endpoint
        try {
          const resp = await fetch('submit_premium_property.php', { method: 'POST', body: fd });
          if (!resp.ok) throw new Error('Server returned ' + resp.status);
          // on success, clear pending and navigate to properties page where server will show a message
          localStorage.removeItem('pending_property');
          window.location.href = '../properties.php';
        } catch (err) {
          console.error(err);
          alert('Submission failed: ' + err.message);
        }
      });
    </script>
  </body>
</html>
