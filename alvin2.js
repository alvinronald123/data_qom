

document.addEventListener('DOMContentLoaded', function () {
    const toggleButton = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleButton.addEventListener('click', () => {
        
        if (sidebar.style.left === '0px' || sidebar.style.left === '') {
            
            sidebar.style.left = '-250px';
        } else {
            
            sidebar.style.left= '0px';
        }
    });
});



