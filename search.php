
    <form id="filterForm" class="needs-validation position-relative bg-body rounded-5 pt-8" style="padding: 5px" novalidate>
        <div class="sticky-top bg-body mb-2 mb-sm-1 pt-4" style="top: 25px !important;">
            <div class="d-none d-md-block d-lg-none" style="height: 72px; margin-top: -72px"></div>
            <div class="d-none d-lg-block" style="height: 76px; margin-top: -76px"></div>
            <div class="container">
                <p>Filtros</p>
            </div>
            <div class="d-flex container gap-2 gap-sm-3 pb-2 pb-sm-3">
                <!-- Filtro por precio -->
                <div class="dropdown flex-shrink-0">
                    <button type="button" class="btn rounded-pill px-2 btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal d-flex" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class="fi-tag fs-base me-0 me-md-2"></i>
                        <span class="d-none d-md-block">Precio</span>
                    </button>
                    <div class="dropdown-menu w-100 p-3" style="width: 140px">
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base" id="precio1" name="precio[]" value="<50">
                                <label for="precio1" class="form-check-label">Menos de $50</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base" id="precio2" name="precio[]" value="50-100">
                                <label for="precio2" class="form-check-label">$50 - $100</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base" id="precio3" name="precio[]" value="100-200">
                                <label for="precio3" class="form-check-label">$100 - $200</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base" id="precio4" name="precio[]" value=">200">
                                <label for="precio4" class="form-check-label">Más de $200</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Filtro por provincia -->
                <div class="dropdown flex-shrink-0" style="width: 140px">
                    <button type="button" class="btn rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
                        <i class="fi-map fs-base me-2"></i>
                        Zonas
                    </button>
                    <div class="dropdown-menu w-100 p-3" style="width: 500px" id="zoneDropdown">
                        <div class="d-flex flex-column gap-2">
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone1" name="municipio[]" value="Viñales">
                                <label for="zone1" class="form-check-label">Viñales</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone2" name="municipio[]" value="La Habana">
                                <label for="zone2" class="form-check-label">La Habana</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone3" name="municipio[]" value="Vedado">
                                <label for="zone3" class="form-check-label">Vedado</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone4" name="municipio[]" value="Playa">
                                <label for="zone4" class="form-check-label">Playa</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone5" name="municipio[]" value="Siboney">
                                <label for="zone5" class="form-check-label">Siboney</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone6" name="municipio[]" value="Miramar">
                                <label for="zone6" class="form-check-label">Miramar</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone7" name="municipio[]" value="Santa Fe">
                                <label for="zone7" class="form-check-label">Santa Fe</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone8" name="municipio[]" value="Centro Habana">
                                <label for="zone8" class="form-check-label">Centro Habana</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone9" name="municipio[]" value="Habana Vieja">
                                <label for="zone9" class="form-check-label">Habana Vieja</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone10" name="municipio[]" value="Guanabo">
                                <label for="zone10" class="form-check-label">Guanabo</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone11" name="municipio[]" value="Boca Ciega">
                                <label for="zone11" class="form-check-label">Boca Ciega</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone12" name="municipio[]" value="Brisas del Mar">
                                <label for="zone12" class="form-check-label">Brisas del Mar</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone13" name="municipio[]" value="Santa María">
                                <label for="zone13" class="form-check-label">Santa María</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone14" name="municipio[]" value="Varadero">
                                <label for="zone14" class="form-check-label">Varadero</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone15" name="municipio[]" value="Boca Camarioca">
                                <label for="zone15" class="form-check-label">Boca Camarioca</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone16" name="municipio[]" value="Ciénaga de Zapata">
                                <label for="zone16" class="form-check-label">Ciénaga de Zapata</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone17" name="municipio[]" value="Santa Marta">
                                <label for="zone17" class="form-check-label">Santa Marta</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone18" name="municipio[]" value="Cienfuegos">
                                <label for="zone18" class="form-check-label">Cienfuegos</label>
                            </div>
                            <div class="form-check m-0">
                                <input type="checkbox" class="form-check-input fs-base zone-checkbox" id="zone19" name="municipio[]" value="Trinidad">
                                <label for="zone19" class="form-check-label">Trinidad</label>
                            </div>
                        </div>
                    </div>
                </div>
   

    <!-- Script para manejar la lógica de las zonas -->
    <script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');

    console.log("Categoría capturada:", category); // Depuración

    const zoneDropdown = document.getElementById('zoneDropdown');
    const allZones = zoneDropdown.querySelectorAll('.zone-checkbox');

    const beachZones = [
        "Santa Fe", "Guanabo", "Boca Ciega", "Brisas del Mar", 
        "Santa María", "Varadero", "Boca Camarioca", 
        "Santa Marta", "Ciénaga de Zapata"
    ];

    if (category && category === "Casas en la playa") { // Comparar con espacios
        console.log("Mostrando solo zonas de playa"); // Depuración
        allZones.forEach(zone => {
            if (beachZones.includes(zone.value)) {
                zone.parentElement.style.display = 'block'; // Mostrar zonas de playa
            } else {
                zone.parentElement.style.display = 'none'; // Ocultar otras zonas
            }
        });
    } else {
        console.log("Mostrando todas las zonas"); // Depuración
        allZones.forEach(zone => {
            zone.parentElement.style.display = 'block'; // Mostrar todas las zonas
        });
    }
});
    </script>


           







            <div class="d-none d-md-flex gap-2">


            <div>

