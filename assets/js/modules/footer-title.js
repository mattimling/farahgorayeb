function footerTitle() {
    const title = document.querySelector('.js-footer-title');
    const imageContainer = document.querySelector('.js-footer-title-image');
    const images = imageContainer?.querySelectorAll('div');

    if (!title || !imageContainer || images.length === 0) return;

    let targetX = 0;
    let currentX = 0;
    let isAnimating = false;
    let activeIndex = -1; // Track active image to avoid redundant changes
    let mediaQuery = window.matchMedia('(min-width: 768px)'); // Check for desktop

    // Apply initial styles for smooth transitions
    images.forEach((img, i) => {
        img.style.opacity = i === 0 ? '1' : '0';
        img.style.transition = 'opacity 0.5s ease-in-out';
    });

    // Function to handle mouse follow effect on desktop
    const handleMouseMove = (event) => {
        const { left, width } = title.getBoundingClientRect();
        const mouseX = event.clientX - left;
        const percentX = mouseX / width; // 0 (left) → 1 (right)

        // Moves image container based on title width
        targetX = (percentX - 0.5) * width;

        // Determine which image to show
        const index = Math.min(
            Math.floor(percentX * images.length),
            images.length - 1
        );

        // Only change image if it's different from the currently active one
        if (index !== activeIndex) {
            activeIndex = index;
            images.forEach((img, i) => {
                img.style.opacity = i === index ? '1' : '0';
            });
        }

        if (!isAnimating) {
            isAnimating = true;
            animate();
        }
    };

    // Function to change images automatically on smaller screens
    const autoImageChange = () => {
        let index = activeIndex;
        setInterval(() => {
            index = (index + 1) % images.length;
            images.forEach((img, i) => {
                img.style.opacity = i === index ? '1' : '0';
            });
            activeIndex = index;
        }, 2000); // Change every 2 seconds
    };

    // Function to handle media query change (resize)
    const handleResize = () => {
        // Add event listener for mousemove only if on desktop
        if (mediaQuery.matches) {
            title.addEventListener('mousemove', handleMouseMove);

            title.addEventListener('mouseleave', () => {
                targetX = 0; // Return to center
                if (!isAnimating) {
                    isAnimating = true;
                    animate();
                }
            });
        } else {
            // For smaller screens, change images automatically
            autoImageChange();
            // Remove mousemove event listener if switching to mobile
            title.removeEventListener('mousemove', handleMouseMove);
        }
    };

    // Initial setup on load
    handleResize();

    // Listen for changes to the media query (when resizing the window)
    mediaQuery.addEventListener('change', handleResize);

    function cubicEasing(t) {
        return t * t * (3 - 2 * t); // Smooth cubic easing
    }

    function animate() {
        let progress = cubicEasing(0.15); // More reactive easing
        currentX += (targetX - currentX) * progress;

        imageContainer.style.transform = `translateX(${currentX}px)`;

        if (Math.abs(targetX - currentX) > 0.5) {
            requestAnimationFrame(animate);
        } else {
            isAnimating = false;
        }
    }
}

footerTitle();
