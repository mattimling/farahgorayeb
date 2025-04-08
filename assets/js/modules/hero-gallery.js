function heroGallery() {
    const gallery = document.querySelector('.js-hero-gallery');
    if (!gallery) return;

    const images = gallery.querySelectorAll('.js-hero-gallery-image');
    if (images.length === 0) return;

    let current = 0;
    const timeout = parseInt(gallery.dataset.galleryTimeout, 10) * 1000;

    // Apply Tailwind classes to position images
    images.forEach((img, index) => {
        img.classList.toggle('opacity-0', index !== 0);
    });

    function changeImage() {
        images[current].classList.add('opacity-0');
        current = (current + 1) % images.length;
        images[current].classList.remove('opacity-0');
    }

    setInterval(changeImage, timeout);
}

heroGallery();

function heroParallax() {
    const hero = document.querySelector('.js-hero');
    const heroInner = document.querySelector('.js-hero-inner');

    if (!hero || !heroInner || typeof lenis === 'undefined') return;

    const updateParallax = () => {
        const rect = hero.getBoundingClientRect();
        const scrollY = window.scrollY || window.pageYOffset;
        const offsetTop = rect.top + scrollY;
        const scrollPos = scrollY - offsetTop;

        // Only apply if in viewport
        if (
            scrollY + window.innerHeight > offsetTop &&
            scrollY < offsetTop + hero.offsetHeight
        ) {
            const translateY = scrollPos * 0.2;
            const scale = 1 + scrollPos * 0.0003;
            const grayscale = Math.min(scrollPos / 1500, 1);
            const blur = Math.min(scrollPos / 200, 10); // max 10px blur

            heroInner.style.transform = `translateY(${translateY}px) scale(${scale})`;
            heroInner.style.filter = `grayscale(${grayscale}) blur(${blur}px)`;
        }
    };

    lenis.on('scroll', updateParallax);
    updateParallax();
}

heroParallax();

function heroLogoMask() {
    const logoMask = document.querySelector('.js-hero-logo-mask');

    if (!logoMask) return;

    setTimeout(() => {

        logoMask.classList.add('is-scaled');

    }, 1000);
}

heroLogoMask();

function heroVideoAutoplay() {

    const heroVideo = document.querySelector('.js-hero-video');

    if (heroVideo) {

        heroVideo.play();

    }

}

heroVideoAutoplay();