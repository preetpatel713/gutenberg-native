/* ================================
    Header - Hamburger Menu
  ================================ */
const menuToggle = document.querySelector(".menu-toggle");
const headerMenu = document.querySelector(".header-menu");

if (menuToggle && headerMenu) {
  const setMenuOpen = (open) => {
    document.body.classList.toggle("menu-open", open);
    document.body.classList.toggle("pause", open);
    menuToggle.setAttribute("aria-expanded", open);
    menuToggle.setAttribute("aria-label", open ? "Close menu" : "Open menu");
  };

  menuToggle.addEventListener("click", () => {
    setMenuOpen(!document.body.classList.contains("menu-open"));
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") setMenuOpen(false);
  });

  // Close the panel when tapping anywhere outside it
  document.addEventListener("click", (e) => {
    if (!document.body.classList.contains("menu-open")) return;
    if (headerMenu.contains(e.target) || menuToggle.contains(e.target)) return;
    setMenuOpen(false);
  });

  // Close the panel if the screen is resized up to desktop
  window.matchMedia("(min-width: 1200px)").addEventListener("change", (e) => {
    if (e.matches) setMenuOpen(false);
  });

  // One listener for every submenu arrow, so items added from the WordPress menu work too
  headerMenu.addEventListener("click", (e) => {
    const arrow = e.target.closest(".menu-arrow");
    if (!arrow) return;

    const open = arrow
      .closest(".menu-item-has-children")
      .classList.toggle("submenu-open");
    arrow.setAttribute("aria-expanded", open);
  });
}

/* ================================
    Our Services - Marquee Slider
  ================================ */
const MARQUEE_SPEED = 9000;

const initMarquee = (selector, reverse) => {
  const el = document.querySelector(selector);
  if (!el) return;

  const swiper = new Swiper(el, {
    loop: true,
    slidesPerView: "auto",
    spaceBetween: 24,
    speed: MARQUEE_SPEED,
    allowTouchMove: true,
    autoplay: {
      delay: 0,
      disableOnInteraction: false,
      reverseDirection: reverse,
    },
  });

  el.addEventListener("mouseenter", () => {
    swiper.autoplay.stop();
    const x = new DOMMatrix(getComputedStyle(swiper.wrapperEl).transform).m41;
    swiper.setTransition(0);
    swiper.setTranslate(x);
  });

  el.addEventListener("mouseleave", () => {
    const target = -swiper.slidesGrid[swiper.activeIndex];
    const step = swiper.slidesSizesGrid[swiper.activeIndex] + swiper.params.spaceBetween;
    const duration = (Math.abs(target - swiper.translate) / step) * MARQUEE_SPEED;

    swiper.slideTo(swiper.activeIndex, duration);
    swiper.once("transitionEnd", () => swiper.autoplay.start());
  });
};

initMarquee(".marquee-top", false);
initMarquee(".marquee-bottom", true);
