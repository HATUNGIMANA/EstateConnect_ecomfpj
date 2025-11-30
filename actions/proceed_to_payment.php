<?php
session_start();
// If cart empty, redirect back to cart
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        header('Location: ../cart.php');
        exit;
}

// compute total for display (optional)
$total = 0;
foreach ($_SESSION['cart'] as $it) {
        $total += ($it['price'] ?? 0) * ($it['qty'] ?? 1);
}

$payUrl = 'https://paystack.shop/pay/zrgh3i5fef';

// Return a small page that opens the Paystack page in a popup window (so main page stays)
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
        <title>Proceed to Payment</title>
        <style>body{font-family:Arial,Helvetica,sans-serif;padding:20px}</style>
    </head>
    <body>
        <h3>Opening payment window...</h3>
        <p>Total: <?php echo number_format($total,2); ?></p>
        <p>If a popup blocker prevents the payment window from opening, use the fallback link below.</p>
        <p><a id="fallback" href="<?php echo htmlspecialchars($payUrl); ?>" target="_blank">Open payment in new window</a></p>

        <script>
            (function(){
                var payUrl = <?php echo json_encode($payUrl); ?>;
                // Create an anchor with target _blank and auto-click it to open a new tab
                try{
                    var a = document.createElement('a');
                    a.href = payUrl;
                    a.target = '_blank';
                    a.rel = 'noopener noreferrer';
                    a.style.display = 'none';
                    document.body.appendChild(a);
                    // Some browsers will allow a programmatic click to open a new tab
                    a.click();
                } catch(e) {
                    // If that fails, reveal the fallback link for manual click
                    document.getElementById('fallback').style.display = 'inline';
                }
            })();
        </script>
    </body>
</html>
