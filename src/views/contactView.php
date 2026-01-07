<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<body class="bg-gray-50 dark:bg-gray-900">
  <?php include_once __DIR__ . '/../../includes/navbar.php'; ?>

  <main class="min-h-screen">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 sm:py-16 lg:py-20">

      <!-- Header -->
      <div class="text-center mb-12 sm:mb-16">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl">
          <span class="block">¿Necesitas</span>
          <span class="block bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent">
            ayuda?
          </span>
        </h1>
        <p class="mx-auto mt-4 max-w-xl text-lg text-gray-600 dark:text-gray-300">
          Estamos aquí para resolver tus dudas y hacer tu experiencia más fácil
        </p>
      </div>

      <div class="grid lg:grid-cols-3 gap-8 lg:gap-12">

        <!-- Información de contacto -->
        <div class="lg:col-span-1 space-y-8">

          <!-- Tarjeta de teléfono -->
          <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-lg dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50">
            <div class="flex items-center gap-4 mb-6">
              <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Llámanos</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Le atendemos con gusto</p>
              </div>
            </div>
            <a
              id="phoneLink"
              class="block text-2xl font-bold text-cyan-700 dark:text-cyan-400 hover:text-cyan-800 dark:hover:text-cyan-300 transition-colors"
              href="#">
              Cargando...
            </a>
          </div>

          <!-- Tarjeta de email -->
          <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-lg dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50">
            <div class="flex items-center gap-4 mb-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Email</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Respondemos lo antes posible</p>
              </div>
            </div>
            <a
              href="mailto:agenciacuvarents@gmail.com"
              class="block text-lg font-medium text-gray-900 dark:text-gray-300 hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">
              agenciacuvarents@gmail.com
            </a>
          </div>

          <!-- Horario -->
          <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 shadow-lg dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50">
            <div class="flex items-center gap-4 mb-4">
              <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Horario</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Soporte continuo</p>
              </div>
            </div>
            <div class="space-y-2">
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Lunes - Domingo</span>
                <span class="font-medium text-gray-900 dark:text-white">24:00 h</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-600 dark:text-gray-400">Le atenderemos</span>
                <span class="font-medium text-gray-900 dark:text-white">lo antes posible</span>
              </div>
            </div>
          </div>

        </div>

        <!-- Formulario -->
        <div class="lg:col-span-2">
          <div class="rounded-2xl bg-white dark:bg-gray-800 p-6 sm:p-8 shadow-xl dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50">
            <div class="mb-8">
              <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Envíanos un mensaje
              </h2>
              <p class="mt-2 text-gray-600 dark:text-gray-300">
                Completa el formulario y nos pondremos en contacto contigo lo antes posible
              </p>
            </div>

            <form id="contactForm" novalidate class="space-y-6">

              <div class="grid gap-6 sm:grid-cols-2">
                <div>
                  <label for="fullName" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Nombre completo *
                  </label>
                  <input
                    type="text"
                    id="fullName"
                    required
                    class="block w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 px-4 py-3 text-gray-900 dark:text-gray-300 
                           shadow-sm dark:shadow-none outline-none transition focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 
                           focus:ring-cyan-500/30 dark:focus:ring-cyan-400/30 placeholder:text-gray-400 dark:placeholder:text-gray-500"
                    placeholder="Tu nombre">
                </div>

                <div>
                  <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Correo electrónico *
                  </label>
                  <input
                    type="email"
                    id="email"
                    required
                    class="block w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 px-4 py-3 text-gray-900 dark:text-gray-300 
                           shadow-sm dark:shadow-none outline-none transition focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 
                           focus:ring-cyan-500/30 dark:focus:ring-cyan-400/30 placeholder:text-gray-400 dark:placeholder:text-gray-500"
                    placeholder="tu@email.com">
                </div>
              </div>

              <div>
                <label for="message" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                  Mensaje *
                </label>
                <textarea
                  id="message"
                  rows="5"
                  required
                  class="block w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-700 px-4 py-3 text-gray-900 dark:text-gray-300 
                         shadow-sm dark:shadow-none outline-none transition focus:border-cyan-500 dark:focus:border-cyan-400 focus:ring-2 
                         focus:ring-cyan-500/30 dark:focus:ring-cyan-400/30 resize-none placeholder:text-gray-400 dark:placeholder:text-gray-500"
                  placeholder="¿En qué podemos ayudarte?"></textarea>
              </div>

              <div class="pt-2">
                <button
                  type="submit"
                  class="group relative w-full sm:w-auto inline-flex items-center justify-center 
                         rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 px-8 py-4 
                         text-base font-semibold text-white shadow-lg transition-all 
                         hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl 
                         focus:outline-none focus:ring-2 focus:ring-cyan-500 dark:focus:ring-cyan-400 focus:ring-offset-2 dark:focus:ring-offset-gray-900">
                  <span class="flex items-center">
                    <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                    Enviar por WhatsApp
                  </span>
                </button>
              </div>

            </form>
          </div>
        </div>

      </div>
    </div>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Cargar número del gestor
      fetch('api/getGestorActivo.php')
        .then(res => res.json())
        .then(data => {
          if (data.telefono) {
            const phoneLink = document.getElementById('phoneLink');
            const formattedPhone = data.telefono.replace(/\D/g, '');
            phoneLink.textContent = `+${formattedPhone}`;
            phoneLink.href = `tel:+${formattedPhone}`;
          }
        });

      // Formulario
      const form = document.getElementById('contactForm');
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        const name = document.getElementById('fullName').value.trim();
        const email = document.getElementById('email').value.trim();
        const message = document.getElementById('message').value.trim();

        // Validación simple
        if (!name || !email || !message) {
          alert('Por favor, completa todos los campos obligatorios');
          return;
        }

        fetch('api/getGestorActivo.php')
          .then(res => res.json())
          .then(data => {
            if (data.telefono) {
              const whatsappUrl = `https://wa.me/${data.telefono}?text=Hola, soy ${encodeURIComponent(name)}%0AEmail: ${encodeURIComponent(email)}%0A%0AMensaje:%0A${encodeURIComponent(message)}`;
              window.open(whatsappUrl, '_blank');
            } else {
              alert('No hay un gestor disponible en este momento. Por favor, inténtalo más tarde.');
            }
          })
          .catch(() => {
            alert('Error al conectar con el servidor. Por favor, intenta nuevamente.');
          });
      });
    });
  </script>

  <?php include_once __DIR__ . '/../../includes/footer.php'; ?>
</body>