<div class="dropdown flex-shrink-0" style="width: 140px">
    <button type="button" class="btn rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-hotel-service"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.5 10a1.5 1.5 0 0 1 -1.5 -1.5a5.5 5.5 0 0 1 11 0v10.5a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2c0 -1.38 .71 -2.444 1.88 -3.175l4.424 -2.765c1.055 -.66 1.696 -1.316 1.696 -2.56a2.5 2.5 0 1 0 -5 0a1.5 1.5 0 0 1 -1.5 1.5z" /></svg>
        Servicios
    </button>
    <div class="dropdown-menu w-100 p-3" style="--fn-dropdown-min-width: 0">
        <div class="d-flex flex-column gap-2 services-container">
            <!-- Aquí se cargarán los servicios dinámicamente -->
        </div>
    </div>
</div>
            </div>

            <div>
<div class="dropdown flex-shrink-0" style="width: 160px">
    <button type="button" class="btn rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-bed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 17v-3h-20" /><path d="M2 8v9" /><path d="M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z" /></svg>
        Habitaciones
    </button>
    <div class="dropdown-menu w-100 p-3" style="--fn-dropdown-min-width: 0">
        <input type="number" name="habitaciones" class="form-control" placeholder="2" id="">
    </div>
</div>
            </div>

            <div>
<div class="dropdown flex-shrink-0" style="width: 160px">
    <button type="button" class="btn rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/><path d="M21 21v-2a4 4 0 0 0 -3 -3.85"/></svg>
        Capacidad
    </button>
    <div class="dropdown-menu w-100 p-3" style="--fn-dropdown-min-width: 0">
        <input type="number" name="capacidad" class="form-control" placeholder="4" id="">
    </div>
</div>
            </div>

            </div>
            


            <div>
                <button type="button" class="btn d-none d-md-flex buttonz buscarBtn" id="buscarBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-2 icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/>
                        <path d="M21 21l-6 -6"/>
                    </svg>
                    Buscar
                    
                </button>
            </div>

        </div>

        <div class="px-3">

        
        <div class="d-flex d-md-none gap-2 gap-sm-3">


<div>
<div class="dropdown flex-shrink-0" style="width: 140px">
    <button type="button" class="btn  rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-hotel-service"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8.5 10a1.5 1.5 0 0 1 -1.5 -1.5a5.5 5.5 0 0 1 11 0v10.5a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2c0 -1.38 .71 -2.444 1.88 -3.175l4.424 -2.765c1.055 -.66 1.696 -1.316 1.696 -2.56a2.5 2.5 0 1 0 -5 0a1.5 1.5 0 0 1 -1.5 1.5z" /></svg>
        Servicios
    </button>
    <div class="dropdown-menu w-100 p-3" style="--fn-dropdown-min-width: 0">
        <div class="d-flex flex-column gap-2 services-container">
            <!-- Aquí se cargarán los servicios dinámicamente -->
        </div>
    </div>
</div>
</div>

<div>
<div class="dropdown flex-shrink-0" style="width: 80px">
    <button type="button" class="btn  rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-bed"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 17v-3h-20" /><path d="M2 8v9" /><path d="M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z" /></svg>
       
    </button>
    <div class="dropdown-menu w-100 p-3"  style="width: 140px">
    <input type="number" name="habitaciones" class="form-control" placeholder="2" id="">
    </div>
</div>
</div>

<div>
<div class="dropdown flex-shrink-0" style="width: 80px">
    <button type="button" class="btn  rounded-pill btn-outline-secondary dropdown-toggle justify-content-between w-100 text-body fw-normal px-3" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false">
    <svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
    </button>
    <div class="dropdown-menu w-100 p-3" style="width: 140px">
    <input type="number" name="capacidad" class="form-control" placeholder="4" id="">
    </div>
</div>
</div>

</div>


        <button type="button" class="btn d-flex d-md-none buttonz buscarBtn w-100 py-4 mt-4" id="buscarBtn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon ms-2 icon-tabler icons-tabler-outline icon-tabler-search">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"/>
                        <path d="M21 21l-6 -6"/>
                    </svg>
                    Buscar
                    
                </button>
                </div>


    </div>

