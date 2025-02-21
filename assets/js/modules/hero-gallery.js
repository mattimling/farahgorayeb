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

    if (!hero || !heroInner) return;

    // Apply smooth easing when the element moves
    hero.addEventListener('mousemove', (event) => {
        const { left, top, width, height } = hero.getBoundingClientRect();
        const mouseX = event.clientX - left;
        const mouseY = event.clientY - top;

        // Calculate the percentage of the mouse's position within the hero container
        const percentX = (mouseX / width) - 1; // From -0.5 to 0.5
        const percentY = (mouseY / height) - 1; // From -0.5 to 0.5

        // Apply the transformation to the inner container with enhanced movement strength
        const movementStrength = 30; // Increased movement strength
        const movementX = percentX * movementStrength;
        const movementY = percentY * movementStrength;

        heroInner.style.transition = 'transform 1s ease-out'; // Smooth easing transition
        heroInner.style.transform = `translate(${movementX}px, ${movementY}px)`;
    });

    // Reset the transform when the mouse leaves
    /* hero.addEventListener('mouseleave', () => {
        heroInner.style.transition = 'transform 0.3s ease-in-out'; // Smooth reset transition
        heroInner.style.transform = 'translate(0, 0)';
    }); */
}

// heroParallax();
