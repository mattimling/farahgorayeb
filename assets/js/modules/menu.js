function menu() {
    document.addEventListener('click', event => {
        const self = event.target;

        if (self.classList.contains('js-menu-open') || self.classList.contains('js-menu-close') || self.classList.contains('js-menu-link')) {
            event.preventDefault();
            const menu = document.querySelector('.js-menu');
            const menuOpen = document.querySelector('.js-menu-open');
            const menuClose = document.querySelector('.js-menu-close');
            const contentWrapper = document.querySelector('.js-content-wrapper');
            const logo = document.querySelectorAll('.js-logo');

            // Open menu
            if (self.classList.contains('js-menu-open')) {
                menuOpen.classList.add('is-hidden');
                menuClose.classList.remove('is-hidden');
                menu.classList.remove('is-close');
                contentWrapper.classList.add('is-blurry');
                logo.forEach(item => { item.classList.add('is-inactive'); });
            }

            // Close menu
            if (self.classList.contains('js-menu-close')) {
                menuOpen.classList.remove('is-hidden');
                menuClose.classList.add('is-hidden');
                menu.classList.add('is-close');
                contentWrapper.classList.remove('is-blurry');
                logo.forEach(item => { item.classList.remove('is-inactive'); });
            }

            // Link clicked = close menu
            if (self.classList.contains('js-menu-link')) {
                menuOpen.classList.remove('is-hidden');
                menuClose.classList.add('is-hidden');
                menu.classList.add('is-close');
                contentWrapper.classList.remove('is-blurry');
                logo.forEach(item => { item.classList.remove('is-inactive'); });

                // Change active link
                setTimeout(timer => {
                    document.querySelectorAll('.js-menu-link').forEach(item => {
                        item.classList.remove('is-active');
                    });
                    self.classList.add('is-active');
                }, 1000);
            }
        }
    });
}

menu();

function menuActiveItem() {
    const menuItems = document.querySelectorAll('.js-menu-link');
    const currentPath = window.location.pathname;

    // Remove '/category/{slug}' part from the current path
    const baseCurrentPath = currentPath.replace(/\/category\/[^\/]+/, '');

    if (menuItems) {
        menuItems.forEach(item => {
            item.classList.remove('is-active');

            const itemPath = new URL(item.href).pathname;

            // Remove '/category/{slug}' part from the item path
            const baseItemPath = itemPath.replace(/\/category\/[^\/]+/, '');

            // Match the base path (ignores category portion)
            if (baseItemPath === baseCurrentPath) {
                item.classList.add('is-active');
            }
        });
    }
}

menuActiveItem();