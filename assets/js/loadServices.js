document.addEventListener("DOMContentLoaded", function () {
  const containers = Array.from(
    document.querySelectorAll(".services-container")
  );
  if (!containers.length) return;

  const apiUrl = `${BASE_URL}api/getServices.php`;

  // Lee servicios ya seleccionados desde la URL (?servicios[]=1&servicios[]=2)
  const url = new URL(window.location.href);
  const preselected = new Set(
    url.searchParams.getAll("servicios[]").map(String)
  );

  const renderInto = (container, services, containerIndex) => {
    container.innerHTML = "";

    services.forEach((service) => {
      const id = `svc-${containerIndex}-${service.id}`;

      // Label "card"
      const label = document.createElement("label");
      label.className =
        "group flex cursor-pointer items-center gap-3 rounded-xl border border-gray-200 bg-white px-3 py-2 " +
        "transition hover:border-cyan-300 hover:bg-cyan-50/40";

      // Checkbox oculto (controla estilos con peer)
      const input = document.createElement("input");
      input.type = "checkbox";
      input.name = "servicios[]";
      input.value = String(service.id);
      input.id = id;
      input.className = "service-checkbox peer sr-only";

      // Estado inicial (por URL)
      if (preselected.has(String(service.id))) input.checked = true;

      // “Indicador” visual tipo checkbox
      const box = document.createElement("span");
      box.className =
        "flex h-5 w-5 items-center justify-center rounded-md border border-gray-300 bg-white " +
        "transition " +
        "peer-checked:border-cyan-600 peer-checked:bg-cyan-600";

      // Check icon (solo visual)
      box.innerHTML = `
        <svg class="h-3.5 w-3.5 text-white opacity-0 transition peer-checked:opacity-100"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                d="M5 13l4 4L19 7" />
        </svg>
      `;

      // Texto
      const text = document.createElement("span");
      text.className =
        "text-sm font-medium text-gray-700 leading-tight " +
        "group-hover:text-gray-900 peer-checked:text-cyan-800";
      text.textContent = service.name; // ✅ sin iconos

      label.appendChild(input);
      label.appendChild(box);
      label.appendChild(text);

      container.appendChild(label);
    });
  };

  const syncByValue = (value, checked) => {
    document.querySelectorAll(".service-checkbox").forEach((el) => {
      if (String(el.value) === String(value)) el.checked = checked;
    });
  };

  fetch(apiUrl)
    .then((response) => {
      if (!response.ok) throw new Error("Error al cargar servicios");
      return response.json();
    })
    .then((services) => {
      if (!Array.isArray(services) || services.length === 0) {
        containers.forEach((c) => {
          c.innerHTML =
            "<p class='text-sm text-gray-500'>No hay servicios disponibles.</p>";
        });
        return;
      }

      containers.forEach((container, idx) =>
        renderInto(container, services, idx)
      );

      // Delegación: sincroniza entre desktop y mobile
      document.addEventListener("change", (e) => {
        const t = e.target;
        if (!(t instanceof HTMLInputElement)) return;
        if (!t.classList.contains("service-checkbox")) return;
        syncByValue(t.value, t.checked);
      });
    })
    .catch((error) => {
      console.error("Error cargando servicios:", error);
      containers.forEach((c) => {
        c.innerHTML =
          "<p class='text-sm text-red-600'>Error al cargar los servicios.</p>";
      });
    });
});
