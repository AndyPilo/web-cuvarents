<?php
// src/config/categorias-seo.php
// Config SEO por CATEGORÍA (rents/{categoriaSlug})
// Formato compatible con rentasView.php (intro, intro_bottom, sections, faq, links)

return [

    // =========================================================
    // CATEGORÍAS ACTUALES
    // =========================================================

    // -------------------------
    // Casas de lujo
    // URL sugerida: /rents/casas-de-lujo
    // -------------------------
    'casas-de-lujo' => [
        'primary_keyword' => 'casas de lujo en cuba',

        'title' => 'Casas de lujo en Cuba | CuVaRents',
        'description' => 'Descubre casas de lujo en Cuba: alojamientos premium con mayor comodidad. Compara por destino, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Alojamientos premium',
        'h1' => 'Casas de lujo en Cuba: villas y alojamientos premium',
        'intro' => 'Explora casas de lujo en Cuba para viajes donde la comodidad y los detalles importan. Compara opciones por destino, capacidad, habitaciones y servicios disponibles, revisa fotos y reserva por WhatsApp de forma sencilla.',

        'sections' => [
            [
                'h2' => 'Qué considerar al elegir una casa de lujo en Cuba',
                'p'  => 'Prioriza lo que realmente aporta valor a tu estancia: privacidad, amplitud, ubicación y servicios. Revisa fotos, distribución, capacidad real y condiciones antes de confirmar.'
            ],
            [
                'h2' => 'Cómo comparar alojamientos premium para decidir mejor',
                'p'  => 'Compara 3–5 opciones: ubicación, tamaño, servicios y reglas. Si viajas en grupo, valida habitaciones y distribución de camas para evitar sorpresas.'
            ],
        ],

        'faq' => [
            ['q' => '¿Qué se considera una casa de lujo en Cuba?', 'a' => 'Suele destacar por mayor comodidad, mejores espacios y servicios, buena ubicación o mayor privacidad. Revisa fotos y características de cada propiedad.'],
            ['q' => '¿Hay opciones para grupos grandes?', 'a' => 'Sí. Filtra por capacidad y habitaciones para encontrar opciones adecuadas.'],
            ['q' => '¿Cómo reservo una casa de lujo?', 'a' => 'Elige la propiedad y coordina disponibilidad y condiciones por WhatsApp.'],
            ['q' => '¿Conviene reservar con antelación?', 'a' => 'En temporada alta, sí. Las mejores opciones y ubicaciones se ocupan primero.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Casas en la playa en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-en-la-playa'],
            ['label' => 'Casas y alojamientos vacacionales', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-alojamientos-vacacionales'],
        ],

        'intro_bottom' => 'En alojamientos premium, comparar con calma marca la diferencia. Elige por ubicación, privacidad y servicios que realmente usarás. Si tienes dudas, consulta por WhatsApp antes de confirmar.',
    ],


    // -------------------------
    // Casas en la playa
    // URL sugerida: /rents/casas-en-la-playa
    // -------------------------
    'casas-en-la-playa' => [
        'primary_keyword' => 'casas en la playa en cuba',

        'title' => 'Casas en la playa en Cuba | CuVaRents',
        'description' => 'Explora casas en la playa en Cuba y alojamientos cerca del mar. Compara por destino, precio, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Alojamientos cerca del mar',
        'h1' => 'Casas en la playa en Cuba: rentas y alojamientos cerca del mar',
        'intro' => 'Si estás buscando casas en la playa en Cuba, aquí puedes comparar alojamientos cerca del mar en distintos destinos. Filtra por capacidad, habitaciones, precio y servicios (según disponibilidad) y reserva por WhatsApp de forma rápida.',

        'sections' => [
            [
                'h2' => 'Cómo elegir una casa cerca del mar en Cuba',
                'p'  => 'Prioriza ubicación real, comodidad y logística. Revisa capacidad, habitaciones y servicios clave como aire acondicionado, agua caliente y cocina si piensas quedarte varios días.'
            ],
            [
                'h2' => 'Qué revisar antes de reservar una renta de playa',
                'p'  => 'Confirma reglas de la casa, entrada/salida, condiciones de reserva y servicios incluidos. Si tu prioridad es estar a pocos minutos del mar, pregunta por la distancia real antes de confirmar.'
            ],
            [
                'h2' => 'Consejos para vacaciones de playa sin sorpresas',
                'p'  => 'Guarda tus favoritas y compara fotos, ubicación y servicios. Si viajas en temporada alta, reserva con tiempo para conseguir mejores opciones.'
            ],
        ],

        'faq' => [
            ['q' => '¿Cómo reservo una casa en la playa en Cuba?', 'a' => 'Elige una propiedad, revisa detalles y fotos, y coordina disponibilidad y condiciones por WhatsApp.'],
            ['q' => '¿Qué servicios son más importantes en una renta de playa?', 'a' => 'Aire acondicionado suele ser clave. También agua caliente, cocina si la necesitas y una ubicación acorde a tu plan.'],
            ['q' => '¿Hay opciones para familias o grupos?', 'a' => 'Sí. Filtra por capacidad y número de habitaciones para encontrar alojamientos adecuados.'],
            ['q' => '¿Conviene reservar con antelación?', 'a' => 'En temporada alta, sí. Las mejores ubicaciones se ocupan primero.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Casas de lujo en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-de-lujo'],
            ['label' => 'Casas y alojamientos vacacionales', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-alojamientos-vacacionales'],
            // Cuando exista:
            ['label' => 'Casas con piscina en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-con-piscina'],
        ],

        'intro_bottom' => 'Para elegir bien una renta de playa, enfócate en ubicación real, servicios esenciales y el tipo de viaje que harás. Compara varias opciones, guarda tus favoritas y reserva por WhatsApp cuando tengas claro tu plan.',
    ],


    // -------------------------
    // Casas y Apartamentos por largas y cortas estancias
    // URL sugerida: /rents/casas-y-apartamentos-por-largas-y-cortas-estancias
    // -------------------------
    'casas-y-apartamentos-por-largas-y-cortas-estancias' => [
        'primary_keyword' => 'alquiler temporal en cuba',

        'title' => 'Alquiler temporal en Cuba: largas y cortas estancias | CuVaRents',
        'description' => 'Encuentra alquiler temporal en Cuba para estancias cortas o largas. Compara casas y apartamentos por destino, capacidad y servicios y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Cortas y largas estancias',
        'h1' => 'Alquiler temporal en Cuba: casas y apartamentos para largas y cortas estancias',
        'intro' => 'Si buscas alquiler temporal en Cuba, aquí puedes comparar casas y apartamentos para estancias cortas o largas. Filtra por destino, capacidad, habitaciones y servicios disponibles, revisa fotos y reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cómo elegir alojamiento para estancias cortas',
                'p'  => 'Prioriza ubicación práctica y servicios esenciales. Si estarás pocos días, reducir traslados y tener buena logística suele ser lo más importante.'
            ],
            [
                'h2' => 'Qué priorizar en estancias largas en Cuba',
                'p'  => 'Para varios días o semanas, valora cocina, comodidad general, espacio y condiciones claras. Pregunta por reglas y detalles importantes antes de confirmar.'
            ],
            [
                'h2' => 'Consejos para comparar casas y apartamentos',
                'p'  => 'Compara 3–5 opciones por fotos, ubicación, capacidad y servicios. Si viajas en grupo, confirma distribución de camas y capacidad real.'
            ],
        ],

        'faq' => [
            ['q' => '¿Qué es alquiler temporal en Cuba?', 'a' => 'Es alojamiento por días o semanas, ideal para viajes cortos o estancias más largas. Puedes comparar casas o apartamentos según tu plan.'],
            ['q' => '¿Cómo elijo entre casa o apartamento?', 'a' => 'Depende de tu preferencia: privacidad, espacios, cocina y ubicación. Revisa fotos y características y decide según tu plan.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Selecciona la propiedad y coordina disponibilidad por WhatsApp.'],
            ['q' => '¿Puedo filtrar por capacidad y servicios?', 'a' => 'Sí. Usa los filtros para encontrar opciones que se ajusten a tu viaje.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Apartamentos en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/apartamentos'],
            ['label' => 'Casas baratas en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-economicas'],
        ],

        'intro_bottom' => 'Si tu estancia será larga, la comodidad diaria importa. Si tu viaje es corto, la ubicación y la logística mandan. Compara opciones y consulta por WhatsApp antes de confirmar.',
    ],


    // -------------------------
    // Casas y Alojamientos vacacionales
    // URL sugerida: /rents/casas-y-alojamientos-vacacionales
    // -------------------------
    'casas-y-alojamientos-vacacionales' => [
        'primary_keyword' => 'alojamientos vacacionales en cuba',

        'title' => 'Alojamientos vacacionales en Cuba: casas y rentas | CuVaRents',
        'description' => 'Explora alojamientos vacacionales en Cuba: casas, apartamentos y villas. Compara por destino, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Vacaciones en Cuba',
        'h1' => 'Alojamientos vacacionales en Cuba: casas, apartamentos y villas',
        'intro' => 'Descubre alojamientos vacacionales en Cuba para tu viaje: casas, apartamentos y opciones para familias, parejas o grupos. Compara por destino, capacidad, habitaciones y servicios disponibles y reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cómo elegir un alojamiento vacacional en Cuba',
                'p'  => 'Define tu tipo de viaje (playa, ciudad, naturaleza) y elige por ubicación, capacidad y servicios. Revisa fotos y condiciones para decidir con seguridad.'
            ],
            [
                'h2' => 'Qué revisar antes de reservar',
                'p'  => 'Confirma reglas, entrada/salida, servicios incluidos y capacidad real. Si viajas en temporada alta, reserva con antelación.'
            ],
        ],

        'faq' => [
            ['q' => '¿Qué tipos de alojamientos vacacionales hay en CuVaRents?', 'a' => 'Según disponibilidad, puedes encontrar casas, apartamentos, villas y otras opciones. Usa filtros para elegir mejor.'],
            ['q' => '¿Cómo reservo un alojamiento vacacional?', 'a' => 'Elige la propiedad y coordina disponibilidad por WhatsApp.'],
            ['q' => '¿Hay opciones para familias o grupos?', 'a' => 'Sí. Filtra por capacidad y habitaciones.'],
        ],

        'links' => [
            ['label' => 'Casas en la playa en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-en-la-playa'],
            ['label' => 'Villas en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/villas'],
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Un buen alojamiento vacacional se elige por ubicación, comodidad y servicios. Compara varias opciones y consulta por WhatsApp para confirmar detalles antes de reservar.',
    ],


    // =========================================================
    // CATEGORÍAS FUTURAS (ya incluidas para cuando las crees)
    // =========================================================

    // -------------------------
    // Casas con piscina
    // URL: /rents/casas-con-piscina
    // -------------------------
    'casas-con-piscina' => [
        'primary_keyword' => 'casas con piscina en cuba',

        'title' => 'Casas con piscina en Cuba: alojamientos y rentas | CuVaRents',
        'description' => 'Encuentra casas con piscina en Cuba. Compara alojamientos por destino, capacidad, precio y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Comodidad extra',
        'h1' => 'Casas con piscina en Cuba: rentas para vacaciones',
        'intro' => 'Si quieres más comodidad durante tu viaje, aquí puedes ver casas con piscina en Cuba. Compara por destino, capacidad, habitaciones y servicios disponibles, revisa fotos y coordina la reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cuándo conviene elegir una casa con piscina',
                'p'  => 'Es ideal para viajes en familia, grupos o si quieres privacidad y descanso. Revisa si la piscina es privada o compartida y las reglas de uso.'
            ],
            [
                'h2' => 'Qué confirmar antes de reservar',
                'p'  => 'Pregunta por disponibilidad real, mantenimiento y condiciones. Valida también servicios esenciales como aire acondicionado y agua caliente.'
            ],
        ],

        'faq' => [
            ['q' => '¿La piscina es privada?', 'a' => 'Depende de la propiedad. Revisa la descripción y confirma por WhatsApp si lo necesitas.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Elige la propiedad y coordina disponibilidad y condiciones por WhatsApp.'],
            ['q' => '¿Hay opciones para grupos?', 'a' => 'Sí. Filtra por capacidad y habitaciones.'],
        ],

        'links' => [
            ['label' => 'Casas de lujo en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-de-lujo'],
            ['label' => 'Alojamientos vacacionales', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-alojamientos-vacacionales'],
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Para elegir bien, compara ubicación, capacidad y reglas de uso. En temporada alta, reservar con antelación ayuda a conseguir mejores opciones.',
    ],


    // -------------------------
    // Apartamentos
    // URL: /rents/apartamentos
    // -------------------------
    'apartamentos' => [
        'primary_keyword' => 'apartamentos en cuba',

        'title' => 'Apartamentos en Cuba: alojamientos y rentas | CuVaRents',
        'description' => 'Explora apartamentos en Cuba para tu viaje. Compara por destino, capacidad, precio y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Privacidad y comodidad',
        'h1' => 'Apartamentos en Cuba: rentas para tu viaje',
        'intro' => 'Los apartamentos en Cuba son una excelente opción si buscas privacidad y comodidad. Aquí puedes comparar rentas por destino, capacidad, habitaciones y servicios disponibles, y reservar por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Ventajas de alquilar un apartamento en Cuba',
                'p'  => 'Suelen ofrecer independencia y espacios cómodos para estancias cortas o largas. Es ideal para parejas, familias o viajeros que desean mayor privacidad.'
            ],
            [
                'h2' => 'Qué revisar antes de reservar un apartamento',
                'p'  => 'Confirma ubicación, capacidad real, aire acondicionado, agua caliente y condiciones. Revisa fotos y descripción para evitar sorpresas.'
            ],
        ],

        'faq' => [
            ['q' => '¿Hay apartamentos completos disponibles?', 'a' => 'Sí, según disponibilidad. Revisa el tipo de propiedad, fotos y capacidad antes de reservar.'],
            ['q' => '¿Cómo reservo un apartamento en Cuba?', 'a' => 'Selecciona la propiedad y coordina disponibilidad y detalles por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Alquiler temporal (cortas y largas estancias)', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-apartamentos-por-largas-y-cortas-estancias'],
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Si tu prioridad es independencia, un apartamento suele ser una gran elección. Compara ubicación y servicios y consulta por WhatsApp antes de confirmar.',
    ],


    // -------------------------
    // Villas
    // URL: /rents/villas
    // -------------------------
    'villas' => [
        'primary_keyword' => 'villas en cuba',

        'title' => 'Villas en Cuba: alojamientos y rentas para vacaciones | CuVaRents',
        'description' => 'Descubre villas en Cuba para vacaciones: opciones amplias para familias y grupos. Compara por destino, capacidad y servicios y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Espacio para disfrutar',
        'h1' => 'Villas en Cuba: rentas ideales para familias y grupos',
        'intro' => 'Las villas en Cuba suelen ser una excelente opción si viajas con familia o amigos y quieres más espacio. Compara villas por destino, capacidad y servicios, revisa fotos y reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cuándo conviene elegir una villa',
                'p'  => 'Cuando viajas en grupo, buscas más privacidad o deseas áreas comunes amplias. Revisa capacidad real y distribución antes de reservar.'
            ],
            [
                'h2' => 'Qué comparar entre villas',
                'p'  => 'Ubicación, tamaño, servicios y reglas. Comparar varias opciones te ayuda a decidir mejor según tu presupuesto y tipo de viaje.'
            ],
        ],

        'faq' => [
            ['q' => '¿Las villas son solo para grupos grandes?', 'a' => 'No. También pueden ser una gran opción para familias o parejas que buscan más comodidad.'],
            ['q' => '¿Cómo reservo una villa en Cuba?', 'a' => 'Elige la propiedad y coordina disponibilidad por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Casas de lujo en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-de-lujo'],
            ['label' => 'Alojamientos vacacionales', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-alojamientos-vacacionales'],
        ],

        'intro_bottom' => 'Elige una villa comparando ubicación, capacidad y servicios. En temporada alta, reserva con anticipación para asegurar mejores opciones.',
    ],


    // -------------------------
    // Hostales
    // URL: /rents/hostales
    // -------------------------
    'hostales' => [
        'primary_keyword' => 'hostales en cuba',

        'title' => 'Hostales en Cuba: alojamientos y rentas | CuVaRents',
        'description' => 'Encuentra hostales en Cuba y opciones de alojamiento según tu presupuesto. Compara por destino, capacidad y servicios y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Opciones prácticas',
        'h1' => 'Hostales en Cuba: alojamiento para diferentes presupuestos',
        'intro' => 'Explora hostales en Cuba y opciones de alojamiento que se ajustan a tu plan de viaje. Compara por destino, capacidad y servicios disponibles, revisa fotos y coordina tu reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cómo elegir un hostal según tu plan',
                'p'  => 'Si quieres moverte mucho, prioriza ubicación y logística. Si buscas descanso, valora comodidad y servicios esenciales.'
            ],
            [
                'h2' => 'Qué confirmar antes de reservar',
                'p'  => 'Revisa fotos, reglas, capacidad real y condiciones. Si viajas en grupo, confirma distribución y disponibilidad.'
            ],
        ],

        'faq' => [
            ['q' => '¿Cómo reservo un hostal en Cuba?', 'a' => 'Selecciona la propiedad y coordina disponibilidad y detalles por WhatsApp.'],
            ['q' => '¿Qué servicios debo priorizar?', 'a' => 'Aire acondicionado y agua caliente suelen ser los más importantes. Luego, ubicación acorde a tu plan.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Apartamentos en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/apartamentos'],
        ],

        'intro_bottom' => 'Para una buena elección, compara ubicación, servicios y fotos. Si tienes dudas, consulta por WhatsApp antes de confirmar.',
    ],


    // -------------------------
    // Casas económicas
    // URL: /rents/casas-economicas
    // -------------------------
    'casas-economicas' => [
        'primary_keyword' => 'casas baratas en cuba',

        'title' => 'Casas baratas en Cuba: alojamientos económicos | CuVaRents',
        'description' => 'Descubre casas baratas en Cuba y alojamientos económicos. Filtra por destino, precio, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Mejor precio',
        'h1' => 'Casas baratas en Cuba: alojamientos económicos para tu viaje',
        'intro' => 'Si buscas ahorrar, aquí puedes encontrar casas baratas en Cuba y opciones económicas según disponibilidad. Compara por destino, precio, capacidad y servicios y reserva por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Cómo encontrar alojamiento económico sin sacrificar comodidad',
                'p'  => 'Define lo esencial (capacidad, ubicación aproximada y servicios clave) y compara opciones por precio. A veces una zona más tranquila ofrece mejor relación calidad/precio.'
            ],
            [
                'h2' => 'Qué revisar antes de reservar una renta económica',
                'p'  => 'Confirma servicios incluidos, capacidad real y reglas. Comparar fotos y leer bien la descripción evita sorpresas.'
            ],
        ],

        'faq' => [
            ['q' => '¿Cómo encuentro casas baratas en Cuba?', 'a' => 'Usa filtros por precio, capacidad y servicios y compara varias opciones por destino.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Elige la propiedad y coordina disponibilidad por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Alquiler temporal (cortas y largas estancias)', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-apartamentos-por-largas-y-cortas-estancias'],
        ],

        'intro_bottom' => 'Para ahorrar más, compara opciones y prioriza lo esencial. Si viajas en temporada alta, reserva con tiempo para encontrar mejores precios.',
    ],


    // -------------------------
    // Casas para familias
    // URL: /rents/casas-para-familias
    // -------------------------
    'casas-para-familias' => [
        'primary_keyword' => 'alojamiento en cuba para familias',

        'title' => 'Alojamiento en Cuba para familias: casas y rentas | CuVaRents',
        'description' => 'Encuentra alojamiento en Cuba para familias: casas y apartamentos con buena capacidad. Filtra por habitaciones, servicios y destino y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Viaje en familia',
        'h1' => 'Alojamiento en Cuba para familias: casas y rentas cómodas',
        'intro' => 'Para un viaje en familia, la comodidad y la logística importan. Aquí puedes comparar casas y apartamentos con buena capacidad, habitaciones y servicios disponibles, y reservar por WhatsApp.',

        'sections' => [
            [
                'h2' => 'Qué priorizar al viajar en familia',
                'p'  => 'Capacidad real, habitaciones suficientes y servicios esenciales. Una ubicación práctica reduce traslados y hace el viaje más cómodo.'
            ],
            [
                'h2' => 'Consejos para reservar una renta familiar',
                'p'  => 'Confirma distribución de camas, reglas y horarios. Si necesitas cocina o áreas comunes, revisa fotos y descripción antes de confirmar.'
            ],
        ],

        'faq' => [
            ['q' => '¿Hay opciones para familias grandes?', 'a' => 'Sí. Filtra por capacidad y número de habitaciones para encontrar opciones adecuadas.'],
            ['q' => '¿Cómo reservo un alojamiento familiar?', 'a' => 'Elige la propiedad y coordina disponibilidad y condiciones por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Villas en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/villas'],
            ['label' => 'Alojamientos vacacionales', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-y-alojamientos-vacacionales'],
        ],

        'intro_bottom' => 'En familia, elegir bien ahorra estrés: capacidad, habitaciones y ubicación práctica. Compara opciones y consulta por WhatsApp antes de confirmar.',
    ],
];
