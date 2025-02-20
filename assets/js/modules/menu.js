function menu() {

    document.addEventListener('click', event => {

        const self = event.target;

        if (self.classList.contains('js-menu-open') || self.classList.contains('js-menu-close')) {

            event.preventDefault();

            const menu = document.querySelector('.js-menu');
            const menuOpen = document.querySelector('.js-menu-open');
            const menuClose = document.querySelector('.js-menu-close');
            const contentWrapper = document.querySelector('.js-content-wrapper');

            if (self.classList.contains('js-menu-open')) {

                menuOpen.classList.add('is-hidden');
                menuClose.classList.remove('is-hidden');
                menu.classList.remove('is-close');
                contentWrapper.classList.add('is-blurry');

            }

            if (self.classList.contains('js-menu-close')) {

                menuOpen.classList.remove('is-hidden');
                menuClose.classList.add('is-hidden');
                menu.classList.add('is-close');
                contentWrapper.classList.remove('is-blurry');

            }

        }

    });

}

menu();