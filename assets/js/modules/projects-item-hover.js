function projectsItemHover() {

    const items = document.querySelectorAll('.js-pflo-item');

    items.forEach(item => {
        item.addEventListener('mouseenter', () => {
            items.forEach(el => {
                if (el !== item) {
                    el.classList.add('is-inactive');
                } else {
                    el.classList.remove('is-inactive');
                }
            });
        });

        item.addEventListener('mouseleave', () => {
            items.forEach(el => el.classList.remove('is-inactive'));
        });
    });

}

projectsItemHover();