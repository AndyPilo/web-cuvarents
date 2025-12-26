<?php
if (!isset($zonas)) $zonas = [];
if (!isset($provincias)) $provincias = [];

function h($s): string
{
  return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8');
}

$priceOptions = [
  ['value' => '<50',     'label' => '< $50',    'color' => 'bg-green-100 dark:bg-green-900/30 text-black dark:text-green-100',  'desc' => 'Económico'],
  ['value' => '50-100',  'label' => '$50-100',  'color' => 'bg-blue-100 dark:bg-blue-900/30 text-black dark:text-blue-100',   'desc' => 'Medio'],
  ['value' => '100-200', 'label' => '$100-200', 'color' => 'bg-purple-100 dark:bg-purple-900/30 text-black dark:text-purple-100', 'desc' => 'Premium'],
  ['value' => '>200',    'label' => '> $200',   'color' => 'bg-amber-100 dark:bg-amber-900/30 text-black dark:text-amber-100',  'desc' => 'Lujo'],
];

function renderProvinceOptions(array $provincias, string $idPrefix, string $clearBtnId): void
{
  if (empty($provincias)) {
    echo "<div class='rounded-lg bg-gray-50 dark:bg-gray-800 p-4 text-center'><p class='text-sm text-gray-500 dark:text-gray-400'>No hay provincias disponibles</p></div>";
    return;
  }

  foreach ($provincias as $i => $prov) {
    $provEsc = h($prov);
    $id = h($idPrefix . $i);
    echo <<<HTML
      <label class="province-label flex cursor-pointer items-center gap-3 rounded-lg p-2 transition hover:bg-gray-50 dark:hover:bg-gray-800" data-value="{$provEsc}">
        <input type="radio" class="sr-only province-radio" id="{$id}" name="provincia" value="{$provEsc}" />
        <div class="province-indicator relative flex h-5 w-5 items-center justify-center rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 transition-all">
          <div class="province-indicator-dot h-2.5 w-2.5 rounded-full bg-white dark:bg-gray-900 opacity-0 transition-opacity"></div>
        </div>
        <span class="province-text text-sm text-gray-700 dark:text-gray-300 transition">{$provEsc}</span>
      </label>
    HTML;
  }

  $clearBtnIdEsc = h($clearBtnId);
  echo <<<HTML
    <button type="button" id="{$clearBtnIdEsc}" class="mt-2 w-full rounded-lg bg-gray-100 dark:bg-gray-800 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700">
      Limpiar provincia
    </button>
  HTML;
}

function renderZoneOptions(array $zonas, string $idPrefix): void
{
  if (empty($zonas)) {
    echo "<div class='rounded-lg bg-gray-50 dark:bg-gray-800 p-4 text-center'><p class='text-sm text-gray-500 dark:text-gray-400'>No hay municipios disponibles</p></div>";
    return;
  }

  $i = 0;
  foreach ($zonas as $row) {
    $prov = $row['provincia'] ?? '';
    $zona = $row['municipio'] ?? '';
    if ($prov === '' || $zona === '') continue;

    $provEsc = h($prov);
    $zonaEsc = h($zona);
    $id = h($idPrefix . $i);
    $i++;

    echo <<<HTML
      <label class="flex cursor-pointer items-center gap-3 rounded-lg p-2 hover:bg-gray-50 dark:hover:bg-gray-800" data-provincia="{$provEsc}">
        <div class="relative">
          <input
            type="checkbox"
            class="peer sr-only zone-checkbox"
            id="{$id}"
            name="municipio[]"
            value="{$zonaEsc}"
            data-provincia="{$provEsc}"
          />
          <div class="h-5 w-5 rounded border border-gray-300 dark:border-gray-600 peer-checked:border-cyan-500 peer-checked:bg-cyan-500 dark:peer-checked:bg-cyan-600"></div>
          <svg class="absolute left-1/2 top-1/2 h-3 w-3 -translate-x-1/2 -translate-y-1/2 text-white opacity-0 peer-checked:opacity-100"
               fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
          </svg>
        </div>
        <span class="text-sm text-gray-700 dark:text-gray-300">{$zonaEsc}</span>
      </label>
    HTML;
  }
}

