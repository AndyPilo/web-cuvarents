<footer class="footer bg-gradient-to-b from-gray-900 to-gray-950 text-gray-200 pt-12 pb-6">
  <!-- Versión desktop / tablet -->
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="grid gap-8 md:gap-10 pb-8 md:pb-10 md:grid-cols-12">

      <!-- Logo + Contactos -->
      <div class="md:col-span-5 lg:col-span-4">
        <div class="space-y-4">
          <!-- Logo -->
          <a class="inline-flex items-center gap-3 group" href="<?= BASE_PATH ?>">
            <div class="relative">
              <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full blur-md opacity-70 group-hover:opacity-90 transition-opacity"></div>
              <img
                src="<?= BASE_URL ?>assets/img/logo-white.webp"
                class="relative rounded-full border-2 border-gray-800/50"
                width="64"
                alt="Logo CuvaRents blanco"
                loading="lazy">
            </div>
            <div>
              <h3 class="text-xl font-bold text-white">CuVaRents</h3>
              <p class="text-sm text-gray-400 mt-1">Tu hogar en Cuba</p>
            </div>
          </a>

          <!-- Descripción -->
          <p class="text-gray-400 text-sm leading-relaxed max-w-sm">
            Encuentra la propiedad perfecta para tu estancia en Cuba. Casas y apartamentos verificados con fotos reales y atención personalizada.
          </p>

          <!-- Contacto -->
          <div class="space-y-3 pt-2">
            <a
              href="mailto:agenciacuvarents@gmail.com"
              class="group flex items-center gap-3 text-gray-300 hover:text-white transition-colors">
              <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-800/50 group-hover:bg-cyan-900/30 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <span class="text-sm block">Email</span>
                <span class="text-xs text-gray-400">agenciacuvarents@gmail.com</span>
              </div>
            </a>

            <div class="group flex items-center gap-3 text-gray-300">
              <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-gray-800/50">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <div>
                <span class="text-sm block">Teléfono</span>
                <a
                  id="footerPhone"
                  class="text-xs text-gray-400 hover:text-cyan-400 transition-colors"
                  href="#">
                  Cargando...
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Enlaces rápidos -->
      <div class="md:col-span-3 lg:col-span-2">
        <h4 class="text-lg font-semibold text-white mb-4 pb-2 border-b border-gray-800/50">
          Enlaces
        </h4>
        <ul class="space-y-3">
          <li>
            <a
              class="text-gray-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group"
              href="<?= BASE_PATH ?>">
              <span class="h-1 w-1 rounded-full bg-gray-600 group-hover:bg-cyan-400 transition-colors"></span>
              Inicio
            </a>
          </li>
          <li>
            <a
              class="text-gray-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group"
              href="<?= BASE_PATH ?>about">
              <span class="h-1 w-1 rounded-full bg-gray-600 group-hover:bg-cyan-400 transition-colors"></span>
              Quiénes somos
            </a>
          </li>
          <li>
            <a
              class="text-gray-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group"
              href="<?= BASE_PATH ?>rents">
              <span class="h-1 w-1 rounded-full bg-gray-600 group-hover:bg-cyan-400 transition-colors"></span>
              Explorar propiedades
            </a>
          </li>
          <li>
            <a
              class="text-gray-400 hover:text-cyan-400 transition-colors flex items-center gap-2 group"
              href="<?= BASE_PATH ?>contact">
              <span class="h-1 w-1 rounded-full bg-gray-600 group-hover:bg-cyan-400 transition-colors"></span>
              Contacto
            </a>
          </li>
        </ul>
      </div>

      <!-- Redes sociales -->
      <div class="md:col-span-4 lg:col-span-3">
        <h4 class="text-lg font-semibold text-white mb-4 pb-2 border-b border-gray-800/50">
          Síguenos
        </h4>
        <div class="space-y-4">
          <p class="text-sm text-gray-400 mb-4">
            Mantente al día con nuestras últimas propiedades y ofertas especiales.
          </p>

          <div class="flex gap-3">
            <!-- Instagram -->
            <a
              href="https://www.instagram.com/cuvarents/"
              target="_blank"
              class="group relative inline-flex items-center justify-center rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 p-3 hover:from-pink-600 hover:to-purple-600 transition-all duration-300 hover:scale-105 shadow-lg"
              aria-label="Instagram">
              <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-pink-600 to-purple-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <svg class="relative h-5 w-5 text-gray-300 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 448 512">
                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
              </svg>
            </a>

            <!-- Facebook -->
            <a
              href="https://www.facebook.com/people/Agencia-Cuvarents/61560542866042/?mibextid=ZbWKwL"
              target="_blank"
              class="group relative inline-flex items-center justify-center rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 p-3 hover:from-blue-600 hover:to-blue-800 transition-all duration-300 hover:scale-105 shadow-lg"
              aria-label="Facebook">
              <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-blue-600 to-blue-800 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <svg class="relative h-5 w-5 text-gray-300 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 320 512">
                <path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z" />
              </svg>
            </a>

            <!-- WhatsApp -->
            <a
              href="#"
              id="whatsappLink"
              target="_blank"
              class="group relative inline-flex items-center justify-center rounded-xl bg-gradient-to-br from-gray-800 to-gray-900 p-3 hover:from-green-600 hover:to-green-700 transition-all duration-300 hover:scale-105 shadow-lg"
              aria-label="WhatsApp">
              <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-green-600 to-green-700 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
              <svg class="relative h-5 w-5 text-gray-300 group-hover:text-white transition-colors" fill="currentColor" viewBox="0 0 448 512">
                <path d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7.9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
              </svg>
            </a>
          </div>
        </div>
      </div>

      <!-- CTA Registro/Explorar -->
      <div class="md:col-span-12 lg:col-span-3">
        <div class="rounded-xl bg-gradient-to-br from-gray-800/50 to-gray-900/50 p-5 border border-gray-800/50">
          <div class="text-center lg:text-left">
            <?php if (empty($loggedIn)): ?>
              <h6 class="text-lg font-semibold text-white mb-3">
                ✨ Únete a nuestra comunidad
              </h6>
              <p class="text-sm text-gray-400 mb-4">
                Regístrate para guardar tus favoritos, recibir ofertas exclusivas y reservar más rápido.
              </p>
              <a
                href="<?= BASE_PATH ?>auth/register"
                class="inline-flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl hover:-translate-y-0.5">
                <svg class="mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                Crear cuenta gratuita
              </a>
            <?php else: ?>
              <h6 class="text-lg font-semibold text-white mb-3">
                🏡 Alquile una casa particular
              </h6>
              <p class="text-sm text-gray-400 mb-4">
                Descubre nuevas propiedades añadidas recientemente en toda Cuba.
              </p>
              <a
                href="<?= BASE_PATH ?>rents"
                class="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl hover:-translate-y-0.5">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                Explorar propiedades
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Divider -->
    <div class="my-8 border-t border-gray-800/50"></div>

    <!-- Copyright -->
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
      <div class="text-sm text-gray-500">
        © <?= date('Y') ?> CuVaRents. Todos los derechos reservados.
      </div>

      <!-- Terminos y condiciones 
      <div class="flex items-center gap-6 text-sm text-gray-500">
        <a href="#" class="hover:text-cyan-400 transition-colors">Términos y condiciones</a>
        <a href="#" class="hover:text-cyan-400 transition-colors">Política de privacidad</a>
        <a href="#" class="hover:text-cyan-400 transition-colors">Aviso legal</a>
      </div>
    </div>
  </div>
      -->

      <!-- Botón volver arriba (solo desktop) -->
      <div class="fixed bottom-6 right-6 z-40 hidden md:block">
        <a href="#top" class="group relative inline-flex items-center justify-center rounded-full bg-gradient-to-r from-gray-800 to-gray-900 p-3 shadow-xl hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
          <div class="absolute inset-0 rounded-full bg-gradient-to-r from-cyan-600 to-blue-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
          <svg class="relative h-5 w-5 text-gray-300 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
          </svg>
          <span class="sr-only">Volver arriba</span>
        </a>
      </div>
