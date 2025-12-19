// assets/js/ui-offcanvas-filters.js
document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;

  const panel = document.getElementById("filtersOffcanvas");
  const backdrop = document.querySelector(
    '[data-offcanvas-backdrop="filtersOffcanvas"]'
  );

  const openButtons = document.querySelectorAll(
    '[data-offcanvas-open="filtersOffcanvas"]'
  );
  const closeButtons = document.querySelectorAll(
    '[data-offcanvas-close="filtersOffcanvas"]'
  );

  if (!panel || !backdrop) return;

  function open() {
    panel.classList.remove("translate-y-full");
    backdrop.classList.remove("hidden");
    body.classList.add("overflow-hidden");
  }

  function close() {
    panel.classList.add("translate-y-full");
    backdrop.classList.add("hidden");
    body.classList.remove("overflow-hidden");
  }

  openButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      open();
    });
  });

  closeButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      close();
    });
  });

  backdrop.addEventListener("click", close);

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") close();
  });
});
