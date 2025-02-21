function imageImageHeight() {
    function equalizeImageDescHeight() {
        if (window.innerWidth < 768) {
            // Reset styles on smaller screens
            document.querySelectorAll('.js-image-desc').forEach(desc => {
                desc.style.minHeight = '';
            });
            return;
        }

        document.querySelectorAll('.js-image-image').forEach(container => {
            const descriptions = container.querySelectorAll('.js-image-desc');

            if (descriptions.length === 2) {
                let maxHeight = Math.max(descriptions[0].offsetHeight, descriptions[1].offsetHeight);

                descriptions.forEach(desc => {
                    desc.style.minHeight = maxHeight + 'px';
                });
            }
        });
    }

    // Run on page load and window resize
    window.addEventListener('load', equalizeImageDescHeight);
    window.addEventListener('resize', equalizeImageDescHeight);
}

imageImageHeight();