</footer>

<!-- Scripts -->
<script src="<?= BASE_URL ?>assets/js/footer.js" defer></script>
<script src="<?= BASE_URL ?>assets/js/gestor.js" defer></script>
<script src="<?= BASE_URL ?>assets/js/ui-dropdown.js" defer></script>
<script src="<?= BASE_URL ?>assets/js/ui-offcanvas.js" defer></script>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    // Cargar número de teléfono
    fetch('api/getGestorActivo.php')
      .then(res => res.json())
      .then(data => {
        if (data.telefono) {
          const phoneElement = document.getElementById('footerPhone');
          const formattedPhone = data.telefono.replace(/\D/g, '');
          phoneElement.textContent = `+${formattedPhone}`;
          phoneElement.href = `tel:+${formattedPhone}`;

          // Configurar WhatsApp
          const whatsappLink = document.getElementById('whatsappLink');
          whatsappLink.href = `https://wa.me/${formattedPhone}`;
        }
      })
      .catch(err => console.error('Error loading gestor:', err));

    // Responsive pagination (si existe)
    if (window.innerWidth < 768) {
      const paginationLinks = document.querySelectorAll(".cuvar-pagination .pagelink-item");
      paginationLinks.forEach((el, index) => {
        if (index >= 6) el.style.display = "none";
      });
    }
  });
</script>