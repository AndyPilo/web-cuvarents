document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("addGestorModal");
  const form = document.getElementById("sendReserveForm");

  if (!modal || !form) return;

  // ✅ Inicializar Flatpickr una única vez (sin Bootstrap)
  if (typeof flatpickr !== "undefined" && !modal.dataset.flatpickrInitialized) {
    flatpickr("#fechaHospedaje", {
      mode: "range",
      dateFormat: "Y-m-d",
      minDate: "today",
      inline: true, // calendario incrustado dentro del modal
    });
    modal.dataset.flatpickrInitialized = "true";
  }

  // ✅ Enviar reserva por WhatsApp (tal cual lo tenías)
  form.addEventListener("submit", async (event) => {
    event.preventDefault();

    const nombre = form.nombre.value.trim();
    const fechaHospedaje = form.fechaHospedaje.value.trim();
    const rentalId = form.dataset.rentalId || 0;
    const currentUrl = window.location.href;

    if (!nombre || !fechaHospedaje) {
      alert("Por favor completa todos los campos antes de enviar la reserva.");
      return;
    }

    const [fechaEntrada, fechaSalida] = fechaHospedaje.split(" to ");

    try {
      const res = await fetch(
        `${BASE_URL}/api/getRentalAndGestor.php?rental_id=${rentalId}`
      );
      const data = await res.json();

      console.log(data);

      if (data.telefono && data.rental) {
        const mensaje =
          `Hola, me gustaría reservar la renta:\n\n` +
          `*${data.rental.rental_title}*\n` +
          `Precio: ${data.rental.rental_price} (${data.rental.rental_price_type})\n` +
          `Ubicación: ${data.rental.rental_provincia}, ${data.rental.rental_municipio}\n` +
          `Tipo de Renta: ${data.rental.type_time_rent}\n\n` +
          `Enlace de la renta: ${currentUrl}\n\n` +
          `Nombre del cliente: ${nombre}\n` +
          `Fecha de entrada: ${fechaEntrada}\n` +
          `Fecha de salida: ${fechaSalida}`;

        const whatsappUrl = `https://wa.me/${
          data.telefono
        }?text=${encodeURIComponent(mensaje)}`;
        window.location.href = whatsappUrl;
      } else {
        alert("No hay gestores activos disponibles.");
      }
    } catch (err) {
      console.error(err);
      alert("Ocurrió un error al enviar la reserva.");
    }
  });
});
