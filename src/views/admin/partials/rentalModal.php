<!-- rentalModal.php -->

<!-- Modal (Tailwind) -->
<div
  class="fixed inset-0 z-50 hidden overflow-y-auto"
  id="addRentalModal"
  tabindex="-1"
  aria-hidden="true"
  role="dialog"
  aria-modal="true"
  aria-labelledby="addRentalModalLabel">
  <!-- Overlay -->
  <div class="fixed inset-0 bg-black/50" data-modal-overlay></div>

  <!-- Dialog wrapper (permite scroll en pantallas pequeñas) -->
  <div class="relative mx-auto flex min-h-full w-full items-start justify-center px-3 py-6">
    <div
      class="w-full max-w-6xl overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/10 flex flex-col max-h-[90vh]"
      data-modal-panel>
      <!-- Header -->
      <div class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6 flex-none">
        <h5 class="text-lg font-semibold text-gray-900" id="addRentalModalLabel">Agregar Renta</h5>
        <button
          type="button"
          class="inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900"
          aria-label="Cerrar"
          data-modal-close>
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6L6 18"></path>
            <path d="M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Body -->
      <div class="px-4 py-5 sm:px-6 flex-1 overflow-y-auto">
        <form
          id="addRentalForm"
          action="<?= BASE_URL ?>dashboard/rents/store"
          method="POST"
          enctype="multipart/form-data"
          class="space-y-4">
          <!-- Título -->
          <div>
            <label for="rentalTitle" class="mb-1 block text-sm font-medium text-gray-900">Título de la Renta</label>
            <input
              type="text"
              id="rentalTitle"
              name="rentalTitle"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
          </div>

          <!-- Descripción -->
          <div>
            <label for="rentalDescription" class="mb-1 block text-sm font-medium text-gray-900">Descripción</label>
            <textarea
              id="rentalDescription"
              name="rentalDescription"
              required
              class="min-h-[120px] w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"></textarea>
          </div>

          <!-- Categoría -->
          <div>
            <label for="rentalCategory" class="mb-1 block text-sm font-medium text-gray-900">Categoría de renta</label>
            <select
              id="rentalCategory"
              name="rentalCategory"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
              <option value="" selected>Seleccione</option>
              <option value="Casas de lujo">Casas de lujo</option>
              <option value="Casas en la playa">Casas en la playa</option>
              <option value="Casas y Apartamentos por largas y cortas estancias">
                Casas y Apartamentos por largas y cortas estancias
              </option>
              <option value="Casas y Alojamientos vacacionales">Casas y Alojamientos vacacionales</option>
            </select>
          </div>

          <!-- Precio + tipo -->
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label for="rentalPrice" class="mb-1 block text-sm font-medium text-gray-900">Precio</label>
              <input
                type="number"
                id="rentalPrice"
                name="rentalPrice"
                required
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
            </div>

            <div>
              <label for="rentalPriceType" class="mb-1 block text-sm font-medium text-gray-900">Tipo de Precio</label>
              <select
                id="rentalPriceType"
                name="rentalPriceType"
                required
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
                <option value="" selected>Seleccione</option>
                <option value="día / habitación">Día/Habitación</option>
                <option value="semanal / habitación">Semanal/Habitación</option>
                <option value="mensual / habitación">Mensual/Habitación</option>
                <option value="día / casa">Día/Casa</option>
                <option value="semanal / casa">Semanal/Casa</option>
                <option value="mensual / casa">Mensual/Casa</option>
              </select>
            </div>
          </div>

          <!-- Ubicación libre (oculto, mismo que antes) -->
          <div class="hidden">
            <label for="rentalLocation" class="mb-1 block text-sm font-medium text-gray-900">Ubicación</label>
            <input
              type="text"
              id="rentalLocation"
              name="rentalLocation"
              class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
          </div>

          <!-- Habitaciones / capacidad -->
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
            <div>
              <label for="habitaciones" class="mb-1 block text-sm font-medium text-gray-900">Habitaciones</label>
              <input
                type="number"
                name="habitaciones"
                id="habitaciones"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
            </div>
            <div>
              <label for="capacidad" class="mb-1 block text-sm font-medium text-gray-900">Capacidad de renta</label>
              <input
                type="number"
                name="capacidad"
                id="capacidad"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
            </div>
          </div>

          <!-- Provincia / Municipio -->
          <div class="grid grid-cols-1 gap-4 md:grid-cols-2 ubi-content">
            <div>
              <label for="provincia1" class="mb-1 block text-sm font-medium text-gray-900">Provincia</label>
              <select
                id="provincia1"
                name="provincia1"
                tabindex="-1"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
                <option value="" selected>Provincia</option>
                <option value="Pinar del Río">Pinar del Río</option>
                <option value="Artemisa">Artemisa</option>
                <option value="La Habana">La Habana</option>
                <option value="Mayabeque">Mayabeque</option>
                <option value="Matanzas">Matanzas</option>
                <option value="Cienfuegos">Cienfuegos</option>
                <option value="Villa Clara">Villa Clara</option>
                <option value="Sancti Spíritus">Sancti Spíritus</option>
                <option value="Ciego de Ávila">Ciego de Ávila</option>
                <option value="Camagüey">Camagüey</option>
                <option value="Las Tunas">Las Tunas</option>
                <option value="Granma">Granma</option>
                <option value="Holguín">Holguín</option>
                <option value="Santiago de Cuba">Santiago de Cuba</option>
                <option value="Guantánamo">Guantánamo</option>
              </select>
            </div>

            <div>
              <label for="municipio1" class="mb-1 block text-sm font-medium text-gray-900">Zonas</label>
              <select
                name="municipio1"
                id="municipio1"
                tabindex="-1"
                class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
                <option value="" selected>Seleccione una zona</option>
                <option value="Viñales">Viñales</option>
                <option value="La Habana">La Habana</option>
                <option value="Vedado">Vedado</option>
                <option value="Playa">Playa</option>
                <option value="SibONEY">Siboney</option>
                <option value="Miramar">Miramar</option>
                <option value="Santa Fe">Santa Fe</option>
                <option value="Centro Habana">Centro Habana</option>
                <option value="Habana Vieja">Habana Vieja</option>
                <option value="Guanabo">Guanabo</option>
                <option value="Boca Ciega">Boca Ciega</option>
                <option value="Brisas del Mar">Brisas del Mar</option>
                <option value="Santa Maria">Santa María</option>
                <option value="Varadero">Varadero</option>
                <option value="Boca Camarioca">Boca Camarioca</option>
                <option value="Cienaga de Zapata">Ciénaga de Zapata</option>
                <option value="Santa Marta">Santa Marta</option>
                <option value="Trinidad">Trinidad</option>
                <option value="Guarda la Vaca">Guarda la Vaca</option>
              </select>
            </div>
          </div>

          <!-- Tipo de renta -->
          <div>
            <label for="typeTimeRent" class="mb-1 block text-sm font-medium text-gray-900">Tipo de Renta</label>
            <select
              id="typeTimeRent"
              name="typeTimeRent"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
              <option value="" selected>Seleccione</option>
              <option value="Tiempo limitado">Tiempo limitado</option>
              <option value="Tiempo indefinido">Tiempo indefinido</option>
            </select>
          </div>

          <!-- Servicios -->
          <div class="services-content">
            <label class="mb-3 block text-sm font-medium text-gray-900">Servicios</label>
            <div class="grid grid-cols-1 gap-2 sm:grid-cols-2" id="servicesCheckboxes">
              <!-- Se cargan dinámicamente -->
            </div>
          </div>

          <!-- Imágenes existentes (solo al editar) -->
          <div class="hidden mt-4" id="existingImagesContainer">
            <label class="block text-sm font-medium text-gray-900">Imágenes de renta</label>
            <div id="existingImages" class="mt-2 flex flex-wrap gap-2">
              <!-- Se rellena desde JS -->
            </div>
          </div>

          <!-- Subida de imágenes nuevas -->
          <div class="containerx images-content" style="margin-top: 70px;">
            <div class="folder">
              <div class="front-side">
                <div class="tip"></div>
                <div class="cover"></div>
              </div>
              <div class="back-side cover"></div>
            </div>

            <label class="custom-file-upload">
              <input
                type="file"
                class="title"
                id="rentalImages"
                name="rentalImages[]"
                multiple
                accept="image/*"
                onchange="previewImages(event)" />
              Agregar fotos de renta
            </label>

            <div id="imagePreview" class="mt-2 flex flex-wrap gap-2">
              <!-- Previsualizaciones -->
            </div>
          </div>

          <button
            type="submit"
            class="mt-3 w-full rounded-full bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">
            Guardar
          </button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Provincias / Municipios -->
