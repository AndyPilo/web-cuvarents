<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body class="bg-gray-50 font-sans antialiased text-slate-600">
    <?php include_once __DIR__ . '/../../../includes/navbar.php'; ?>

    <main class="min-h-screen pb-12">

        <div class="bg-white border-b border-gray-100">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6">
                <nav class="mb-4 flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-2 text-sm text-gray-500">
                        <!-- Inicio -->
                        <li class="inline-flex items-center">
                            <a href="<?= BASE_URL ?>"
                                class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-800 transition-colors">
                                <svg class="w-4 h-4 me-1.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                                </svg>
                                Inicio
                            </a>
                        </li>

                        <!-- Rentas -->
                        <li>
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <a href="<?= BASE_URL ?>rents"
                                    class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-800 transition-colors">
                                    Rentas
                                </a>
                            </div>
                        </li>

                        <!-- Página actual -->
                        <li aria-current="page">
                            <div class="flex items-center space-x-1.5">
                                <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                                </svg>
                                <span class="inline-flex items-center text-sm font-semibold text-gray-900 truncate max-w-[150px] sm:max-w-xs">
                                    <?= htmlspecialchars($renta['rental_title']) ?>
                                </span>
                            </div>
                        </li>
                    </ol>
                </nav>


                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 tracking-tight mb-2">
                            <?= htmlspecialchars($renta['rental_title']) ?>
                        </h1>
                        <div class="flex items-center gap-2 text-slate-500 text-sm md:text-base">
                            <svg class="h-5 w-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>
                                <?= htmlspecialchars($renta['rental_provincia']) ?>, <?= htmlspecialchars($renta['rental_municipio']) ?>
                            </span>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-2 md:mt-1">
                        <?php if (!empty($renta['is_promoted'])): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200 shadow-sm">
                                <svg class="mr-1.5 h-3 w-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                Destacado
                            </span>
                        <?php endif; ?>

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                            <?= htmlspecialchars($renta['type_time_rent']) ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8">

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 xl:gap-12">

                <div class="lg:col-span-8 space-y-8">

                    <?php
                    $rentalId   = $renta['rental_id'];
                    $images     = $renta['images'] ?? [];
                    $title      = htmlspecialchars($renta['rental_title']);
                    $baseImg    = BASE_URL . 'uploads/';
                    $defaultImg = BASE_URL . 'assets/img/default-img.png';
                    ?>

                    <section class="rounded-3xl overflow-hidden bg-gray-100 shadow-sm relative group">

                        <div class="block md:hidden relative">
                            <div class="swiper renta-gallery-mobile">
                                <div class="swiper-wrapper">
                                    <?php if (!empty($images)): ?>
                                        <?php foreach ($images as $index => $image): ?>
                                            <div class="swiper-slide">
                                                <a class="block relative aspect-[4/3]" href="<?= $baseImg . $image ?>" data-glightbox data-gallery="mobile-gallery">
                                                    <img src="<?= $baseImg . $image ?>" loading="lazy" alt="<?= $title ?>" class="absolute inset-0 w-full h-full object-cover">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="swiper-slide">
                                            <div class="aspect-[4/3] flex items-center justify-center bg-gray-200">
                                                <img src="<?= $defaultImg ?>" class="h-20 opacity-40">
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="swiper-button-next !text-white drop-shadow-md !w-8 !h-8 after:!text-lg"></div>
                                <div class="swiper-button-prev !text-white drop-shadow-md !w-8 !h-8 after:!text-lg"></div>
                            </div>

                            <?php if (!empty($images)): ?>
                                <div class="absolute bottom-4 right-4 z-10">
                                    <div class="bg-black/60 backdrop-blur-md text-white text-xs font-medium px-3 py-1 rounded-full">
                                        <span class="current-slide">1</span> / <?= count($images) ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="hidden md:block bg-white p-2 rounded-3xl border border-gray-100">
                            <?php if (!empty($images)): ?>
                                <div class="relative rounded-2xl overflow-hidden mb-2">
                                    <div class="swiper renta-gallery-main">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($images as $image): ?>
                                                <div class="swiper-slide">
                                                    <a href="<?= $baseImg . $image ?>" class="block aspect-[16/9] w-full" data-glightbox data-gallery="desktop-gallery">
                                                        <img src="<?= $baseImg . $image ?>" loading="lazy" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="swiper-button-next !text-white/80 hover:!text-white !w-10 !h-10 bg-black/20 hover:bg-black/40 rounded-full backdrop-blur-sm transition-all after:!text-xl"></div>
                                        <div class="swiper-button-prev !text-white/80 hover:!text-white !w-10 !h-10 bg-black/20 hover:bg-black/40 rounded-full backdrop-blur-sm transition-all after:!text-xl"></div>
                                    </div>

                                    <div class="absolute top-4 right-4 z-20 pointer-events-none">
                                        <span class="bg-black/50 backdrop-blur-md text-white px-3 py-1 rounded-full text-sm font-medium">
                                            <span class="current-slide">1</span> / <?= count($images) ?>
                                        </span>
                                    </div>
                                </div>

                                <?php if (count($images) > 1): ?>
                                    <div class="swiper renta-gallery-thumbs px-1 pb-1">
                                        <div class="swiper-wrapper">
                                            <?php foreach ($images as $image): ?>
                                                <div class="swiper-slide !w-24">
                                                    <div class="aspect-square rounded-lg overflow-hidden cursor-pointer border-2 border-transparent transition-all opacity-60 hover:opacity-100 [.swiper-slide-thumb-active_&]:border-cyan-500 [.swiper-slide-thumb-active_&]:opacity-100">
                                                        <img src="<?= $baseImg . $image ?>" class="w-full h-full object-cover">
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>
                                <div class="aspect-[16/9] bg-gray-100 flex items-center justify-center rounded-2xl">
                                    <div class="text-center text-gray-400">
                                        <svg class="h-16 w-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span>Sin imágenes disponibles</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </section>

                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">

                        <div class="flex flex-col sm:flex-row sm:items-center justify-between border-b border-gray-100 pb-6 mb-6">
                            <h2 class="text-xl md:text-2xl font-bold text-gray-900">
                                Detalles de la propiedad
                            </h2>
                            <div class="mt-4 sm:mt-0">
                                <div class="flex items-baseline gap-1">
                                    <span class="text-3xl font-bold text-cyan-700">
                                        <?php
                                        $price = $renta['rental_price'] == "1" ? "Consultar" : "$" . $renta['rental_price'];
                                        echo $price;
                                        ?>
                                    </span>
                                    <span class="text-sm text-gray-500 font-medium">
                                        / <?= htmlspecialchars($renta['rental_price_type']) ?>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
                            <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center hover:bg-cyan-50 hover:border-cyan-100 transition-colors">
                                <div class="bg-white p-2 rounded-full shadow-sm mb-2 text-cyan-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <span class="text-lg font-bold text-gray-900"><?= intval($renta['rental_capacity']) ?></span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Personas</span>
                            </div>

                            <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center hover:bg-cyan-50 hover:border-cyan-100 transition-colors">
                                <div class="bg-white p-2 rounded-full shadow-sm mb-2 text-cyan-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                    </svg>
                                </div>
                                <span class="text-lg font-bold text-gray-900"><?= intval($renta['rental_rooms']) ?></span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Habitaciones</span>
                            </div>

                            <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center hover:bg-cyan-50 hover:border-cyan-100 transition-colors">
                                <div class="bg-white p-2 rounded-full shadow-sm mb-2 text-cyan-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <span class="text-sm font-bold text-gray-900 truncate w-full px-2"><?= htmlspecialchars($renta['type_time_rent']) ?></span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Modalidad</span>
                            </div>

                            <div class="flex flex-col items-center justify-center p-4 rounded-2xl bg-slate-50 border border-slate-100 text-center hover:bg-cyan-50 hover:border-cyan-100 transition-colors">
                                <div class="bg-white p-2 rounded-full shadow-sm mb-2 <?= !empty($renta['is_promoted']) ? 'text-green-500' : 'text-gray-400' ?>">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <span class="text-lg font-bold text-gray-900"><?= !empty($renta['is_promoted']) ? 'Sí' : 'No' ?></span>
                                <span class="text-xs text-gray-500 uppercase tracking-wide">Verificado</span>
                            </div>
                        </div>

                        <div class="mb-10">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Sobre esta renta
                            </h3>
                            <div class="prose prose-slate prose-p:text-gray-600 prose-headings:font-bold prose-a:text-cyan-600 max-w-none">
                                <?= nl2br(htmlspecialchars($renta['rental_description'])) ?>
                            </div>
                        </div>

                        <?php if (!empty($renta['services'])): ?>
                            <div class="border-t border-gray-100 pt-8">
                                <h3 class="text-lg font-semibold text-gray-900 mb-6 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                    </svg>
                                    Comodidades y servicios
                                </h3>

                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4">
                                    <?php foreach ($renta['services'] as $service): ?>
                                        <div class="flex min-w-0 items-center gap-2 sm:gap-3 text-gray-700">
                                            <!-- Icono -->
                                            <div class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-50
                                                        text-cyan-600 group-hover:bg-cyan-50 group-hover:text-cyan-700 transition-colors">
                                                <div class="w-4 h-4 flex items-center justify-center [&>svg]:w-full [&>svg]:h-full">
                                                    <?= $service['icon'] ?>
                                                </div>
                                            </div>

                                            <!-- Texto -->
                                            <span class="text-xs sm:text-sm font-medium leading-tight break-words">
                                                <?= htmlspecialchars($service['name']) ?>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <div class="lg:col-span-4">
                    <div class="lg:sticky lg:top-24 space-y-6">
                        <div>
                            <div class="p-1">
                                <?php include_once __DIR__ . '/../../../includes/asideReserva.php'; ?>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 p-4 bg-cyan-50/50 rounded-xl border border-cyan-100 text-cyan-900 text-sm">
                            <svg class="w-10 h-10 text-cyan-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            <p class="font-medium">Reserva segura. Tu pago está protegido hasta que finalice tu estancia.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <?php include_once __DIR__ . '/modalReserva.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="<?= BASE_URL ?>assets/js/enviarReserva.js"></script>

    <?php include_once __DIR__ . '/../../../includes/footer.php'; ?>

    <script src="<?= BASE_URL ?>assets/js/glightbox.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/choices.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/nouislider.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/swiper-bundle.min.js"></script>

    <script>
        const hasMultipleImages = <?= (!empty($images) && count($images) > 1) ? 'true' : 'false' ?>;

        document.addEventListener('DOMContentLoaded', function() {
            // Swiper móvil
            if (window.innerWidth < 768) {
                const swiperMobile = new Swiper('.renta-gallery-mobile', {
                    slidesPerView: 1,
                    spaceBetween: 0,
                    loop: hasMultipleImages,
                    navigation: {
                        nextEl: '.renta-gallery-mobile .swiper-button-next',
                        prevEl: '.renta-gallery-mobile .swiper-button-prev',
                    },
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                    },
                    on: {
                        slideChange: function() {
                            const currentSlide = this.realIndex + 1;
                            document.querySelectorAll('.current-slide').forEach(el => el.textContent = currentSlide);
                        }
                    }
                });
            }

            // Swiper desktop logic
            const mainGalleryEl = document.querySelector('.renta-gallery-main');
            const thumbsGalleryEl = document.querySelector('.renta-gallery-thumbs');

            if (mainGalleryEl && thumbsGalleryEl) {
                const thumbSwiper = new Swiper('.renta-gallery-thumbs', {
                    spaceBetween: 10,
                    slidesPerView: 5,
                    freeMode: true,
                    watchSlidesProgress: true,
                    breakpoints: {
                        768: {
                            slidesPerView: 5
                        },
                        1024: {
                            slidesPerView: 6
                        },
                        1280: {
                            slidesPerView: 6
                        }
                    }
                });

                const mainSwiper = new Swiper('.renta-gallery-main', {
                    spaceBetween: 10,
                    loop: hasMultipleImages,
                    navigation: {
                        nextEl: '.renta-gallery-main .swiper-button-next',
                        prevEl: '.renta-gallery-main .swiper-button-prev',
                    },
                    thumbs: {
                        swiper: thumbSwiper,
                    },
                    effect: 'fade',
                    fadeEffect: {
                        crossFade: true
                    },
                    speed: 400,
                    on: {
                        slideChange: function() {
                            const currentSlide = this.realIndex + 1;
                            document.querySelectorAll('.current-slide').forEach(el => el.textContent = currentSlide);
                        }
                    }
                });
            }

            // Lightbox
            const lightbox = GLightbox({
                selector: '[data-glightbox]',
                touchNavigation: true,
                loop: true,
                zoomable: true,
                openEffect: 'zoom',
                closeEffect: 'fade',
                cssEfects: {
                    fade: {
                        in: 'fadeIn',
                        out: 'fadeOut'
                    },
                    zoom: {
                        in: 'zoomIn',
                        out: 'zoomOut'
                    }
                }
            });
        });
    </script>
</body>

</html>