function projectsFilter() {
    const filter = document.querySelectorAll('.js-pflo-filter');
    const grid = document.querySelector('.js-pflo-grid'); // The grid container
    const allItems = Array.from(document.querySelectorAll('.pflo-grid-item')); // Store all items
    const duration = 400;

    if (!filter || !grid || allItems.length === 0) return;

    document.addEventListener('click', event => {
        const self = event.target;

        // Check if the clicked item is a filter
        if (self.classList.contains('js-pflo-filter-item')) {
            event.preventDefault();

            // Remove 'is-active' from all filter items
            const filterItems = document.querySelectorAll('.js-pflo-filter-item');
            filterItems.forEach(item => {
                item.classList.remove('is-active');
            });

            // Toggle 'is-active' class on the clicked filter item
            self.classList.add('is-active');

            const selectedCategory = self.getAttribute('href').substring(1); // Remove the '#' to get the category slug (e.g., 'web-design')

            // Start by fading out the grid container
            grid.classList.add('fade-out');

            // Wait for fade-out transition to complete
            setTimeout(() => {
                // Clear the grid before adding new items
                grid.innerHTML = '';

                // Filter and append the items that match the selected category
                allItems.forEach(item => {
                    const itemCategories = item.getAttribute('data-category').split(' '); // Get all categories of the item
                    if (selectedCategory === "all" || itemCategories.includes(selectedCategory)) {
                        grid.appendChild(item); // Add matching item to the grid
                    }
                });

                // Trigger fade-in after the grid is populated
                setTimeout(() => {
                    grid.classList.remove('fade-out'); // Remove fade-out
                    grid.classList.add('fade-in'); // Add fade-in
                }, 10); // Small delay to ensure that fade-in applies after items are added

                // Reset the grid for the next interaction
                setTimeout(() => {
                    grid.classList.remove('fade-in'); // Clean up after fade-in
                }, 400); // Wait for fade-in duration before resetting

                // Call elementBlurin after the grid is updated
                elementBlurin();

                grid.classList.remove('is-all');

            }, duration); // Fade-out duration (should match CSS)
        }
    });
}

projectsFilter();

function parentFilter() {

    const parentFilter = document.querySelectorAll('.js-parent-filter');

    if (parentFilter) {

        document.addEventListener('click', event => {

            const self = event.target;
            const grid = document.querySelector('.js-pflo-grid'); // The grid container
            const duration = 400;

            if (self.classList.contains('js-parent-filter')) {

                event.preventDefault();

                const who = self.getAttribute('href');
                const wrapper = document.querySelector('.js-parent-filter-wrapper');

                // Deactivate filter parent links
                document.querySelectorAll('.js-parent-filter').forEach(item => {
                    item.classList.remove('is-active');
                });

                // Activate clicked link
                self.classList.add('is-active');

                // Deactivate contents
                document.querySelectorAll('.js-parent-filter-content').forEach(item => {
                    item.classList.remove('is-active');
                });

                if (wrapper) {
                    wrapper.style.height = 0;
                }


                if (who !== '#all') {
                    const clicked = document.querySelector('.js-parent-filter-content[data-parent="' + who + '"]');

                    if (clicked) {
                        clicked.classList.add('is-active');

                        // Get the height of the child content (you can customize the selector below)
                        const child = clicked.querySelector('.js-parent-filter-content-inner'); // Adjust this if needed

                        if (child) {
                            // Set the height based on the content
                            clicked.closest('.js-parent-filter-wrapper').style.height = child.scrollHeight + 'px';
                        }
                    }
                } else {
                    setTimeout(timer => {
                        grid.classList.add('is-all');
                    }, duration);
                }

            }

        });

    }

}

parentFilter();