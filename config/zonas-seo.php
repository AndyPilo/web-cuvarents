<?php
// Config SEO por destino (provincia o municipio).

return [

    // -------------------------
    // LA HABANA (provincia)
    // -------------------------
    'la-habana' => [
        'primary_keyword' => 'casas particulares en La Habana',

        'title' => 'Casas particulares en La Habana: zonas y alojamientos | CuVaRents',
        'description' => 'Encuentra casas particulares en La Habana (Cuba). Compara alojamientos por zonas, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Capital de Cuba',
        'h1' => 'Casas particulares en La Habana (Cuba): alojamientos por zonas',
        'intro' => 'La Habana es el punto de partida ideal para descubrir Cuba. Aquí encontrarás casas particulares y apartamentos para hospedarte con comodidad, ya sea cerca del centro histórico, en zonas más modernas o en áreas tranquilas para descansar. Compara opciones por capacidad, número de habitaciones y servicios, y reserva por WhatsApp de forma rápida y segura.',

        'sections' => [
            [
                'h2' => 'Dónde alojarse en La Habana según tu estilo de viaje',
                'p'  => 'Si quieres caminar a los puntos más turísticos y vivir el ambiente histórico, prioriza ubicaciones céntricas. Para un viaje más tranquilo o de trabajo, suele convenir una zona residencial con buen acceso a transporte. Lo más importante es equilibrar ubicación, comodidad y el tipo de experiencia que buscas.'
            ],
            [
                'h2' => 'Qué revisar antes de reservar una casa particular',
                'p'  => 'Antes de confirmar, verifica capacidad real, número de habitaciones, aire acondicionado, agua caliente y condiciones de entrada/salida. También conviene preguntar por detalles prácticos: si hay cocina, parqueo (si lo necesitas) y cómo se gestiona la comunicación durante la estancia.'
            ],
        ],

        'faq' => [
            [
                'q' => '¿Qué es una casa particular en Cuba?',
                'a' => 'Es un tipo de hospedaje gestionado por anfitriones locales. Puede ser una habitación o una vivienda completa, y suele ofrecer una experiencia más flexible que un hotel.'
            ],
            [
                'q' => '¿Qué zona de La Habana es mejor para hospedarse?',
                'a' => 'Depende de tu plan: para turismo y caminatas convienen zonas céntricas; para tranquilidad, una zona residencial; para combinar vida urbana y accesos, busca ubicaciones con buena movilidad.'
            ],
            [
                'q' => '¿Cómo reservo una casa particular en La Habana?',
                'a' => 'Elige la propiedad, consulta disponibilidad y confirma la reserva por WhatsApp siguiendo las indicaciones del anuncio.'
            ],
            [
                'q' => '¿Qué servicios son más importantes?',
                'a' => 'Aire acondicionado suele ser clave por el clima. También agua caliente, buena ubicación y fotos claras del espacio.'
            ],
            [
                'q' => '¿Hay opciones para familias o grupos?',
                'a' => 'Sí. Filtra por capacidad y habitaciones para encontrar opciones adecuadas.'
            ],
            [
                'q' => '¿Conviene reservar con antelación?',
                'a' => 'En temporadas altas o si buscas una zona específica, sí. Las mejores opciones se ocupan primero.'
            ],
        ],

        'links' => [
            // Ajusta estas URLs si existen en tu sitio
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Alojamientos de lujo en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-de-lujo'],
        ],

        'intro_bottom' => 'Elegir bien tu alojamiento en La Habana te ayuda a aprovechar el tiempo: menos traslados y más experiencia. Compara propiedades por ubicación y servicios, y prioriza lo que realmente necesitas para tu viaje. Si tienes dudas, consulta por WhatsApp antes de confirmar.',
    ],

    // -------------------------
    // VARADERO (municipio)
    // -------------------------
    'varadero' => [
        'primary_keyword' => 'casas particulares en Varadero',

        'title' => 'Casas particulares en Varadero: Rentas en la playa | CuVaRents',
        'description' => 'Encuentra casas particulares en Varadero (Cuba). Compara alojamientos por ubicación, capacidad y servicios, mira fotos y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Destino de playa',
        'h1' => 'Casas particulares en Varadero (Cuba): alojamientos y alquileres',
        'intro' => 'Varadero es uno de los destinos de playa más buscados de Cuba. Aquí puedes encontrar casas particulares y alojamientos cerca del mar para parejas, familias o grupos. Compara opciones por capacidad, habitaciones y servicios como aire acondicionado, cocina o parqueo (según disponibilidad), y reserva por WhatsApp de forma sencilla.',

        'sections' => [
            [
                'h2' => 'Mejores zonas para alojarse en Varadero',
                'p'  => 'Varadero es un destino alargado y no todo queda igual de cerca. Si quieres playa y caminatas, prioriza zonas con buen acceso al mar. Si buscas descanso, convienen áreas más tranquilas. Para salir por la noche, valora ubicaciones con transporte fácil.'
            ],
            [
                'h2' => 'Precios orientativos y qué suele incluir la renta',
                'p'  => 'El precio varía por temporada, cercanía a la playa, tamaño y comodidades. Antes de reservar, revisa qué incluye: aire acondicionado, agua caliente, cocina equipada y si hay costos extra por personas adicionales.'
            ],
            [
                'h2' => 'Consejos para reservar sin sorpresas',
                'p'  => 'Pregunta por la ubicación real, reglas de entrada/salida y servicios incluidos. Si viajas en grupo, confirma capacidad y distribución de camas para evitar incomodidades.'
            ],
        ],

        'faq' => [
            ['q' => '¿Cuánto cuesta una casa particular en Varadero?', 'a' => 'Depende de la temporada, la ubicación y los servicios. Compara varias opciones y prioriza lo que realmente necesitas (cercanía al mar, espacio o comodidad).'],
            ['q' => '¿Es mejor alojarse cerca de la playa?', 'a' => 'Si tu plan es ir caminando al mar, sí. Si buscas tranquilidad o mejor presupuesto, una zona más residencial puede ser ideal.'],
            ['q' => '¿Hay apartamentos completos en Varadero?', 'a' => 'Sí, existen casas y apartamentos completos. Revisa el tipo de propiedad y la capacidad.'],
            ['q' => '¿Qué servicios son imprescindibles?', 'a' => 'Aire acondicionado suele ser clave. También agua caliente y una ubicación acorde a tu plan de viaje.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Elige la propiedad y coordina disponibilidad y detalles por WhatsApp.'],
            ['q' => '¿Conviene reservar con antelación?', 'a' => 'En temporada alta, sí. Las mejores ubicaciones se ocupan primero.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
            ['label' => 'Alojamientos de lujo en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents/casas-de-lujo'],
        ],

        'intro_bottom' => 'Para una estancia cómoda en Varadero, enfócate en ubicación real, servicios y tamaño. Si tu viaje es corto, prioriza logística y cercanía. Si te quedas más días, valora cocina, tranquilidad y comodidad general. Compara, guarda tus favoritas y reserva por WhatsApp.',
    ],

    // -------------------------
    // TRINIDAD (municipio)
    // -------------------------
    'trinidad' => [
        'primary_keyword' => 'casas particulares en Trinidad Cuba',

        'title' => 'Casas particulares en Trinidad, Cuba: centro histórico y alrededores | CuVaRents',
        'description' => 'Encuentra casas particulares en Trinidad, Cuba. Alojamiento cerca del centro histórico, con opciones para parejas y familias. Compara y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Ciudad colonial',
        'h1' => 'Casas particulares en Trinidad (Cuba): alojamiento para tu visita',
        'intro' => 'Trinidad es una de las ciudades más encantadoras de Cuba por su arquitectura y ambiente colonial. Aquí encontrarás casas particulares para hospedarte cerca del centro histórico o en zonas más tranquilas. Compara alojamientos por capacidad, habitaciones y servicios, y reserva por WhatsApp de manera rápida.',

        'sections' => [
            [
                'h2' => 'Alojamiento cerca del centro histórico: ventajas',
                'p'  => 'Hospedarte cerca del centro facilita recorrer a pie, disfrutar la vida cultural y moverte con menos traslados. Si prefieres descanso, una zona un poco más alejada puede darte más tranquilidad.'
            ],
            [
                'h2' => 'Qué tipo de alojamiento conviene según tu plan',
                'p'  => 'Para escapadas románticas, busca opciones con buena privacidad. Para familias o grupos, prioriza capacidad, habitaciones y áreas comunes. Si planeas combinar Trinidad con Playa Ancón, considera la logística de transporte.'
            ],
        ],

        'faq' => [
            ['q' => '¿Conviene alojarse cerca del centro?', 'a' => 'Sí si quieres caminar y vivir el ambiente. Si priorizas tranquilidad, una zona algo más apartada puede ser mejor.'],
            ['q' => '¿Hay opciones para familias?', 'a' => 'Sí. Filtra por capacidad y habitaciones para elegir la mejor opción.'],
            ['q' => '¿Cómo reservo una casa particular en Trinidad?', 'a' => 'Selecciona la propiedad, consulta disponibilidad y confirma por WhatsApp.'],
            ['q' => '¿Qué servicios son más útiles?', 'a' => 'Aire acondicionado, agua caliente y una ubicación acorde a tu plan son los más valorados.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Trinidad se disfruta con calma: caminar, descubrir rincones y descansar en un alojamiento cómodo. Compara fotos, servicios y ubicación para elegir bien. Si tienes dudas, consulta por WhatsApp antes de confirmar.',
    ],

    // -------------------------
    // SANTIAGO DE CUBA (provincia o municipio según tu ruta)
    // -------------------------
    'santiago-de-cuba' => [
        'primary_keyword' => 'casas particulares en Santiago de Cuba',

        'title' => 'Casas particulares en Santiago de Cuba: alojamientos y rentas | CuVaRents',
        'description' => 'Descubre casas particulares en Santiago de Cuba. Compara alojamientos por ubicación, capacidad y servicios, y reserva por WhatsApp con CuVaRents.',

        'subtitle' => 'Oriente cubano',
        'h1' => 'Casas particulares en Santiago de Cuba: alojamiento con esencia local',
        'intro' => 'Santiago de Cuba es cultura, música e historia. Aquí puedes encontrar casas particulares para hospedarte cerca de puntos de interés o en zonas más tranquilas. Compara opciones por capacidad, habitaciones y servicios, y reserva por WhatsApp de manera sencilla.',

        'sections' => [
            [
                'h2' => 'Cómo elegir alojamiento en Santiago de Cuba',
                'p'  => 'Define tu plan: si quieres moverte a pie a lugares culturales, prioriza ubicaciones céntricas. Si buscas descanso, conviene una zona residencial. Revisa servicios como aire acondicionado y agua caliente.'
            ],
        ],

        'faq' => [
            ['q' => '¿Hay opciones para grupos?', 'a' => 'Sí. Filtra por capacidad y habitaciones para encontrar opciones adecuadas.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Elige la propiedad y coordina disponibilidad por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Comparar ubicación y servicios te ayuda a elegir una renta que se ajuste a tu viaje. Si necesitas confirmar detalles, consulta por WhatsApp antes de reservar.',
    ],

    // -------------------------
    // VIÑALES (municipio) - slug suele ser "vinales"
    // -------------------------
    'vinales' => [
        'primary_keyword' => 'casas particulares en Viñales',

        'title' => 'Casas particulares en Viñales: naturaleza | CuVaRents',
        'description' => 'Encuentra casas particulares en Viñales (Cuba). Alojamiento rural cerca del valle, con opciones tranquilas y auténticas. Compara y reserva por WhatsApp.',

        'subtitle' => 'Naturaleza y valle',
        'h1' => 'Casas particulares en Viñales (Cuba): alojamiento rural',
        'intro' => 'Viñales es ideal para quienes buscan naturaleza y un ritmo más tranquilo. Aquí puedes encontrar casas particulares y alojamientos rurales para descansar cerca del valle. Compara opciones por capacidad, habitaciones y servicios, y reserva por WhatsApp de forma rápida.',

        'sections' => [
            [
                'h2' => 'Qué buscar en una casa particular en Viñales',
                'p'  => 'Si tu plan incluye excursiones y naturaleza, prioriza tranquilidad, descanso y una ubicación cómoda para moverte. Revisa servicios esenciales y disponibilidad según temporada.'
            ],
        ],

        'faq' => [
            ['q' => '¿Viñales es buena opción para turismo de naturaleza?', 'a' => 'Sí. Es uno de los destinos más conocidos de Cuba para rutas, valle y paisajes.'],
            ['q' => '¿Cómo reservo?', 'a' => 'Elige la propiedad y coordina disponibilidad por WhatsApp.'],
        ],

        'links' => [
            ['label' => 'Ver todas las propiedades en Cuba', 'url' => rtrim(BASE_URL, '/') . '/rents'],
        ],

        'intro_bottom' => 'Viñales se disfruta mejor con un alojamiento cómodo para descansar tras las actividades del día. Compara ubicación, servicios y capacidad para elegir tu mejor opción y reserva por WhatsApp.',
    ],
];
