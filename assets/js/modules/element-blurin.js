/* function elementBlurin() {
    const elements = document.querySelectorAll('.js-element-blurin');
    if (!elements.length) return;

    function onScroll({ scroll }) {
        elements.forEach(element => {
            const rect = element.getBoundingClientRect();
            const viewportHeight = window.innerHeight;
            const maxBlur = 15;
            const blurDistance = viewportHeight / 4; // Distance over which blur fades

            // Check if element is entering viewport
            if (rect.top < viewportHeight && rect.bottom > 0) {
                // Calculate how much of the blur effect should be applied
                const progress = Math.min(Math.max(0, viewportHeight - rect.top) / blurDistance, 1);
                const blurAmount = maxBlur * (1 - progress); // Interpolates from 10px to 0px

                element.style.filter = `blur(${blurAmount}px)`;
            }
        });
    }

    lenis.on('scroll', onScroll);
}

elementBlurin();
 */


function elementBlurin() {
    const elements = document.querySelectorAll('.js-element-blurin');
    if (!elements.length) return;

    function onScroll({ scroll }) {
        elements.forEach(element => {
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
            const translateAmount = 30 * (1 - transformProgress); // Moves from translateY(50px) to translateY(0)

            // Apply styles
            element.style.filter = `blur(${blurAmount}px)`;
            element.style.opacity = opacityAmount;
            element.style.transform = `translateY(${translateAmount}px)`;
        });
    }

    lenis.on('scroll', onScroll);
}

elementBlurin();
