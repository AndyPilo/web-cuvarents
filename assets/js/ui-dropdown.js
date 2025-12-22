// assets/js/ui-dropdown.js
document.addEventListener("DOMContentLoaded", () => {
  const DURATION = 150;
  const dropdowns = Array.from(document.querySelectorAll("[data-dropdown]"));
  const root = document.documentElement;

  // -------------------------
  // THEME (Tailwind dark mode)
  // -------------------------
  const media = window.matchMedia("(prefers-color-scheme: dark)");

  function applyTheme(value) {
    // value: "light" | "dark" | "auto"
    localStorage.setItem("theme", value);

    const shouldBeDark =
      value === "dark" || (value === "auto" && media.matches);

    root.classList.toggle("dark", shouldBeDark);
    root.setAttribute("data-theme", value);
  }

  // Aplica tema inicial
  applyTheme(localStorage.getItem("theme") || "auto");

  // Si cambia el tema del sistema y estás en auto, actualiza
  if (typeof media.addEventListener === "function") {
    media.addEventListener("change", () => {
      if ((localStorage.getItem("theme") || "auto") === "auto")
        applyTheme("auto");
    });
  } else {
    // Safari viejo
    media.addListener(() => {
      if ((localStorage.getItem("theme") || "auto") === "auto")
        applyTheme("auto");
    });
  }

  // -------------------------
  // DROPDOWN (Tailwind)
  // -------------------------
  function closeDropdown(dd) {
    const btn = dd.querySelector("[data-dropdown-trigger]");
    const menu = dd.querySelector("[data-dropdown-menu]");
    if (!btn || !menu) return;

    btn.setAttribute("aria-expanded", "false");

    menu.classList.add("opacity-0", "scale-95", "pointer-events-none");
    setTimeout(() => menu.classList.add("hidden"), DURATION);
  }

  function openDropdown(dd) {
    // cerrar otros
    dropdowns.forEach((x) => {
      if (x !== dd) closeDropdown(x);
    });

    const btn = dd.querySelector("[data-dropdown-trigger]");
    const menu = dd.querySelector("[data-dropdown-menu]");
    if (!btn || !menu) return;

    btn.setAttribute("aria-expanded", "true");

    menu.classList.remove("hidden");
    requestAnimationFrame(() => {
      menu.classList.remove("opacity-0", "scale-95", "pointer-events-none");
    });
  }

  dropdowns.forEach((dd) => {
    const btn = dd.querySelector("[data-dropdown-trigger]");
    const menu = dd.querySelector("[data-dropdown-menu]");
    if (!btn || !menu) return;

    // Estado inicial
    menu.classList.add(
      "hidden",
      "opacity-0",
      "scale-95",
      "pointer-events-none"
    );

    // Toggle
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      e.stopPropagation();

      const isOpen = btn.getAttribute("aria-expanded") === "true";
      if (isOpen) closeDropdown(dd);
      else openDropdown(dd);
    });

    // Click dentro del menú NO debe cerrar por el handler global
    menu.addEventListener("click", (e) => e.stopPropagation());

    // ✅ Tema: manejar dentro del menú (porque stopPropagation impide que llegue a document)
    menu.addEventListener("click", (e) => {
      const themeBtn = e.target.closest("[data-theme-value]");
      if (!themeBtn) return;

      const value = themeBtn.getAttribute("data-theme-value");
      if (!value) return;

      applyTheme(value);
      closeDropdown(dd); // opcional: cerrar al elegir tema
    });

    // ✅ SOLO cerrar si el usuario hace click en un elemento marcado explícitamente
    menu.addEventListener("click", (e) => {
      const closeEl = e.target.closest("[data-dropdown-close]");
      if (closeEl) closeDropdown(dd);
    });

    // ✅ Si hay enlaces reales, puedes cerrar (aunque normalmente navegará)
    menu.querySelectorAll("a[href]").forEach((a) => {
      a.addEventListener("click", () => closeDropdown(dd));
    });
  });

  // Click fuera: cierra todo
  document.addEventListener("click", () => dropdowns.forEach(closeDropdown));

  // ESC: cierra todo
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape") dropdowns.forEach(closeDropdown);
  });

  // Resize: cierra todo
  window.addEventListener("resize", () => dropdowns.forEach(closeDropdown));

  // ❌ IMPORTANTE:
  // Ya NO hacemos: document.addEventListener("click", ...data-theme-value...)
  // porque el menú detiene la propagación y nunca llegaba aquí.
});
