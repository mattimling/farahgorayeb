function menu() {

    document.addEventListener('click', event => {

        const self = event.target;

        if (self.classList.contains('js-menu-open') || self.classList.contains('js-menu-close') || self.classList.contains('js-menu-link')) {

            event.preventDefault();

            const menu = document.querySelector('.js-menu');
            const menuOpen = document.querySelector('.js-menu-open');
            const menuClose = document.querySelector('.js-menu-close');
            const contentWrapper = document.querySelector('.js-content-wrapper');
            const logo = document.querySelector('.js-logo');

            // Open menu
            if (self.classList.contains('js-menu-open')) {

                menuOpen.classList.add('is-hidden');
                menuClose.classList.remove('is-hidden');
                menu.classList.remove('is-close');
                contentWrapper.classList.add('is-blurry');
                logo.classList.add('is-inactive');

            }

            // Close menu
            if (self.classList.contains('js-menu-close')) {

                menuOpen.classList.remove('is-hidden');
                menuClose.classList.add('is-hidden');
                menu.classList.add('is-close');
                contentWrapper.classList.remove('is-blurry');
                logo.classList.remove('is-inactive');

            }

            // Link clicked = close menu
            if (self.classList.contains('js-menu-link')) {

                menuOpen.classList.remove('is-hidden');
                menuClose.classList.add('is-hidden');
                menu.classList.add('is-close');
                contentWrapper.classList.remove('is-blurry');
                logo.classList.remove('is-inactive');

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

    if (menuItems) {
        menuItems.forEach(item => {
            item.classList.remove('is-active');

            const itemPath = new URL(item.href).pathname;

            // Match exact path
            if (itemPath === currentPath) {
                item.classList.add('is-active');
            }
        });
    }
}


menuActiveItem();