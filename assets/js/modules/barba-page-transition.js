function barbaPageTransition() {

    const transitionDelay = 500,
        transitionEasing = 'easeOutCubic',
        transitionTarget = document.querySelector('.js-page-transition'),
        transitionTargetLogo = document.querySelector('.js-page-transition-logo'),
        opacity = 1,
        transitionY = 20,
        delay = (ms = transitionDelay * 2) => new Promise(resolve => setTimeout(resolve, ms));

    function to(data) {

        // Stop lenis scroll
        lenis.stop();

        // Animate fade out
        anime({
            targets: transitionTarget,
            opacity: [0, 1],
            easing: transitionEasing,
            duration: transitionDelay,
        });

        anime({
            targets: transitionTargetLogo,
            opacity: [0, 1],
            easing: transitionEasing,
            duration: transitionDelay,
            delay: transitionDelay / 4,
        });

    }

    function ti(data) {

        // Start lenis scroll
        lenis.start();

        // Animate fade in
        anime({
            targets: transitionTargetLogo,
            opacity: [1, 0],
            easing: transitionEasing,
            duration: transitionDelay / 2,
        });

        setTimeout(event => {
            anime({
                targets: transitionTarget,
                opacity: [1, 0],
                easing: transitionEasing,
                duration: transitionDelay,
                complete: function () {

                    // Start lenis scroll
                    lenis.start();

                }
            });
        }, transitionDelay / 4);

        ifFunctionExist('sliderGallery');
        ifFunctionExist('homeVideo', false);

    }

    barba.init({
        schema: {
            wrapper: 'js-barba-wrapper',
            container: 'js-barba-content',
        },
        sync: true,
        // debug: true,
        timeout: 10000,
        transitions: [{
            async leave(data) {
                const done = this.async();
                to(data);
                await delay((transitionDelay));
                done();
            },

            async enter(data) {
                ti(data);
            },

            async once(data) {
            },
        },],
        prevent: ({ el }) => el.classList && el.classList.contains('_brb-prv')
    })

    barba.hooks.enter(() => {

        document.body.scrollTop = document.documentElement.scrollTop = 0;

    })

    barba.hooks.beforeEnter((data) => {

        // Only run during a page transition - not initial load.
        if (data.current.container) {
            const nh = data.next.html;
            const p = new DOMParser();
            const dc = p.parseFromString(nh.replace(/(<\/?)body( .+?)?>/gi, '$1notbody$2>', nh), 'text/html');
            const bc = dc.querySelector('notbody').getAttribute('class');
            body.setAttribute('class', bc);
        }

    });

}

barbaPageTransition();