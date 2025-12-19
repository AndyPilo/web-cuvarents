document.addEventListener("DOMContentLoaded", () => {
  const apiUrl = `${BASE_URL}/api/getGestorActivo.php`;

  fetch(apiUrl)
    .then((res) => res.json())
    .then((data) => {
      const phone = data.telefono;

      // 1. Actualizar teléfono en todos los .numbergestor (todas las vistas)
      const elements = document.querySelectorAll(".numbergestor");
      elements.forEach((el) => (el.textContent = phone || "No disponible"));

      // 2. Si no hay teléfono, no hacemos nada más
      if (!phone) return;

      // 3. Intentar localizar los elementos del botón WhatsApp (solo existen en home)
      const waBtn = document.getElementById("whatsapp-btn");
      const waLink = document.getElementById("whatsappLink");

      // Si NO estamos en el home (no existen estos elementos), salimos sin error
      if (!waBtn || !waLink) return;

      // 4. Configurar el enlace de WhatsApp (solo en homeView.php)
      const mensaje = encodeURIComponent(
        "Hola, estoy interesado en una renta 👋"
      );
      const waUrl = `https://wa.me/${phone}?text=${mensaje}`;

      waLink.setAttribute("href", waUrl);
      waBtn.style.display = "block";
    })
    .catch((err) => console.error("Error cargando gestor:", err));
});
