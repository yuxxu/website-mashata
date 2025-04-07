window.addEventListener("scroll", function () {
    const navbar = document.getElementById("navbar");
    const header = document.getElementById("header");
    if (window.scrollY > 50) { 
        navbar.classList.add("scrolled");
        header.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
        header.classList.remove("scrolled");
    }
});
