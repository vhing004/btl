// BANNER
$(document).ready(function () {
  $(".banner").slick({
    slidesToShow: 1,
    slideToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    draggable: true,
    speed: 800,
    dots: true,
    arrows: false,
  });
});

// COURSE
const item = document.querySelectorAll(".course_item");
document.addEventListener("scroll", () => {
  item.forEach((event) => {
    const ex = event.getBoundingClientRect();
    if (ex.top < window.innerHeight - 50) {
      event.classList.add("animate");
    } else {
      event.classList.remove("animate");
    }
  });
});

// Cuộn lên đầu trang
const scrollToTopBtn = document.getElementById("scrollToTop");
window.addEventListener("scroll", () => {
  if (window.scrollY > 1000) {
    scrollToTopBtn.style.display = "block";
  } else {
    scrollToTopBtn.style.display = "none";
  }
});

scrollToTopBtn.addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});
