document.addEventListener("DOMContentLoaded", function () {
  const hamburgerBtn = document.getElementById("hamburger-btn");
  const crossBtn = document.getElementById("cross-btn");
  const navMenu = document.getElementById("nav-menu");

  const toggleMenu = () => {
    navMenu.classList.toggle("active");
    hamburgerBtn.classList.toggle("active");
    crossBtn.classList.toggle("active");
    document.body.classList.toggle("no-scroll");
  };

  const closeMenu = () => {
    hamburgerBtn.classList.remove("hidden");
    crossBtn.classList.add("hidden");
    document.body.classList.remove("no-scroll");
  };

  hamburgerBtn.addEventListener("click", toggleMenu);
  crossBtn.addEventListener("click", toggleMenu);

  // close the nav menu when the window resize
  window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
      closeMenu();
    }
  });
});
