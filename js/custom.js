(function () {

	'use strict'


	try {
		if (window.AOS && typeof window.AOS.init === 'function') {
			AOS.init({
				duration: 800,
				easing: 'slide',
				once: true
			});
		}
	} catch (e) {
		console.warn('AOS init failed', e);
	}

	var preloader = function() {

		var loader = document.querySelector('.loader');
		var overlay = document.getElementById('overlayer');

		function fadeOut(el) {
			if (!el) return;
			el.style.opacity = 1;
			(function fade() {
				if ((el.style.opacity -= .1) < 0) {
					el.style.display = "none";
				} else {
					requestAnimationFrame(fade);
				}
			})();
		};

		setTimeout(function() {
			fadeOut(loader);
			fadeOut(overlay);
		}, 200);
	};

	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		// DOM already ready
		preloader();
	} else {
		window.addEventListener('DOMContentLoaded', preloader);
	}
	

	var tinySdlier = function() {
		try {
			var heroSlider = document.querySelectorAll('.hero-slide');
			var propertySlider = document.querySelectorAll('.property-slider');
			var imgPropertySlider = document.querySelectorAll('.img-property-slide');
			var testimonialSlider = document.querySelectorAll('.testimonial-slider');

			if (heroSlider.length > 0 && typeof tns === 'function') {
				tns({
					container: '.hero-slide',
					mode: 'carousel',
					speed: 700,
					autoplay: true,
					controls: false,
					nav: false,
					autoplayButtonOutput: false,
					controlsContainer: '#hero-nav',
				});
			}

			if (imgPropertySlider.length > 0 && typeof tns === 'function') {
				tns({
					container: '.img-property-slide',
					mode: 'carousel',
					speed: 700,
					items: 1,
					gutter: 30,
					autoplay: true,
					controls: false,
					nav: true,
					autoplayButtonOutput: false
				});
			}

			if (propertySlider.length > 0 && typeof tns === 'function') {
				tns({
					container: '.property-slider',
					mode: 'carousel',
					speed: 700,
					gutter: 30,
					items: 3,
					autoplay: true,
					autoplayButtonOutput: false,
					controlsContainer: '#property-nav',
					responsive: {
						0: { items: 1 },
						700: { items: 2 },
						900: { items: 3 }
					}
				});
			}

			if (testimonialSlider.length > 0 && typeof tns === 'function') {
				tns({
					container: '.testimonial-slider',
					mode: 'carousel',
					speed: 700,
					items: 3,
					gutter: 50,
					autoplay: true,
					autoplayButtonOutput: false,
					controlsContainer: '#testimonial-nav',
					responsive: {
						0: { items: 1 },
						700: { items: 2 },
						900: { items: 3 }
					}
				});
			}
		} catch (e) {
			console.warn('tinySlider init failed', e);
		}
	}
	// run after DOM ready to ensure elements exist
	if (document.readyState === 'complete' || document.readyState === 'interactive') {
		tinySdlier();
	} else {
		window.addEventListener('DOMContentLoaded', tinySdlier);
	}



})()