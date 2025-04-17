function elementBlurin() {
    // Only run if the screen width is greater than 768px (desktop)
    if (window.innerWidth <= 1024) {
        return;
    }

    // Detect if the browser is Safari (excluding Chrome and Android)
    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

    const elements = document.querySelectorAll('.js-element-blurin');
    const childrenElements = document.querySelectorAll('.js-element-blurin-children > *');

    if (!elements.length && !childrenElements.length) return;

    // Helper function to apply the blur effect
    function applyBlurEffect(element) {
        const rect = element.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const maxBlur = 15;
        const blurDistance = viewportHeight / 5; // Distance over which blur fades
        const transformDistance = viewportHeight / 2; // Distance over which element will translate

        // Calculate opacity and transform progress
        const opacityProgress = Math.min(Math.max(0, viewportHeight - rect.top) / blurDistance, 1);
        let transformProgress = Math.min(Math.max(0, viewportHeight - rect.top) / transformDistance, 1);

        // Apply easing to translateY (ease out)
        transformProgress = 0.5 * (1 - Math.cos(Math.PI * transformProgress));

        // Calculate blur, opacity, and transform (translation)
        const blurAmount = maxBlur * (1 - opacityProgress); // Interpolates from 15px to 0px
        const opacityAmount = opacityProgress; // Interpolates from 0 to 1
        const translateAmount = 30 * (1 - transformProgress); // Moves from translateY(30px) to translateY(0)

        // Apply styles to the element
        element.style.opacity = opacityAmount;

        // Apply blur only if not Safari
        if (!isSafari) {
            element.style.filter = `blur(${blurAmount}px)`;
            element.style.transform = `translateY(${translateAmount}px)`;
        } else {
            // element.style.filter = 'none'; // Remove blur on Safari
        }
    }

    // Scroll event handler
    function onScroll() {
        elements.forEach(applyBlurEffect);
        childrenElements.forEach(applyBlurEffect);
    }

    // Apply the effect initially when the page loads
    onScroll();

    // Use Lenis scroll handler instead of native scroll event
    lenis.on('scroll', onScroll);
}

elementBlurin();
