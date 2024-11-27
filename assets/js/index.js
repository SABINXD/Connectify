function setupMenuToggle() {
    const navMenu = document.getElementById('nav-menu');
    const moreMenu = document.getElementById('more-menu');
    const mainWrapper = document.querySelector('.main-wrapper');

    if (window.matchMedia("(max-width: 600px)").matches) {
        moreMenu.addEventListener('click', function (e) {
            navMenu.style.display = "block";
        });

        mainWrapper.addEventListener('click', function (e) {
            navMenu.style.display = "none";
        });
    }
}

// Call the function initially
setupMenuToggle();

// Optional: Recheck when the window is resized
window.addEventListener('resize', setupMenuToggle);
function setupMenuToggle() {
    const navMenu = document.getElementById('nav-menu');
    const moreMenu = document.getElementById('more-menu');
    const mainWrapper = document.querySelector('.main-wrapper');

    if (window.matchMedia("(max-width: 600px)").matches) {
        moreMenu.addEventListener('click', function (e) {
            navMenu.style.display = "block";
        });

        mainWrapper.addEventListener('click', function (e) {
            navMenu.style.display = "none";
        });
    }
}

// Call the function initially
setupMenuToggle();

// Optional: Recheck when the window is resized
window.addEventListener('resize', setupMenuToggle);
