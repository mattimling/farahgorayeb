function initContactForm() {

    // Reinit CF7 (required)
    if (typeof wpcf7 !== 'undefined' && typeof wpcf7.init === 'function') {
        const forms = document.querySelectorAll('.wpcf7 form');
        forms.forEach(form => {
            wpcf7.init(form);
        });
    }

}

initContactForm();