function renderServicesSkeleton(string $size = 'sm'): void
{
  $h = $size === 'lg' ? 'h-4' : 'h-3';
  echo <<<HTML
    <div class="col-span-2 space-y-2">
      <div class="animate-pulse space-y-2">
        <div class="{$h} bg-gray-200 dark:bg-gray-700 rounded"></div>
        <div class="{$h} bg-gray-200 dark:bg-gray-700 rounded"></div>
      </div>
    </div>
  HTML;
}
?>

<form id="filterForm" class="contents" onsubmit="return false;">
  <div class="relative mx-auto max-w-7xl px-1 py-4">
    <div class="relative">
      <div class="hidden mb-4 lg:flex items-center justify-between">
        <div class="flex items-center gap-2">
          <div class="rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 p-1.5">
            <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
            </svg>
          </div>
          <div>
            <h2 class="text-base font-semibold text-gray-900 dark:text-white">Filtros avanzados</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">Personaliza tu búsqueda</p>
          </div>
        </div>
      </div>

      <div class="relative rounded-2xl bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 p-4 shadow-lg dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50">
        <!-- DESKTOP -->
        <div class="hidden lg:flex lg:items-center lg:gap-3">

          <!-- Precio -->
          <div class="relative" data-dropdown data-filter="precio">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-cyan-500"></span>
              Precio
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden w-64 rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Rango de precios</h3>
                <div class="grid grid-cols-1 gap-2">
                  <?php foreach ($priceOptions as $price): ?>
                    <label class="relative">
                      <input type="checkbox" class="peer sr-only" name="precio[]" value="<?= h($price['value']) ?>">
                      <div class="cursor-pointer rounded-lg border border-gray-200 dark:border-gray-700 px-3 py-2 text-center text-sm font-medium transition-all peer-checked:border-cyan-500 dark:peer-checked:border-cyan-400 peer-checked:ring-2 peer-checked:ring-cyan-500/20 dark:peer-checked:ring-cyan-400/20 <?= h($price['color']) ?> peer-checked:bg-opacity-60">
                        <?= h($price['label']) ?>
                      </div>
                    </label>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Provincia -->
          <div class="relative" data-dropdown data-filter="provincia">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-blue-500"></span>
              Provincia
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden w-80 rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3 z-10">
                <div class="flex items-center justify-between">
                  <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Selecciona provincia</h3>
                  <input type="text" id="provinceSearch"
                    class="w-32 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-sm placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                    placeholder="Buscar..." />
                </div>

                <div class="max-h-56 space-y-2 overflow-y-auto pr-2" id="provinceList">
                  <?php renderProvinceOptions($provincias, 'prov', 'clearProvinceDesktop'); ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Municipio -->
          <div class="relative" data-dropdown data-filter="municipio">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
              Municipio
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden w-80 rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3 z-10">
                <div class="flex items-center justify-between">
                  <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Selecciona municipios</h3>
                  <input type="text" id="zoneSearch"
                    class="w-32 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-sm placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                    placeholder="Buscar..." />
                </div>

                <div class="max-h-56 space-y-2 overflow-y-auto pr-2" id="zoneList">
                  <?php renderZoneOptions($zonas, 'zone'); ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Servicios -->
          <div class="relative" data-dropdown data-filter="servicios">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-purple-500"></span>
              Servicio
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden w-72 rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Comodidades</h3>
                <div class="services-container grid grid-cols-1 gap-2 max-h-56 overflow-y-auto pr-1">
                  <?php renderServicesSkeleton('sm'); ?>
                </div>
              </div>
            </div>
          </div>

          <!-- Habitaciones -->
          <div class="relative" data-dropdown data-filter="habitaciones">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-amber-500"></span>
              Habitaciones
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Número de habitaciones</h3>
                <div class="flex items-center gap-3">
                  <button type="button" class="counter-btn flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">-</button>
                  <input type="number" name="habitaciones"
                    class="w-20 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-center text-lg font-semibold text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                    min="1" max="10" />
                  <button type="button" class="counter-btn flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">+</button>
                </div>
              </div>
            </div>
          </div>

          <!-- Personas -->
          <div class="relative" data-dropdown data-filter="capacidad">
            <button type="button"
              class="filter-trigger inline-flex items-center gap-2 rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:shadow-md hover:ring-cyan-300 dark:hover:ring-cyan-500"
              data-dropdown-trigger aria-expanded="false">
              <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
              Personas
              <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </button>

            <div class="absolute left-0 top-full z-30 mt-2 hidden rounded-xl bg-white dark:bg-gray-800 p-4 shadow-2xl dark:shadow-gray-900/50 ring-1 ring-gray-200 dark:ring-gray-700" data-dropdown-menu>
              <div class="space-y-3">
                <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Capacidad máxima</h3>
                <div class="flex items-center gap-3">
                  <button type="button" class="counter-btn flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">-</button>
                  <input type="number" name="capacidad"
                    class="w-20 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-center text-lg font-semibold text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                    min="1" max="20" />
                  <button type="button" class="counter-btn flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-600">+</button>
                </div>
              </div>
            </div>
          </div>

          <div class="ml-auto">
            <button type="button" id="buscarBtnDesktop"
              class="buscarBtn inline-flex items-center gap-2 rounded-full bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 px-6 py-2.5 text-sm font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl hover:-translate-y-0.5">
              <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
              Buscar
            </button>
          </div>
        </div>

        <!-- MOBILE Trigger -->
        <div class="lg:hidden">
          <button type="button"
            class="flex w-full items-center justify-between rounded-xl bg-white dark:bg-gray-800 px-4 py-3 text-left ring-1 ring-gray-200 dark:ring-gray-700 transition-all hover:ring-cyan-300 dark:hover:ring-cyan-500"
            data-offcanvas-open="filtersOffcanvas" aria-controls="filtersOffcanvas">
            <div class="flex items-center gap-3">
              <div class="rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 p-2">
                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
              </div>
              <div>
                <div class="text-sm font-medium text-gray-900 dark:text-white">Mostrar filtros</div>
                <div class="text-xs text-gray-500 dark:text-gray-400">Precio, provincia, municipio, servicios</div>
              </div>
            </div>
            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- OFFCANVAS MOBILE -->
  <div class="lg:hidden">
    <div class="fixed inset-0 z-40 hidden bg-black/40 backdrop-blur-[1px]" data-offcanvas-backdrop="filtersOffcanvas" aria-hidden="true"></div>

    <section id="filtersOffcanvas"
      class="fixed inset-x-0 bottom-0 z-50 w-full translate-y-full transition-transform duration-300 rounded-t-3xl bg-white dark:bg-gray-900 shadow-2xl dark:shadow-gray-900/50 max-h-[85vh] flex flex-col"
      role="dialog" aria-modal="true" aria-labelledby="filtersOffcanvasLabel">
      <header class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4">
        <div class="flex items-start justify-between gap-4">
          <div class="flex items-center gap-3">
            <div class="rounded-lg bg-gradient-to-br from-cyan-500 to-blue-500 p-2">
              <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
              </svg>
            </div>
            <div>
              <h5 class="text-lg font-semibold text-gray-900 dark:text-white" id="filtersOffcanvasLabel">Filtros</h5>
              <p class="text-sm text-gray-500 dark:text-gray-400">Personaliza tu búsqueda</p>
            </div>
          </div>

          <button type="button"
            class="inline-flex h-10 w-10 items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-800 text-gray-700 dark:text-gray-300"
            aria-label="Cerrar" data-offcanvas-close="filtersOffcanvas">✕</button>
        </div>
      </header>

      <div class="border-b border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900">
        <nav class="-mb-px flex" aria-label="Tabs" data-tabs>
          <button type="button" class="tab-btn flex-1 border-b-2 border-cyan-600 dark:border-cyan-500 px-4 py-3 text-center text-sm font-medium text-cyan-700 dark:text-cyan-400" data-tab="price">Precio</button>
          <button type="button" class="tab-btn flex-1 border-b-2 border-transparent px-4 py-3 text-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" data-tab="province">Provincia</button>
          <button type="button" class="tab-btn flex-1 border-b-2 border-transparent px-4 py-3 text-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" data-tab="municipio">Municipio</button>
          <button type="button" class="tab-btn flex-1 border-b-2 border-transparent px-4 py-3 text-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" data-tab="services">Servicio</button>
          <button type="button" class="tab-btn flex-1 border-b-2 border-transparent px-4 py-3 text-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300" data-tab="details">Detalle</button>
        </nav>
      </div>

      <div class="flex-1 overflow-y-auto p-4 bg-white dark:bg-gray-900">
        <div data-tab-panel="price" class="space-y-4">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Rango de precios</h3>
          <div class="grid grid-cols-1 gap-3">
            <?php foreach ($priceOptions as $price): ?>
              <label class="relative">
                <input type="checkbox" class="peer sr-only" name="precio[]" value="<?= h($price['value']) ?>">
                <div class="cursor-pointer rounded-xl border-2 border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 p-3 text-center transition-all peer-checked:border-cyan-500 dark:peer-checked:border-cyan-400 peer-checked:bg-cyan-50 dark:peer-checked:bg-cyan-900/30">
                  <div class="text-sm font-semibold text-gray-900 dark:text-white"><?= h($price['label']) ?></div>
                  <div class="mt-1 text-xs text-gray-500 dark:text-gray-400"><?= h($price['desc']) ?></div>
                </div>
              </label>
            <?php endforeach; ?>
          </div>
        </div>

        <div data-tab-panel="province" class="hidden space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Selecciona provincia</h3>
            <input type="text" id="provinceSearchMobile"
              class="w-32 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-sm placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
              placeholder="Buscar..." />
          </div>

          <div class="max-h-64 space-y-2 overflow-y-auto" id="provinceListMobile">
            <?php renderProvinceOptions($provincias, 'provMobile', 'clearProvinceMobile'); ?>
          </div>
        </div>

        <div data-tab-panel="municipio" class="hidden space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Selecciona municipios</h3>
            <input type="text" id="zoneSearchMobile"
              class="w-32 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-1.5 text-sm placeholder-gray-400 dark:placeholder-gray-500 text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
              placeholder="Buscar..." />
          </div>

          <div class="max-h-64 space-y-2 overflow-y-auto" id="zoneListMobile">
            <?php renderZoneOptions($zonas, 'zoneMobile'); ?>
          </div>
        </div>

        <div data-tab-panel="services" class="hidden space-y-4">
          <h3 class="text-sm font-semibold text-gray-900 dark:text-white">Comodidades</h3>
          <div class="services-container grid grid-cols-1 gap-3 max-h-56 overflow-y-auto pr-1">
            <?php renderServicesSkeleton('lg'); ?>
          </div>
        </div>

        <div data-tab-panel="details" class="hidden space-y-6">
          <div>
            <h3 class="mb-3 text-sm font-semibold text-gray-900 dark:text-white">Habitaciones</h3>
            <div class="flex items-center justify-center gap-4">
              <button type="button" class="counter-btn flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">-</button>
              <div class="text-center">
                <input type="number" name="habitaciones"
                  class="w-20 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-center text-2xl font-bold text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                  min="1" max="10" />
                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Cantidad</div>
              </div>
              <button type="button" class="counter-btn flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">+</button>
            </div>
          </div>

          <div>
            <h3 class="mb-3 text-sm font-semibold text-gray-900 dark:text-white">Personas</h3>
            <div class="flex items-center justify-center gap-4">
              <button type="button" class="counter-btn flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">-</button>
              <div class="text-center">
                <input type="number" name="capacidad"
                  class="w-20 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-3 py-2 text-center text-2xl font-bold text-gray-900 dark:text-gray-300 focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-1 focus:ring-cyan-500/20 dark:focus:ring-cyan-400/20"
                  min="1" max="20" />
                <div class="mt-1 text-xs text-gray-500 dark:text-gray-400">Capacidad máxima</div>
              </div>
              <button type="button" class="counter-btn flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700">+</button>
            </div>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 p-4">
        <button type="button"
          class="buscarBtn w-full rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 py-3 text-base font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl"
          data-offcanvas-close="filtersOffcanvas">
          <div class="flex items-center justify-center gap-2">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Aplicar filtros
          </div>
        </button>
      </div>
    </section>
  </div>