<script src="<?= BASE_URL ?>assets/js/provinciasData.js"></script>

<script>
  // ==============================
  //  MODAL Tailwind (reemplazo bootstrap.Modal)
  // ==============================
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('addRentalModal');
    const panel = modal?.querySelector('[data-modal-panel]');
    const overlay = modal?.querySelector('[data-modal-overlay]');
    const closeBtns = modal?.querySelectorAll('[data-modal-close]') || [];

    function openModal() {
      if (!modal) return;
      modal.classList.remove('hidden');
      modal.setAttribute('aria-hidden', 'false');
      document.documentElement.classList.add('overflow-hidden');

      // foco básico (opcional)
      setTimeout(() => {
        const first = modal.querySelector('input, textarea, select, button');
        first?.focus?.();
      }, 0);
    }

    function closeModal() {
      if (!modal) return;
      modal.classList.add('hidden');
      modal.setAttribute('aria-hidden', 'true');
      document.documentElement.classList.remove('overflow-hidden');

      // Disparar evento custom para “reset al cerrar”
      modal.dispatchEvent(new CustomEvent('modal:closed'));
    }

    overlay?.addEventListener('click', closeModal);
    closeBtns.forEach(b => b.addEventListener('click', closeModal));

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
    });

    // Exponer helpers para reuso desde la lógica existente
    window.__openAddRentalModal = openModal;
    window.__closeAddRentalModal = closeModal;
  });

  // ==============================
  //  PREVIEW IMÁGENES (misma lógica)
  // ==============================
  function previewImages(event) {
    const files = event.target.files;
    const preview = document.getElementById('imagePreview');
    preview.innerHTML = '';

    if (!files || files.length === 0) return;

    const maxPreview = 3;

    for (let i = 0; i < files.length && i < maxPreview; i++) {
      const file = files[i];
      const reader = new FileReader();

      reader.onload = function(e) {
        const img = document.createElement('img');
        img.src = e.target.result;
        img.alt = 'Imagen de renta';
        img.className = 'm-1 rounded-lg border border-gray-200 shadow-sm';
        img.style.width = '100px';
        img.style.height = '100px';
        img.style.objectFit = 'cover';
        preview.appendChild(img);
      };

      reader.readAsDataURL(file);
    }

    if (files.length > maxPreview) {
      const remainingCount = files.length - maxPreview;
      const moreDiv = document.createElement('div');
      moreDiv.className = 'm-1 flex items-center justify-center rounded-lg border border-gray-200 bg-gray-50 text-sm text-gray-700 shadow-sm';
      moreDiv.style.width = '100px';
      moreDiv.style.height = '100px';
      moreDiv.innerHTML = `<span>+${remainingCount} más</span>`;
      preview.appendChild(moreDiv);
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    const BASE_URL = '<?= BASE_URL ?>';

    // ==============================
    //  BOTÓN "AGREGAR RENTA" (aggrent)
    // ==============================
    const aggrentButton = document.getElementById('aggrent');
    if (aggrentButton) {
      aggrentButton.addEventListener('click', function() {
        const form = document.getElementById('addRentalForm');

        // Modo "Agregar"
        form.reset();
        form.action = BASE_URL + 'dashboard/rents/store';
        document.getElementById('addRentalModalLabel').textContent = 'Agregar Renta';

        // Reset municipio
        const municipioSelect = document.getElementById('municipio1');
        if (municipioSelect) {
          municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
          municipioSelect.disabled = true;
        }

        // Limpiar servicios
        const servicesCheckboxes = document.getElementById('servicesCheckboxes');
        if (servicesCheckboxes) servicesCheckboxes.innerHTML = '';

        // Limpiar habitaciones / capacidad
        const habEl = document.getElementById('habitaciones');
        const capEl = document.getElementById('capacidad');
        if (habEl) habEl.value = '';
        if (capEl) capEl.value = '';

        // Cargar servicios sin ninguno seleccionado
        cargarServicios([]);

        // Mostrar contenedores ocultos en modo edición
        document.querySelectorAll('.images-content').forEach(c => c.classList.remove('hidden'));

        // Limpiar preview
        const imgPrev = document.getElementById('imagePreview');
        if (imgPrev) imgPrev.innerHTML = '';

        // Limpiar marcas de imágenes a borrar
        imagesToDelete = [];

        // Abrir modal (Tailwind)
        window.__openAddRentalModal?.();
      });
    }

    // ==============================
    //  EDITAR RENTAS (botones .edit-rental-btn)
    // ==============================
    const editButtons = document.querySelectorAll('.edit-rental-btn');

    editButtons.forEach(button => {
      button.addEventListener('click', function() {
        const rentalId = this.getAttribute('data-rental-id');
        if (!rentalId) return;

        fetch(BASE_URL + 'dashboard/rents/getRent?id=' + rentalId)
          .then(response => {
            if (!response.ok) throw new Error('Error en la solicitud: ' + response.statusText);
            return response.json();
          })
          .then(data => {
            if (data.error) {
              console.error(data.error);
              return;
            }

            // Llenar campos
            document.getElementById('rentalTitle').value = data.rentalTitle;
            document.getElementById('rentalDescription').value = data.rentalDescription;
            document.getElementById('rentalPrice').value = data.rentalPrice;
            document.getElementById('rentalPriceType').value = data.rentalPriceType;
            document.getElementById('typeTimeRent').value = data.typeTimeRent;
            document.getElementById('rentalLocation').value = data.rentalLocation;
            document.getElementById('rentalCategory').value = data.category;
            document.getElementById('provincia1').value = data.provincia;
            document.getElementById('habitaciones').value = data.habitaciones;
            document.getElementById('capacidad').value = data.capacidad;

            // Provincias / municipios
            cargarMunicipios(data.provincia, data.municipio);

            // Servicios seleccionados
            cargarServicios(data.selectedServices);

            // Imágenes existentes
            loadExistingImages(data.images || []);

            // Cambiar acción del formulario a "editar"
            const form = document.getElementById('addRentalForm');
            form.action = BASE_URL + 'dashboard/rents/update?id=' + rentalId;
            document.getElementById('addRentalModalLabel').textContent = 'Editar Renta';

            // Abrir modal (Tailwind)
            window.__openAddRentalModal?.();
          })
          .catch(error => console.error('Error:', error));
      });
    });

    // ==============================
    //  PROVINCIA -> MUNICIPIOS
    // ==============================
    const provinciaSelect = document.getElementById('provincia1');
    if (provinciaSelect) {
      provinciaSelect.addEventListener('change', function() {
        cargarMunicipios(this.value);
      });
    }

    function cargarMunicipios(provincia, selectedMunicipio = '') {
      const municipioSelect = document.getElementById('municipio1');
      if (!municipioSelect) return;

      municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
      municipioSelect.disabled = false;

      if (provincia && provinciasMunicipios[provincia]) {
        provinciasMunicipios[provincia].forEach(municipio => {
          const option = document.createElement('option');
          option.value = municipio;
          option.text = municipio;
          if (municipio === selectedMunicipio) option.selected = true;
          municipioSelect.appendChild(option);
        });
      }
    }

    // ==============================
    //  CARGAR SERVICIOS (AJAX)
    // ==============================
    function cargarServicios(selectedServices) {
      fetch(BASE_URL + 'dashboard/services/json')
        .then(response => response.json())
        .then(services => {
          const servicesContainer = document.getElementById('servicesCheckboxes');
          if (!servicesContainer) return;
          servicesContainer.innerHTML = '';

          services.forEach(service => {
            const isChecked =
              Array.isArray(selectedServices) &&
              selectedServices.includes(Number(service.id)) ?
              'checked' :
              '';

            const checkbox = `
              <div class="col-6 checkbox-wrapper-16">
                <label class="checkbox-wrapper">
                  <input
                    class="checkbox-input"
                    type="checkbox"
                    value="${service.id}"
                    id="service_${service.id}"
                    name="services[]"
                    ${isChecked}
                  >
                  <span class="checkbox-tile">
                    <span class="checkbox-icon">${service.icon}</span>
                    <span class="small">${service.name}</span>
                  </span>
                </label>
              </div>
            `;
            servicesContainer.insertAdjacentHTML('beforeend', checkbox);
          });
        })
        .catch(error => console.error('Error:', error));
    }

    // ==============================
    //  IMÁGENES EXISTENTES + ELIMINACIÓN
    // ==============================
    window.loadExistingImages = function(images) {
      const existingImagesDiv = document.getElementById('existingImages');
      const existingImagesContainer = document.getElementById('existingImagesContainer');

      if (!existingImagesDiv || !existingImagesContainer) return;

      existingImagesDiv.innerHTML = '';

      if (images && images.length > 0) {
        existingImagesContainer.classList.remove('hidden');

        images.forEach(img => {
          const wrapper = document.createElement('div');
          wrapper.className = 'relative m-1 h-[150px] w-[150px]';

          wrapper.innerHTML = `
            <img
              src="${BASE_URL}uploads/${img.url}"
              class="h-[150px] w-[150px] rounded-lg border border-gray-200 object-cover shadow-sm"
              alt="Imagen de renta"
            >
            <button
              type="button"
              class="remove-image-btn absolute right-1 top-1"
              data-image-id="${img.id}"
              aria-label="Quitar imagen"
            >
              ✖
            </button>
          `;
          existingImagesDiv.appendChild(wrapper);
        });
      } else {
        existingImagesContainer.classList.add('hidden');
      }
    };

    // Array global para IDs de imágenes a eliminar
    window.imagesToDelete = [];

    const existingImagesDiv = document.getElementById('existingImages');
    if (existingImagesDiv) {
      existingImagesDiv.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-image-btn')) {
          const wrapper = e.target.parentElement;
          const imageId = e.target.getAttribute('data-image-id');

          if (imageId) imagesToDelete.push(imageId);
          wrapper.remove();
        }
      });
    }

    // Helper opcional
    window.openEditRentalModal = function(rentalId) {
      if (!rentalId) return;

      fetch(BASE_URL + 'dashboard/rents/getRent?id=' + rentalId)
        .then(res => res.json())
        .then(data => {
          document.getElementById('rentalTitle').value = data.rentalTitle;
          document.getElementById('rentalDescription').value = data.rentalDescription;
          document.getElementById('rentalPrice').value = data.rentalPrice;

          loadExistingImages(data.images || []);

          const form = document.getElementById('addRentalForm');
          form.action = BASE_URL + 'dashboard/rents/update?id=' + rentalId;

          window.__openAddRentalModal?.();
        });
    };

    // ==============================
    //  BEFORE SUBMIT: adjuntar imagesToDelete[]
    // ==============================
    const addRentalForm = document.getElementById('addRentalForm');
    if (addRentalForm) {
      addRentalForm.addEventListener('submit', function() {
        this.querySelectorAll('input[name="imagesToDelete[]"]').forEach(el => el.remove());

        imagesToDelete.forEach(id => {
          const input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'imagesToDelete[]';
          input.value = id;
          this.appendChild(input);
        });
      });
    }

    // ==============================
    //  RESET AL CERRAR MODAL (reemplazo hidden.bs.modal)
    // ==============================
    const modalEl = document.getElementById('addRentalModal');
    if (modalEl) {
      modalEl.addEventListener('modal:closed', function() {
        const form = document.getElementById('addRentalForm');

        form.reset();
        form.action = BASE_URL + 'dashboard/rents/store';
        document.getElementById('addRentalModalLabel').textContent = 'Agregar Renta';

        // Ocultar imágenes existentes
        const existingImagesContainer = document.getElementById('existingImagesContainer');
        const existingImagesDiv = document.getElementById('existingImages');
        if (existingImagesContainer) existingImagesContainer.classList.add('hidden');
        if (existingImagesDiv) existingImagesDiv.innerHTML = '';

        // Reset array de imágenes a borrar
        imagesToDelete.length = 0;

        // Reset municipios
        const municipioSelect = document.getElementById('municipio1');
        if (municipioSelect) {
          municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
          municipioSelect.disabled = true;
        }

        // Limpiar servicios
        const servicesCheckboxes = document.getElementById('servicesCheckboxes');
        if (servicesCheckboxes) servicesCheckboxes.innerHTML = '';

        // Limpiar habitaciones y capacidad
        const habEl = document.getElementById('habitaciones');
        const capEl = document.getElementById('capacidad');
        if (habEl) habEl.value = '';
        if (capEl) capEl.value = '';

        // Mostrar contenedores
        document.querySelectorAll('.services-content, .images-content, .ubi-content')
          .forEach(container => container.classList.remove('hidden'));

        // Limpiar preview nuevas imágenes
        const imgPrev = document.getElementById('imagePreview');
        if (imgPrev) imgPrev.innerHTML = '';
      });
    }
  });
