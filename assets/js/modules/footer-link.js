function footerLink() {
    const footerLinksContainer = document.querySelector('.js-footer-links');
    const footerLinks = document.querySelectorAll('.js-footer-links a');

    if (!footerLinksContainer || !footerLinks.length) return; // Exit if no container or links are found

    footerLinks.forEach(link => {
        link.addEventListener('mouseover', () => {
            footerLinksContainer.classList.add('is-hovered'); // Add class to parent container
            footerLinks.forEach(item => item.classList.add('is-hovered')); // Add class to all links
        });

        link.addEventListener('mouseout', () => {
            footerLinksContainer.classList.remove('is-hovered'); // Remove class from parent container
            footerLinks.forEach(item => item.classList.remove('is-hovered')); // Remove class from all links
        });
    });
}

footerLink();
