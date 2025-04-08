function pm() {

    setTimeout(() => {

        // Load images.
        const lm = document.querySelector('.js-preload-media');
        let cl = false;

        if (lm) {

            // const onScroll = function () {

            if (!cl) {

                const clon = lm.content.cloneNode(true);

                document.querySelector('body').appendChild(clon);

                cl = true;

                // Swap `data-src` for `src` to load images
                /* const images = document.querySelectorAll('img[data-src]');

                images.forEach((img) => {
                    img.src = img.getAttribute('data-src'); // Set src to data-src value
                    img.removeAttribute('data-src'); // Optionally, clean up the attribute
                }); */

                // window.removeEventListener('scroll', onScroll)

            }

            // };

            // window.addEventListener('scroll', onScroll);
        }

    }, 5000);

}

pm();