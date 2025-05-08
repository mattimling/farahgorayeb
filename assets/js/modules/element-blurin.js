function elementBlurin() {
    if (window.innerWidth <= 1024) return;

    const isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);
    const elements = document.querySelectorAll('.js-element-blurin');
    const childrenElements = document.querySelectorAll('.js-element-blurin-children > *');

    if (!elements.length && !childrenElements.length) return;

    function applyBlurEffect(element) {
        const rect = element.getBoundingClientRect();
        const viewportHeight = window.innerHeight;
        const maxBlur = 15;
        const blurDistanceBottom = viewportHeight / 6;
        const blurDistanceTop = viewportHeight / 7;

        let blurAmount = 0;
        let opacityAmount = 1;
        let translateAmount = 0;

        // Entering from bottom
        if (rect.top > viewportHeight - blurDistanceBottom && rect.top < viewportHeight + rect.height) {
            const progress = 1 - ((rect.top - (viewportHeight - blurDistanceBottom)) / blurDistanceBottom);
            const eased = 0.5 * (1 - Math.cos(Math.PI * progress));

            blurAmount = maxBlur * (1 - progress);
            opacityAmount = progress;
            translateAmount = 30 * (1 - eased);
        }

        // Leaving to top
        else if (rect.bottom > -blurDistanceTop && rect.bottom < blurDistanceTop) {
            const progress = rect.bottom / blurDistanceTop;
            const eased = 0.5 * (1 - Math.cos(Math.PI * progress));

            blurAmount = maxBlur * (1 - progress);
            opacityAmount = progress;
            translateAmount = 30 * (1 - eased); // move up instead of down
        }

        element.style.opacity = opacityAmount;

        if (!isSafari) {
            element.style.filter = `blur(${blurAmount}px)`;
            element.style.transform = `translateY(${translateAmount}px)`;
        }
    }

    function onScroll() {
        elements.forEach(applyBlurEffect);
        childrenElements.forEach(applyBlurEffect);
    }

    onScroll();
    lenis.on('scroll', onScroll);
}

elementBlurin();
