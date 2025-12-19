<!-- Estilo para que el calendario salga en medio del input -->
<style>
  /* Centra el datepicker de Flatpickr respecto al input */
  .flatpickr-calendar {
    left: 50% !important;
    transform: translateX(-50%) !important;
  }
</style>

<!-- ========================= -->
<!-- 🏠 Modal para enviar reserva -->
<!-- ========================= -->
<div
  id="addGestorModal"
  class="fixed inset-0 z-50 hidden items-center justify-center bg-black/20" <!-- antes bg-black/40 -->
  aria-hidden="true"
  >
  <div class="w-full max-w-md mx-4 md:mx-0" data-modal-dialog>
    <div class="rounded-2xl bg-white shadow-2xl border border-gray-100 overflow-hidden">
      <!-- Header -->
      <div class="flex items-start justify-between px-6 pt-5 pb-3 border-b border-gray-100">
        <h5 class="text-lg font-semibold text-gray-900" id="addGestorModalLabel">
          Enviar reservación
        </h5>
        <button
          type="button"
          class="ml-3 inline-flex h-8 w-8 items-center justify-center rounded-full text-gray-400 hover:text-gray-600 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-300"
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
              class="block text-sm font-medium text-gray-700 mb-1">
              Nombre y Apellidos
            </label>
            <input
              type="text"
              id="nombre"
              name="nombre"
              required
              placeholder="Tu nombre completo"
              class="block w-full rounded-xl border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40">
          </div>

          <!-- Fecha -->
          <div>
            <label
              for="fechaHospedaje"
              class="block text-sm font-medium text-gray-700 mb-1">
              Fecha de hospedaje
            </label>
            <!--
              Se mantiene display:none porque tu integración actual con Flatpickr
              probablemente genera un input “bonito” aparte.
            -->
            <input
              type="text"
              id="fechaHospedaje"
              name="fechaHospedaje"
              required
              placeholder="Selecciona una fecha"
              style="display: none;"
              class="block w-full rounded-xl border border-gray-300 px-3 py-2 text-sm text-gray-900 shadow-sm outline-none transition focus:border-cyan-500 focus:ring-2 focus:ring-cyan-500/40">
          </div>

          <!-- Botón -->
          <button
            type="submit"
            class="mt-3 inline-flex w-full items-center justify-center rounded-full bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-black focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-offset-2">
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