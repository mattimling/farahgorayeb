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