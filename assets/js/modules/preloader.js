function preloader() {

    const preloader = document.querySelector('.js-preloader');

    if (preloader) {

        // Hide all on the load > make visible after 0.8s.
        setTimeout(f => {

            lenis.scrollTo(0, {
                immediate: true
            });

            lenis.stop();

            html.style.opacity = '1';
            html.style.overflow = 'auto';
            html.style.pointerEvents = 'auto';
            body.style.opacity = '1';

            anime({
                targets: preloader,
                opacity: [0, 1],
                easing: 'easeOutCubic',
                duration: 500,
                complete: function () {

                    setTimeout(f => {

                        const prelTransitionDelay = 500,
                            prelTransitionEasing = 'easeOutCubic';

                        // Hide preloader
                        anime({
                            targets: preloader,
                            opacity: [1, 0],
                            easing: prelTransitionEasing,
                            duration: prelTransitionDelay,
                            complete: function () {
                                preloader.remove();

                                // Show page
                                anime({
                                    targets: document.querySelector('.js-page-wrapper'),
                                    opacity: [0, 1],
                                    easing: prelTransitionEasing,
                                    duration: prelTransitionDelay,
                                    complete: function () {
                                        lenis.start();
                                    }
                                });

                                anime({
                                    targets: document.querySelector('.js-header-bar'),
                                    opacity: [0, 1],
                                    easing: prelTransitionEasing,
                                    duration: prelTransitionDelay,
                                });
                            }
                        });
                    }, 2000);
                }
            });

        }, 1000);

        function fadeLoopImages() {
            const container = document.querySelector('.js-preloader .relative');
            if (!container) return;

            const images = container.querySelectorAll('img'); // or use a class like `.fade-image` if needed
            if (images.length === 0) return;

            let current = 0;

            // Set all images to 0 opacity except the first
            images.forEach((img, index) => {
                img.style.transition = 'opacity 0.02s ease';
                img.style.opacity = index === 0 ? '1' : '0';
            });

            setInterval(() => {
                const next = (current + 1) % images.length;

                images[current].style.opacity = '0';
                images[next].style.opacity = '1';

                current = next;
            }, 125); // change every 3s
        }

        fadeLoopImages();

    }

}

preloader();
