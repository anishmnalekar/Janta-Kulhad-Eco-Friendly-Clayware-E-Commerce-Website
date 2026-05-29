document.addEventListener("DOMContentLoaded", () => {
    const menuToggle = document.getElementById("menu-toggle");
    const navLinks = document.getElementById("nav-links");

    menuToggle.addEventListener("click", () => {
        navLinks.classList.toggle("show");
    });

    // Product Scroll Functionality
    const productContainer = document.querySelector(".product-container");
    document.querySelector(".scroll-left").addEventListener("click", () => {
        productContainer.scrollBy({ left: -250, behavior: "smooth" });
    });
    document.querySelector(".scroll-right").addEventListener("click", () => {
        productContainer.scrollBy({ left: 250, behavior: "smooth" });
    });

    // Gallery Scroll Functionality
    const gallery = document.querySelector(".carousel");
    document.querySelector(".gallery-left").addEventListener("click", () => {
        gallery.scrollBy({ left: -300, behavior: "smooth" });
    });
    document.querySelector(".gallery-right").addEventListener("click", () => {
        gallery.scrollBy({ left: 300, behavior: "smooth" });
    });
});