</script>

<style>
  /* Botón para quitar imágenes existentes */
  .remove-image-btn {
    background: rgba(220, 53, 69, 0.9);
    border: none;
    border-radius: 50%;
    width: 22px;
    height: 22px;
    line-height: 18px;
    font-size: 14px;
    color: #fff;
    padding: 0;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: transform 0.2s ease, background 0.2s ease;
  }

  .remove-image-btn:hover {
    background: rgba(200, 35, 53, 0.95);
    color: #fff;
    transform: scale(1.1);
  }

  /* From Uiverse.io by Bodyhc (checkbox de servicios) */
  .checkbox-wrapper-16 *,
  .checkbox-wrapper-16 *:after,
  .checkbox-wrapper-16 *:before {
    box-sizing: border-box;
  }

  .checkbox-wrapper-16 .checkbox-input {
    clip: rect(0 0 0 0);
    -webkit-clip-path: inset(100%);
    clip-path: inset(100%);
    height: 1px;
    overflow: hidden;
    position: absolute;
    white-space: nowrap;
    width: 1px;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile {
    border-color: #2193b0;
    display: flex !important;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
    background-color: #2193b0;
    border-color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-icon,
  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-label {
    color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile {
    border-color: #2193b0;
    box-shadow:
      0 5px 10px rgba(0, 0, 0, 0.1),
      0 0 0 4px rgb(123, 229, 255);
  }

  .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
  }

  .checkbox-wrapper-16 .checkbox-tile {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 30px !important;
    width: 200px;
    height: 40px;
    border-radius: 0.5rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: 0.15s ease;
    cursor: pointer;
    position: relative;
  }

  .checkbox-wrapper-16 .checkbox-tile:before {
    content: "";
    position: absolute;
    display: flex;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    border-radius: 50%;
    top: 0.25rem;
    left: 0.25rem;
    opacity: 0;
    transform: scale(0);
    transition: 0.25s ease;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
  }

  .checkbox-wrapper-16 .checkbox-tile:hover {
    border-color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-tile:hover:before {
    transform: scale(1);
    opacity: 1;
  }

  .checkbox-wrapper-16 .checkbox-icon {
    margin-bottom: -3px !important;
    margin-right: 3px !important;
    transition: 0.375s ease;
    color: #494949;
  }

  .checkbox-wrapper-16 .checkbox-label {
    color: #707070;
    transition: 0.375s ease;
    text-align: left;
  }
</style>