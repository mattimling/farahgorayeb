function pfloFilter() {
    const filter = document.querySelector('.js-pflo-filter');
    const grid = document.querySelector('.js-pflo-grid'); // The grid container
    const allItems = Array.from(document.querySelectorAll('.pflo-grid-item')); // Store all items

    if (!filter || !grid || allItems.length === 0) return;

    document.addEventListener('click', event => {
        const self = event.target;

        if (self.classList.contains('js-pflo-filter-item')) {
            event.preventDefault();

            const selectedCategory = self.getAttribute('href'); // e.g., "#web-design"

            // Clear the grid before appending selected items
            grid.innerHTML = '';

            allItems.forEach(item => {
                const itemCategory = item.getAttribute('data-category');

                if (selectedCategory === "#all" || itemCategory === selectedCategory) {
                    grid.appendChild(item); // Add matching items
                }
            });
        }
    });
}

pfloFilter();
