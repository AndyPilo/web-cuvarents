// assets/js/ui-accordion.js
document.addEventListener("DOMContentLoaded", () => {
  const accordions = document.querySelectorAll("[data-accordion]");

  accordions.forEach((accordion) => {
    const triggers = accordion.querySelectorAll("[data-accordion-trigger]");

    triggers.forEach((btn) => {
      btn.addEventListener("click", () => {
        const item = btn.closest("[data-accordion-item]");
        const panel = item.querySelector("[data-accordion-panel]");
        const expanded = btn.getAttribute("aria-expanded") === "true";

        // Cerrar todos los items dentro del mismo contenedor (comportamiento tipo acordeón)
        accordion
          .querySelectorAll("[data-accordion-item]")
          .forEach((otherItem) => {
            const otherBtn = otherItem.querySelector(
              "[data-accordion-trigger]"
            );
            const otherPanel = otherItem.querySelector(
              "[data-accordion-panel]"
            );

            if (otherBtn && otherPanel) {
              otherBtn.setAttribute("aria-expanded", "false");
              // colapsar panel
              otherPanel.style.maxHeight = "0px";
              otherItem.classList.remove("is-open");
            }
          });

        // Si éste estaba cerrado, abrirlo
        if (!expanded) {
          btn.setAttribute("aria-expanded", "true");
          panel.style.maxHeight = panel.scrollHeight + "px";
          item.classList.add("is-open");
        }
      });
    });
  });
});
