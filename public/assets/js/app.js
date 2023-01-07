// Nav, burger
const navSlide = () => {
    const burger = document.querySelector('.burger');
    const nav = document.querySelector('.nav-links');
    const navLinks = document.querySelectorAll('.nav-links li');

    burger.addEventListener('click', () => {
        // Toggle burger
        nav.classList.toggle('nav-active');

        // Animate burger
        burger.classList.toggle('toggle');

        // Animate nav links
        navLinks.forEach((link, index) => {
            if (link.style.animation) {
                link.style.animation = '';
            } else {
                link.style.animation = `navLinksFade .5s ease forwards ${index / 7 + .3}s`;
            }
        });
    });
}

navSlide();

// HIGHLIGHT NAV ITEM OF THE CURRENT PAGE
window.onload = function () {
    var pathCurrentPage = location.pathname;

    if (pathCurrentPage == "/actualite") {
        $("#news").addClass("current-page");
    }
    if (pathCurrentPage == "/jeux") {
        $("#games").addClass("current-page");
    }
    if (pathCurrentPage.startsWith('/jeux/categorie/')) {
        $("#categories").addClass("current-page");
    }
    if (pathCurrentPage.startsWith('/jeux/plateforme/')) {
        $("#platforms").addClass("current-page");
    }
    if (pathCurrentPage == "/a-propos") {
        $("#about").addClass("current-page");
    }
    if (pathCurrentPage.startsWith('/profil/')) {
        $("#profile").addClass("current-page");
    }
};
