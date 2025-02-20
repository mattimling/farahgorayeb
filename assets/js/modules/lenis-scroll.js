function lenisScroll() {

    lenis = new Lenis({
        // lerp: 0.15
    });

    function raf(time) {

        lenis.raf(time);

        requestAnimationFrame(raf);

    }

    requestAnimationFrame(raf);

}

lenisScroll();