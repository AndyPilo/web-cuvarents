// assets/js/ui-offcanvas.js
document.addEventListener("DOMContentLoaded", () => {
  const body = document.body;

  const panel = document.querySelector("#mobileMenu");
  const backdrop = document.querySelector(
    "[data-offcanvas-backdrop='mobileMenu']"
  );
  const openButtons = document.querySelectorAll(
    "[data-offcanvas-open='mobileMenu']"
  );
  const closeButtons = document.querySelectorAll(
    "[data-offcanvas-close='mobileMenu']"
  );

  if (!panel || !backdrop) return;

  const DURATION = 300; // debe coincidir con duration-300

  function openOffcanvas() {
    // Mostrar elementos (display)
    panel.classList.remove("hidden");
    backdrop.classList.remove("hidden");

    // En el siguiente frame aplicar transición
    requestAnimationFrame(() => {
      panel.classList.remove("translate-x-full");
      backdrop.classList.remove("opacity-0");
    });

    body.classList.add("overflow-hidden", "offcanvas-open");
    panel.setAttribute("aria-hidden", "false");
  }

  function closeOffcanvas() {
    // Animar salida
    panel.classList.add("translate-x-full");
    backdrop.classList.add("opacity-0");

    body.classList.remove("overflow-hidden", "offcanvas-open");
    panel.setAttribute("aria-hidden", "true");

    // Al terminar la animación, ocultar (display:none)
    setTimeout(() => {
      panel.classList.add("hidden");
      backdrop.classList.add("hidden");
    }, DURATION);
  }

  openButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      openOffcanvas();
    });
  });

  closeButtons.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();
      closeOffcanvas();
    });
  });

  backdrop.addEventListener("click", (e) => {
    e.stopPropagation();
    closeOffcanvas();
  });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeOffcanvas();
  });

  panel.querySelectorAll("a[href]").forEach((link) => {
    link.addEventListener("click", () => closeOffcanvas());
  });
});
