document.addEventListener('DOMContentLoaded', function() {
    // Get all menu items with submenus
    const menuItems = document.querySelectorAll('.has-submenu > .nav-link');

    // Add click event listener to each menu item
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Toggle the 'open' class on the parent li
            const parent = this.parentElement;
            parent.classList.toggle('open');
            
            // Toggle the submenu
            const submenu = parent.querySelector('.submenu');
            if (submenu) {
                submenu.classList.toggle('show');
            }
        });
    });

    // Auto-open parent menus if a child is active
    const activeSubmenuItems = document.querySelectorAll('.submenu .nav-link.active');
    activeSubmenuItems.forEach(item => {
        const parentMenu = item.closest('.has-submenu');
        if (parentMenu) {
            parentMenu.classList.add('open');
            parentMenu.querySelector('.submenu').classList.add('show');
        }
    });
});