</form>

<script>
const provinciasMunicipios = {
    'Pinar': ['Viñales'],
    'La Habana': ['Plaza de la Revolución', 'Centro Habana', 'Habana Vieja', 'Cerro', 'Cotorro', 'Diez de Octubre', 'Guanabacoa', 'Habana del Este', 'La Lisa', 'Marianao', 'Playa', 'Regla', 'San Miguel del Padrón'],
    'Santiago de Cuba': ['Contramaestre', 'Guamá', 'II Frente', 'Mella', 'Palma Soriano', 'San Luis', 'Santiago de Cuba', 'Songo-La Maya', 'Tercer Frente'],
    'Matanzas': ['Calimete', 'Cárdenas', 'Ciénaga de Zapata', 'Colón', 'Jagüey Grande', 'Jovellanos', 'Limonar', 'Los Arabos', 'Martí', 'Matanzas', 'Pedro Betancourt', 'Perico', 'Unión de Reyes']
};

document.querySelectorAll('.provincia-checkbox').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const municipioContainer = document.getElementById('municipio-container');
        municipioContainer.innerHTML = '';

        document.querySelectorAll('.provincia-checkbox:checked').forEach(checkedBox => {
            const municipios = provinciasMunicipios[checkedBox.value];
            municipios.forEach(municipio => {
                const municipioCheckbox = document.createElement('div');
                municipioCheckbox.className = 'form-check m-0';
                municipioCheckbox.innerHTML = `
                    <input type="checkbox" class="form-check-input fs-base" name="municipio[]" value="${municipio}" id="municipio_${municipio}">
                    <label for="municipio_${municipio}" class="form-check-label">
                        ${municipio}
                    </label>
                `;
                municipioContainer.appendChild(municipioCheckbox);
            });
        });
    });
});

document.querySelectorAll('.buscarBtn').forEach(button => {
    button.addEventListener('click', function() {
        const form = document.getElementById('filterForm');
        const formData = new FormData(form);
        const params = new URLSearchParams();

        // Obtener el parámetro 'search' de la URL actual si está presente
        const currentSearchParams = new URLSearchParams(window.location.search);
        if (currentSearchParams.has('search')) {
            params.append('search', currentSearchParams.get('search'));
        }

        for (const pair of formData.entries()) {
            if (pair[1] !== '') { // Asegurarse de que el valor no esté vacío
                if (Array.isArray(pair[1])) {
                    pair[1].forEach(val => params.append(pair[0], val));
                } else {
                    params.append(pair[0], pair[1]);
                }
            }
        }

        window.location.href = 'search-rents.php?' + params.toString();
    });
});

// Función para cargar los servicios
function cargarServicios() {
    fetch('phpgetservices.php') // Asegúrate de que este archivo PHP devuelve la lista de servicios en formato JSON
        .then(response => response.json())
        .then(services => {
            const servicesContainers = document.querySelectorAll('.services-container');
            servicesContainers.forEach(container => {
                container.innerHTML = '';
                services.forEach(service => {
                    const checkbox = `
                        <div class="form-check m-0">
                            <input type="checkbox" class="form-check-input fs-base" id="service_${service.id}" name="servicios[]" value="${service.id}">
                            <label for="service_${service.id}" class="form-check-label">
                                ${service.name}
                            </label>
                        </div>`;
                    container.innerHTML += checkbox;
                });
            });
        })
        .catch(error => console.error('Error:', error));
}

document.addEventListener('DOMContentLoaded', function() {
    cargarServicios();
});

</script>


<style>
            


            .buttonz {
              width: 120px;
              height: 40px;
              display: flex;
              align-items: center;
              justify-content: flex-start;
              gap: 10px;
              background-color: rgb(29, 45, 64);
              border-radius: 30px;
              color: rgb(167, 248, 255);
              font-weight: 600;
              border: none;
              position: relative;
              cursor: pointer;
              transition-duration: .2s;
              box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
              padding-left: 8px;
              transition-duration: .5s;
            }
            
            .svgIconz {
              height: 25px;
              fill:rgb(167, 248, 255) !important;
              transition-duration: 1.5s;
            }
            
            .bell path {
              fill:rgb(167, 248, 255) !important;
            }
            
            .buttonz:hover {
              color:rgb(29, 45, 64);
              background-color: rgb(167, 248, 255);
              transition-duration: .2s;
            }
            
            .buttonz:active {
              transform: scale(0.97);
              transition-duration: .2s;
            }
            
            .buttonz:hover .svgIconz {
              fill: rgb(29, 45, 64) !important;
              transform: rotate(250deg);
              transition-duration: 1.5s;
            }
            
                    </style>