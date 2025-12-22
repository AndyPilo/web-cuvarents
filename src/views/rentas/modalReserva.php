<!-- Estilo para que el calendario salga en medio del input -->
<style>
  /* Centra el datepicker de Flatpickr respecto al input */
  .flatpickr-calendar {
    left: 50% !important;
    transform: translateX(-50%) !important;
  }

  /* Estilos para modo oscuro del calendar */
  .flatpickr-calendar {
    background: #1f2937 !important;
    border: 1px solid #374151 !important;
    color: #f3f4f6 !important;
  }

  .flatpickr-months,
  .flatpickr-weekdays {
    background: #111827 !important;
    border-bottom: 1px solid #374151 !important;
  }

  .flatpickr-month {
    color: #f3f4f6 !important;
  }

  .flatpickr-weekday {
    color: #9ca3af !important;
  }

  .flatpickr-day {
    color: #f3f4f6 !important;
  }

  .flatpickr-day:hover {
    background: #374151 !important;
    border-color: #4b5563 !important;
  }

  .flatpickr-day.selected,
  .flatpickr-day.startRange,
  .flatpickr-day.endRange,
  .flatpickr-day.selected.inRange,
  .flatpickr-day.startRange.inRange,
  .flatpickr-day.endRange.inRange,
  .flatpickr-day.selected:focus,
  .flatpickr-day.startRange:focus,
  .flatpickr-day.endRange:focus,
  .flatpickr-day.selected:hover,
  .flatpickr-day.startRange:hover,
  .flatpickr-day.endRange:hover {
    background: #0d9488 !important;
    border-color: #0d9488 !important;
    color: #ffffff !important;
  }

  .flatpickr-day.today {
    border-color: #0d9488 !important;
  }

  .flatpickr-day.today:hover {
    background: #0d9488 !important;
    color: #ffffff !important;
  }

  .flatpickr-calendar.arrowTop:before {
    border-bottom-color: #374151 !important;
  }

  .flatpickr-calendar.arrowTop:after {
    border-bottom-color: #1f2937 !important;
  }
</style>

<!-- ========================= -->
<!-- 🏠 Modal para enviar reserva -->
<!-- ========================= -->
<div
  id="addGestorModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20 dark:bg-black/60" <!-- antes bg-black/40 -->
  aria-hidden="true"
  >
  <div class="w-full max-w-md mx-4 md:mx-0" data-modal-dialog>
    <div class="rounded-2xl bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 overflow-hidden">
      <!-- Header -->
      <div class="flex items-start justify-between px-6 pt-5 pb-3 border-b border-gray-100 dark:border-gray-700">
        <h5 class="text-lg font-semibold text-gray-900 dark:text-white" id="addGestorModalLabel">
          Enviar reservación
        </h5>
        <button
          type="button"
          class="ml-3 inline-flex h-8 w-8 items-center justify-center rounded-full text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-300 dark:focus:ring-gray-600"
          data-modal-close
          aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <div class="px-6 py-5">
        <form
          id="sendReserveForm"
          data-rental-id="<?= htmlspecialchars($renta['rental_id']) ?>"
          autocomplete="off"
          class="space-y-4">
          <!-- Nombre -->
          <div>
            <label
              for="nombre"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Nombre y Apellidos
            </label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              required
              placeholder="Tu nombre completo"
              class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-gray-300 shadow-sm outline-none transition focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/40 dark:focus:ring-cyan-400/40 placeholder:text-gray-400 dark:placeholder:text-gray-500">
          </div>

          <!-- Fecha -->
          <div>
            <label
              for="fechaHospedaje"
              class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
              Fecha de hospedaje
            </label>
            <!--
              Se mantiene display:none porque tu integración actual con Flatpickr
              probablemente genera un input "bonito" aparte.
            -->
            <input
              type="text"
              id="fechaHospedaje"
              name="fechaHospedaje"
              required
              placeholder="Selecciona una fecha"
              style="display: none;"
              class="block w-full rounded-xl border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-sm text-gray-900 dark:text-gray-300 shadow-sm outline-none transition focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 focus:ring-cyan-500/40 dark:focus:ring-cyan-400/40">
          </div>

          <!-- Botón -->
          <button
            type="submit"
            class="mt-3 inline-flex w-full items-center justify-center rounded-full bg-gray-900 dark:bg-gray-700 px-4 py-2.5 text-sm font-semibold text-white dark:text-gray-300 shadow-sm transition hover:bg-black dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-900 dark:focus:ring-gray-600 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
            Enviar reserva
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script para controlar el modal sin Bootstrap -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addGestorModal');
    if (!modal) return;

    // Botones que abren el modal (cambiamos a data-modal-open para no depender de Bootstrap)
    const openButtons = document.querySelectorAll('[data-modal-open="addGestorModal"]');
    // Botones que cierran el modal
    const closeButtons = modal.querySelectorAll('[data-modal-close]');
    const body = document.body;

    function openModal() {
      modal.classList.remove('hidden');
      modal.classList.add('flex');
      body.classList.add('overflow-hidden');
      modal.setAttribute('aria-hidden', 'false');
    }

    function closeModal() {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
      body.classList.remove('overflow-hidden');
      modal.setAttribute('aria-hidden', 'true');
    }

    openButtons.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        openModal();
      });
    });

    closeButtons.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        closeModal();
      });
    });

    // Cerrar al hacer click en el fondo
    modal.addEventListener('click', function(e) {
      if (e.target === modal) {
        closeModal();
      }
    });

    // Cerrar con ESC
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
        closeModal();
      }
    });
  });
</script>