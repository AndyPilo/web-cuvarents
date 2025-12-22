<aside class="w-full">
  <!-- Card principal -->
  <div class="rounded-3xl bg-white dark:bg-gray-800 shadow-md dark:shadow-gray-900/50 border border-gray-100 dark:border-gray-700 overflow-hidden">
    <div class="px-5 py-6">

      <h5 class="mb-5 text-center text-lg font-semibold text-gray-900 dark:text-white">
        Reservar esta propiedad
      </h5>

      <!-- Botón principal -->
      <button
        type="button"
        class="mb-3 inline-flex w-full items-center justify-center rounded-full bg-cyan-500 dark:bg-cyan-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-600 dark:hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900"
        data-modal-open="addGestorModal">
        <i class="fi-calendar-check mr-2"></i> Reservar ahora
      </button>

      <div class="mb-3 text-center text-xs text-gray-500 dark:text-gray-400">
        Tu solicitud será enviada a nuestros gestores
      </div>

      <!-- Separador -->
      <div class="mb-3 flex items-center justify-center text-gray-400 dark:text-gray-500 text-xs">
        <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
        <span class="px-3 font-medium text-gray-500 dark:text-gray-400">o</span>
        <div class="h-px flex-1 bg-gray-200 dark:bg-gray-700"></div>
      </div>

      <!-- Botón de WhatsApp -->
      <button
        type="button"
        class="inline-flex w-full items-center justify-center rounded-full border border-gray-800 dark:border-gray-600 px-4 py-2.5 text-sm font-medium text-gray-900 dark:text-gray-300 transition hover:bg-gray-900 dark:hover:bg-gray-700 hover:text-white dark:hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
        id="contactBtn">
        <i class="fi-whatsapp mr-2 text-green-500 dark:text-green-400"></i>
        Envíanos un mensaje
      </button>

      <div class="mt-3 text-center text-xs text-gray-500 dark:text-gray-400">
        Respuesta rápida por WhatsApp
      </div>
    </div>
  </div>

  <!-- Script de WhatsApp -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const btn = document.getElementById('contactBtn');
      if (!btn) return;

      btn.addEventListener('click', async function() {
        try {
          const res = await fetch(`${BASE_URL}/api/getGestorActivo.php`);
          const data = await res.json();

          if (!data.telefono) {
            alert('No hay gestores activos disponibles en este momento.');
            return;
          }

          const telefono = data.telefono.replace(/\D/g, ''); // Limpia caracteres no numéricos
          const mensaje = "Hola, vengo desde el sitio CuVaRents y quiero más información sobre una renta.";
          const encoded = encodeURIComponent(mensaje);
          const whatsappUrl = `https://wa.me/${telefono}?text=${encoded}`;

          // ✅ Importante: usar window.location.href (no window.open)
          window.location.href = whatsappUrl;

        } catch (error) {
          console.error('Error al contactar gestor:', error);
          alert('Error al contactar con el gestor.');
        }
      });
    });
  </script>
</aside>