function preloader() {

    const preloader = document.querySelector('.js-preloader');
    const counter = document.querySelector('.js-preloader-counter');

    if (preloader && counter) {

        // Delay the start of the preloader logic by 1-2 seconds
        setTimeout(() => {

            html.style.backgroundColor = '#fff';

            // Start counter from 0 to 100%
            let counterValue = 0;

            // Random increment function (returns 2, 3, or 4)
            function getRandomStep() {
                return Math.floor(Math.random() * 1) + 1; // Returns 2, 3, or 4
            }

            const counterInterval = setInterval(() => {
                if (counterValue < 100) {
                    // Increment counter by a random value (2, 3, or 4)
                    counterValue += getRandomStep();
                    if (counterValue > 100) counterValue = 100; // Ensure it doesn't exceed 100%
                    counter.textContent = `${counterValue}%`;
                    counter.classList.add('is-visible');


                    // Apply the clip-path to reveal the logo
                    const clipPathValue = `polygon(0% ${100 - counterValue}%, 100% ${100 - counterValue}%, 100% 100%, 0% 100%)`; // Bottom to top
                    // const clipPathValue = `polygon(0% 0%, 100% 0%, 100% ${counterValue}%, 0% ${counterValue}%)`; // Top to bottom
                    document.querySelector('.js-preloader-logo').style.clipPath = clipPathValue;
                    document.querySelector('.js-preloader-logo').classList.add('is-visible');
                }
            }, 30); // Increment every 70ms for randomness

            // Wait until the counter reaches 100% before hiding the preloader
            const checkCounter = setInterval(() => {
                if (counterValue >= 100) {
                    // Once the counter reaches 100%, stop checking and hide the preloader
                    clearInterval(checkCounter);
                    const pageWrapper = document.querySelector('.js-page-wrapper');
                    pageWrapper.style.display = 'inherit';

                    anime({
                        targets: preloader,
                        opacity: [1, 0],
                        easing: 'easeInOutCubic',
                        duration: 2000,
                        complete: function () {
                            preloader.remove();
                        }
                    });
                }
            }, 30); // Check every 30ms until the counter reaches 100%

        }, 1000); // Random delay between 1 and 2 seconds

    }

}

preloader();
