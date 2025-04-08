function barbaPageTransition() {

    const transitionDelay = 500,
        transitionEasing = 'easeOutCubic',
        transitionTarget = document.querySelector('.js-page-wrapper'),
        transitionY = 30,
        delay = (ms = transitionDelay * 2) => new Promise(resolve => setTimeout(resolve, ms));

    function to(data) {

        // Stop lenis scroll
        lenis.stop();

        // Animate fade out
        anime({
            targets: transitionTarget,
            opacity: [1, 0],
            translateY: [0, -transitionY],
            filter: ['blur(0px)', 'blur(5px)'],
            easing: transitionEasing,
            duration: transitionDelay,
        });

    }

    function ti(data) {

        // Start lenis scroll
        lenis.start();

        // Animate fade in
        anime({
            targets: transitionTarget,
            opacity: [0, 1],
            translateY: [transitionY, 0],
            filter: ['blur(5px)', 'blur(0px)'],
            easing: transitionEasing,
            duration: transitionDelay,
            complete: function () {

                // Start lenis scroll
                lenis.start();

                ifFunctionExist('footerLink');
                ifFunctionExist('footerTitle');
                ifFunctionExist('projectsFilter');
                ifFunctionExist('parentFilter');
                ifFunctionExist('projectsSlider');
                ifFunctionExist('heroParallax');

                transitionTarget.style.transform = '';

            }
        });


        setTimeout(timer => {
            ifFunctionExist('heroGallery');
            ifFunctionExist('elementBlurin');
            ifFunctionExist('imageImageHeight');
            ifFunctionExist('prevNextHoverEffect');
            ifFunctionExist('projectsItemHover');
            ifFunctionExist('menuActiveItem');
            ifFunctionExist('heroVideoAutoplay');
            ifFunctionExist('heroLogoMask');
        }, 10);

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