</form>

<script src="assets/js/loadServices.js"></script>

<script>
  (() => {
    const beachZones = ["Santa Fe", "Guanabo", "Boca Ciega", "Brisas del Mar", "Santa María", "Varadero", "Boca Camarioca", "Santa Marta", "Ciénaga de Zapata"];
    const urlParams = new URLSearchParams(window.location.search);
    const category = urlParams.get('category');

    const $$ = (sel, root = document) => Array.from(root.querySelectorAll(sel));

    // -------------------------
    // Highlight de filtros activos (píldoras desktop)
    // -------------------------
    const setTriggerActive = (btn, active) => {
      if (!btn) return;

      if (active) {
        btn.classList.add('bg-cyan-50', 'dark:bg-cyan-900/30', 'text-cyan-700', 'dark:text-cyan-400', 'ring-cyan-300', 'dark:ring-cyan-500');
        btn.classList.remove('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300', 'ring-gray-200', 'dark:ring-gray-700');
      } else {
        btn.classList.remove('bg-cyan-50', 'dark:bg-cyan-900/30', 'text-cyan-700', 'dark:text-cyan-400', 'ring-cyan-300', 'dark:ring-cyan-500');
        btn.classList.add('bg-white', 'dark:bg-gray-800', 'text-gray-700', 'dark:text-gray-300', 'ring-gray-200', 'dark:ring-gray-700');
      }
    };

    const hasAnyChecked = (name) => document.querySelectorAll(`input[name="${name}"]:checked`).length > 0;

    const updateFilterHighlights = () => {
      $$('[data-dropdown][data-filter]').forEach(dd => {
        const key = dd.dataset.filter;
        const btn = dd.querySelector('[data-dropdown-trigger]');
        let active = false;

        switch (key) {
          case 'precio':
            active = hasAnyChecked('precio[]');
            break;
          case 'provincia':
            active = document.querySelectorAll('.province-radio:checked').length > 0;
            break;
          case 'municipio':
            active = hasAnyChecked('municipio[]');
            break;
          case 'servicios':
            active = hasAnyChecked('servicios[]');
            break;
          case 'habitaciones':
            active = $$('#filterForm input[name="habitaciones"]').some(i => (i.value || '').trim() !== '');
            break;
          case 'capacidad':
            active = $$('#filterForm input[name="capacidad"]').some(i => (i.value || '').trim() !== '');
            break;
        }

        setTriggerActive(btn, active);
      });
    };

    // -------------------------
    // Tabs Mobile
    // -------------------------
    document.addEventListener("DOMContentLoaded", () => {
      const nav = document.querySelector("[data-tabs]");
      if (!nav) return;

      const buttons = Array.from(nav.querySelectorAll(".tab-btn"));
      const panels = Array.from(document.querySelectorAll("[data-tab-panel]"));

      const activate = (key) => {
        buttons.forEach(btn => {
          const active = btn.getAttribute("data-tab") === key;
          btn.classList.toggle("border-cyan-600", active);
          btn.classList.toggle("dark:border-cyan-500", active);
          btn.classList.toggle("text-cyan-700", active);
          btn.classList.toggle("dark:text-cyan-400", active);
          btn.classList.toggle("border-transparent", !active);
          btn.classList.toggle("text-gray-500", !active);
          btn.classList.toggle("dark:text-gray-400", !active);
        });
        panels.forEach(p => p.classList.toggle("hidden", p.getAttribute("data-tab-panel") !== key));
      };

      buttons.forEach(btn => btn.addEventListener("click", () => activate(btn.getAttribute("data-tab"))));
      activate("price");
    });

    // -------------------------
    // Buscadores (Provincia)
    // -------------------------
    const setupListSearch = (searchId, listId) => {
      const searchEl = document.getElementById(searchId);
      const listEl = document.getElementById(listId);
      if (!searchEl || !listEl) return;

      searchEl.addEventListener('input', function() {
        const filter = (this.value || '').toLowerCase();
        listEl.querySelectorAll('label').forEach(label => {
          const text = (label.textContent || '').toLowerCase();
          label.style.display = text.includes(filter) ? '' : 'none';
        });
      });
    };

    setupListSearch('provinceSearch', 'provinceList');
    setupListSearch('provinceSearchMobile', 'provinceListMobile');

    // -------------------------
    // Provincia UI (radio estilizado)
    // -------------------------
    const getSelectedProvince = () => {
      const r = document.querySelector('.province-radio:checked');
      return r ? r.value : '';
    };

    const refreshProvinceUI = () => {
      const selected = getSelectedProvince();

      $$('.province-label').forEach(label => {
        const value = (label.dataset.value || '').trim();
        const isSelected = selected && value === selected;

        const indicator = label.querySelector('.province-indicator');
        const dot = label.querySelector('.province-indicator-dot');
        const text = label.querySelector('.province-text');

        if (isSelected) {
          label.classList.add('bg-cyan-50', 'dark:bg-cyan-900/30');
          label.classList.remove('hover:bg-gray-50', 'dark:hover:bg-gray-800');

          if (indicator) {
            indicator.classList.add('bg-cyan-500', 'dark:bg-cyan-600', 'border-cyan-500', 'dark:border-cyan-600');
            indicator.classList.remove('bg-white', 'dark:bg-gray-700', 'border-gray-300', 'dark:border-gray-600');
          }
          if (dot) {
            dot.classList.add('opacity-100');
            dot.classList.remove('opacity-0');
          }
          if (text) {
            text.classList.add('text-cyan-700', 'dark:text-cyan-400', 'font-semibold');
            text.classList.remove('text-gray-700', 'dark:text-gray-300');
          }
        } else {
          label.classList.remove('bg-cyan-50', 'dark:bg-cyan-900/30');
          label.classList.add('hover:bg-gray-50', 'dark:hover:bg-gray-800');

          if (indicator) {
            indicator.classList.remove('bg-cyan-500', 'dark:bg-cyan-600', 'border-cyan-500', 'dark:border-cyan-600');
            indicator.classList.add('bg-white', 'dark:bg-gray-700', 'border-gray-300', 'dark:border-gray-600');
          }
          if (dot) {
            dot.classList.remove('opacity-100');
            dot.classList.add('opacity-0');
          }
          if (text) {
            text.classList.remove('text-cyan-700', 'dark:text-cyan-400', 'font-semibold');
            text.classList.add('text-gray-700', 'dark:text-gray-300');
          }
        }
      });
    };

    const syncProvinceRadios = (value) => {
      $$('.province-radio').forEach(r => {
        r.checked = (r.value === value);
      });
      refreshProvinceUI();
    };

    const clearProvince = () => {
      $$('.province-radio').forEach(r => r.checked = false);
      refreshProvinceUI();
    };

    // -------------------------
    // Municipio (visibilidad según provincia + categoría playa)
    // -------------------------
    const syncZoneCheckboxesByValue = (value, checked) => {
      $$('.zone-checkbox').forEach(cb => {
        if (cb.value === value) cb.checked = checked;
      });
    };

    const clearZonesNotAllowed = (prov) => {
      $$('.zone-checkbox').forEach(cb => {
        const p = cb.dataset.provincia || cb.closest('label')?.dataset?.provincia || '';
        const allowed = !prov || p === prov;
        if (!allowed && cb.checked) syncZoneCheckboxesByValue(cb.value, false);
      });
    };

    function applyMunicipioVisibility() {
      const prov = getSelectedProvince();
      clearZonesNotAllowed(prov);

      const applyToList = (listId, searchId) => {
        const listEl = document.getElementById(listId);
        const searchEl = document.getElementById(searchId);
        if (!listEl) return;

        const term = (searchEl?.value || '').toLowerCase();

        listEl.querySelectorAll('label').forEach(label => {
          const cb = label.querySelector('input.zone-checkbox');
          const zona = (cb?.value || '').trim();
          const p = (label.dataset.provincia || cb?.dataset?.provincia || '').trim();
          const text = (label.textContent || '').toLowerCase();

          const okProv = !prov || p === prov;
          const okSearch = !term || text.includes(term);
          const okCategory = (category !== "Casas en la playa") || beachZones.includes(zona);

          label.style.display = (okProv && okSearch && okCategory) ? '' : 'none';
        });
      };

      applyToList('zoneList', 'zoneSearch');
      applyToList('zoneListMobile', 'zoneSearchMobile');
    }

    ['zoneSearch', 'zoneSearchMobile'].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.addEventListener('input', applyMunicipioVisibility);
    });

    // -------------------------
    // Contadores (+ / -)
    // -------------------------
    document.addEventListener('click', (e) => {
      const btn = e.target.closest('.counter-btn');
      if (!btn) return;

      // contenedor real: el div que contiene - input +
      const wrap = btn.parentElement;
      const input = wrap ? wrap.querySelector('input[type="number"]') : null;
      if (!input) return;

      e.preventDefault(); // ok
      // NO hace falta stopPropagation (el dropdown ya evita cerrarse)

      const min = parseInt(input.min || "1", 10);
      const max = parseInt(input.max || "999", 10);
      const isMinus = btn.textContent.trim() === '-';

      const currentRaw = (input.value || '').trim();

      if (currentRaw === '') {
        if (isMinus) return;
        input.value = String(min);
      } else {
        const current = parseInt(currentRaw, 10);
        const safeCurrent = Number.isNaN(current) ? min : current;

        if (isMinus) {
          if (safeCurrent <= min) input.value = '';
          else input.value = String(Math.max(min, safeCurrent - 1));
        } else {
          input.value = String(Math.min(max, safeCurrent + 1));
        }
      }

      // dispara eventos por si algo escucha cambios
      input.dispatchEvent(new Event('input', {
        bubbles: true
      }));
      input.dispatchEvent(new Event('change', {
        bubbles: true
      }));

      updateFilterHighlights();
    }, true);

    // -------------------------
    // Sync Servicios (evitar estados duplicados)
    // -------------------------
    const syncServiceCheckboxes = (value, checked) => {
      document.querySelectorAll('input[name="servicios[]"]').forEach(cb => {
        if (cb.value === value) cb.checked = checked;
      });
    };

    // -------------------------
    // Eventos principales (change)
    // -------------------------
    document.addEventListener('change', (e) => {
      const t = e.target;
      if (!(t instanceof HTMLInputElement)) return;

      // Provincia
      if (t.classList.contains('province-radio')) {
        syncProvinceRadios(t.checked ? t.value : '');
        applyMunicipioVisibility();
        updateFilterHighlights();
        return;
      }

      // Municipio
      if (t.classList.contains('zone-checkbox')) {
        if (t.checked) {
          const prov = t.dataset.provincia || t.closest('label')?.dataset?.provincia || '';
          if (prov) syncProvinceRadios(prov);
        }
        syncZoneCheckboxesByValue(t.value, t.checked);
        applyMunicipioVisibility();
        updateFilterHighlights();
        return;
      }

      // Servicios
      if (t.name === 'servicios[]') {
        syncServiceCheckboxes(t.value, t.checked);
        updateFilterHighlights();
        return;
      }

      // Precios / inputs number / etc
      updateFilterHighlights();
    });

    // Limpiar provincia
    document.addEventListener('DOMContentLoaded', () => {
      const clearDesktop = document.getElementById('clearProvinceDesktop');
      const clearMobile = document.getElementById('clearProvinceMobile');

      if (clearDesktop) clearDesktop.addEventListener('click', () => {
        clearProvince();
        applyMunicipioVisibility();
        updateFilterHighlights();
      });

      if (clearMobile) clearMobile.addEventListener('click', () => {
        clearProvince();
        applyMunicipioVisibility();
        updateFilterHighlights();
      });

      refreshProvinceUI();
      applyMunicipioVisibility();
      updateFilterHighlights();
    });

    // -------------------------
    // Buscar (dedupe params porque hay inputs duplicados desktop/mobile)
    // -------------------------
    $$('.buscarBtn').forEach(button => {
      button.addEventListener('click', (e) => {
        e.preventDefault();
        e.stopPropagation();

        const form = document.getElementById('filterForm');
        if (!form) return;

        const formData = new FormData(form);
        const params = new URLSearchParams();

        const currentSearchParams = new URLSearchParams(window.location.search);
        if (currentSearchParams.has('search')) {
          params.append('search', currentSearchParams.get('search'));
        }

        const seen = new Set();
        for (const [key, value] of formData.entries()) {
          const v = (value ?? '').toString().trim();
          if (!v) continue;

          const sig = `${key}::${v}`;
          if (seen.has(sig)) continue;
          seen.add(sig);

          params.append(key, v);
        }

        window.location.href = '<?= h(BASE_URL) ?>rents?' + params.toString();
      });
    });
  })();
</script>