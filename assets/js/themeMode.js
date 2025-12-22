(function () {
  function applyTheme(theme) {
    const prefersDark =
      window.matchMedia &&
      window.matchMedia("(prefers-color-scheme: dark)").matches;

    const shouldBeDark = theme === "dark" || (theme === "auto" && prefersDark);

    document.documentElement.classList.toggle("dark", shouldBeDark);
    document.documentElement.dataset.theme = theme;
    localStorage.setItem("theme", theme);
  }

  // Delegación: cualquier click en un elemento con data-theme-value
  document.addEventListener("click", (e) => {
    const btn = e.target.closest("[data-theme-value]");
    if (!btn) return;

    const theme = btn.getAttribute("data-theme-value");
    if (!theme) return;

    applyTheme(theme);
  });

  // Si estás en auto y cambia el tema del sistema, actualiza
  const mq =
    window.matchMedia && window.matchMedia("(prefers-color-scheme: dark)");
  if (mq && typeof mq.addEventListener === "function") {
    mq.addEventListener("change", () => {
      const saved = localStorage.getItem("theme") || "auto";
      if (saved === "auto") applyTheme("auto");
    });
  }
})();
