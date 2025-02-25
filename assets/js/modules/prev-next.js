function prevNextHoverEffect() {
    const links = document.querySelectorAll('.js-prev-next-link');

    links.forEach(link => {
        const img = link.querySelector('.js-prev-next-link-img');
        if (!img) return;

        let targetX = 0;
        let currentX = 0;
        let isAnimating = false;

        const cubicEasing = (t) => t * t * (3 - 2 * t); // Smooth easing

        function animate() {
            currentX += (targetX - currentX) * cubicEasing(0.15);
            img.style.transform = `translateX(${currentX}px)`;

            if (Math.abs(targetX - currentX) > 0.5) {
                requestAnimationFrame(animate);
            } else {
                isAnimating = false;
            }
        }

        link.addEventListener('mousemove', (event) => {
            const { left, width } = link.getBoundingClientRect();
            targetX = ((event.clientX - left) / width - 0.5) * width;

            if (!isAnimating) {
                isAnimating = true;
                animate();
            }
        });

        link.addEventListener('mouseleave', () => {
            // targetX = 0; // Reset to center
            if (!isAnimating) {
                isAnimating = true;
                animate();
            }
        });
    });
}

prevNextHoverEffect();
