function elementPushedBack() {
    const elements = document.querySelectorAll('.js-element-pushedback');
    if (!elements.length) return;

    let scrollSpeed = 0;
    let lastScrollY = 0;
    let targetScale = 1;
    let currentScale = 1;
    let easeFactor = 0.01; // Adjust easing speed (lower = smoother)

    function onScroll({ scroll }) {
        scrollSpeed = Math.abs(scroll - lastScrollY);
        lastScrollY = scroll;

        targetScale = 1 - Math.min(scrollSpeed * 0.005, 0.05); // Shrinking effect
        cancelAnimationFrame(animateScale);
        animateScale();
    }

    function animateScale() {
        currentScale += (targetScale - currentScale) * easeFactor; // Easing formula

        elements.forEach(el => {
            el.style.transform = `scale(${currentScale})`;
        });

        if (Math.abs(targetScale - currentScale) > 0.001) {
            requestAnimationFrame(animateScale);
        }
    }

    lenis.on('scroll', onScroll);
}

elementPushedBack();
