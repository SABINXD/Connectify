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
// appel when the user is block 
document.addEventListener('DOMContentLoaded', function () {
    const logoutButton = document.getElementById('logoutButton');
    const appealButton = document.getElementById('appealButton');

    logoutButton.addEventListener('click', function () {

        window.location.href = '';
    });

    appealButton.addEventListener('click', function () {
        const email = "pdlbasu7@gmail.com";
        const subject = "Appeal for Ban";
        const body = "Dear Admin,\n\nI would like to appeal my ban. Please review my case.\n\nThank you.";
        window.location.href = `mailto:${email}?subject=${encodeURIComponent(subject)}&body=${encodeURIComponent(body)}`;
    });
});
// js to verify user
document.addEventListener('DOMContentLoaded', function () {
    const codeInput = document.querySelector('.codenumber');
    const verifyButton = document.querySelector('.code-verify');

    codeInput.addEventListener('input', function () {
        // Remove non-digit characters and limit to 6 digits
        this.value = this.value.replace(/\D/g, '').slice(0, 6);
    });

    verifyButton.addEventListener('click', function (e) {
        e.preventDefault();
        if (codeInput.value.length === 6) {


        } else {
            alert('Please enter a 6-digit code.');
        }
    });
});
