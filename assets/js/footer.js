document.addEventListener("DOMContentLoaded", () => {
  // Aplica gradientes aleatorios a elementos con .bg-gradient-al
  const elements = document.querySelectorAll(".bg-gradient-al");
  const randomColor = () =>
    `#${Math.floor(Math.random() * 16777215).toString(16)}`;

  elements.forEach((el) => {
    const color1 = randomColor();
    const color2 = randomColor();
    el.style.backgroundImage = `linear-gradient(45deg, ${color1}, ${color2})`;
  });

  // Scroll top
  document.querySelectorAll(".btn-scroll-top").forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  });
});
