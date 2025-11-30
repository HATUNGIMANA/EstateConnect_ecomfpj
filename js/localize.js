document.addEventListener('DOMContentLoaded', function() {
  // Map of sample non-Ghana content to Ghanaian equivalents
  const cityMap = {
    'California, USA': 'Accra, Ghana',
    'California, United States': 'Accra, Ghana',
    'New York': 'Accra'
  };

  const nameMap = {
    'James Smith': 'Kofi Mensah',
    'Mike Houston': 'Kwame Adu',
    'Cameron Webster': 'Kojo Asante',
    'Dave Smith': 'Yaw Owusu',
    'James Doe': 'Kojo Asante',
    'Jean Smith': 'Akua Boateng',
    'Alicia Huston': 'Afua Ofori',
    'Davin Smith': 'Esi Kusi'
  };

  // Convert prices that use $ to GHS
  document.querySelectorAll('.price span').forEach(function(el) {
    if (el.textContent.includes('$')) {
      el.textContent = el.textContent.replace('$', 'GHS ');
    }
  });

  // Replace known city strings
  Object.keys(cityMap).forEach(function(k) {
    // replace in elements that commonly contain city text
    document.querySelectorAll('.city, .meta, .text-black-50, textarea, input, p, span').forEach(function(el) {
      if (el.childNodes && el.childNodes.length > 0) {
        if (el.textContent.includes(k)) {
          el.textContent = el.textContent.replace(k, cityMap[k]);
        }
      }
    });
  });

  // Replace names in common heading elements
  Object.keys(nameMap).forEach(function(k) {
    document.querySelectorAll('h3, h2, .person-contents h2, .testimonial h3, .h5, .h5.text-primary').forEach(function(el) {
      if (el.textContent && el.textContent.includes(k)) {
        el.textContent = el.textContent.replace(k, nameMap[k]);
      }
    });
    // also check links or other text nodes
    document.querySelectorAll('a, p, span').forEach(function(el) {
      if (el.textContent && el.textContent.includes(k)) {
        el.textContent = el.textContent.replace(k, nameMap[k]);
      }
    });
  });

  // Update any input placeholders mentioning 'New York'
  document.querySelectorAll('input[placeholder]').forEach(function(inp) {
    if (inp.placeholder.includes('New York')) {
      inp.placeholder = inp.placeholder.replace('New York', 'Accra');
    }
  });

});
