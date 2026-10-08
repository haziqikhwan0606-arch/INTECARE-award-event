 const mySwiper = new Swiper(".swiper-container", {
    direction: "vertical",
    loop: true,
    speed: 1000,
    grabCursor: true,
    parallax: true,

    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    mousewheel: true,

    autoplay: true,
  });