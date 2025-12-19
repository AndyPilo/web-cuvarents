<?php
// src/controllers/SitemapController.php

require_once __DIR__ . '/../models/Renta.php';
require_once __DIR__ . '/../../utils/slugify.php';

class SitemapController
{
    private Renta $rentaModel;

    public function __construct()
    {
        $this->rentaModel = new Renta();
    }

    public function index(): void
    {
        // Si tienes Cloudflare con challenge, es importante que /sitemap.xml no esté protegido.
        header('Content-Type: application/xml; charset=utf-8');

        $base = rtrim(BASE_URL, '/') . '/'; // Debe terminar con /

        // Traer rentas (ya viene filtrado por is_hidden = FALSE)
        $rentas = $this->rentaModel->getAllForSitemap();

        // Helper: normaliza lastmod a YYYY-MM-DD (sitemap estándar)
        $formatLastmod = function ($value): ?string {
            if (empty($value)) return null;
            $ts = strtotime((string)$value);
            if ($ts === false) return null;
            return date('Y-m-d', $ts);
        };

        // Helper: escribir URL de forma segura
        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->startDocument('1.0', 'UTF-8');
        $xml->startElement('urlset');
        $xml->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        $addUrl = function (string $loc, ?string $lastmod = null, ?string $changefreq = null, ?string $priority = null) use ($xml) {
            $xml->startElement('url');
            $xml->writeElement('loc', $loc);

            if ($lastmod) {
                $xml->writeElement('lastmod', $lastmod);
            }
            if ($changefreq) {
                $xml->writeElement('changefreq', $changefreq);
            }
            if ($priority) {
                $xml->writeElement('priority', $priority);
            }

            $xml->endElement(); // url
        };

        // =========================
        // 1) Páginas estáticas
        // =========================
        $addUrl($base, null, 'daily', '1.0');
        $addUrl($base . 'rents', null, 'daily', '1.0');
        $addUrl($base . 'about', null, 'monthly', '0.6');
        $addUrl($base . 'contact', null, 'monthly', '0.6');

        // =========================
        // 2) Categorías (indexables)
        // =========================
        $categories = [
            'casas-de-lujo',
            'casas-en-la-playa',
            'casas-y-apartamentos-por-largas-y-cortas-estancias',
            'casas-y-alojamientos-vacacionales'
        ];

        foreach ($categories as $slug) {
            $addUrl($base . "rents/{$slug}", null, 'daily', '0.9');
        }

        // =========================
        // 3) Provincias (solo las que quieres)
        // =========================
        $provincias = [
            'La Habana',
            'Cienfuegos',
        ];

        foreach ($provincias as $provinciaName) {
            $provSlug = slugify($provinciaName);
            $addUrl($base . "rents/provincias/{$provSlug}", null, 'daily', '0.9');
        }

        // =========================
        // 4) Municipios (solo los que quieres)
        // =========================
        $municipios = [
            'Varadero',
            'Trinidad',
            'Viñales',
        ];

        foreach ($municipios as $municipioName) {
            $munSlug = slugify($municipioName);
            $addUrl($base . "rents/municipios/{$munSlug}", null, 'daily', '0.9');
        }

        // =========================
        // 5) Rentas individuales
        // =========================
        foreach ($rentas as $r) {
            $id = (int)($r['rental_id'] ?? 0);
            $title = (string)($r['rental_title'] ?? '');
            if ($id <= 0 || $title === '') continue;

            $slug = slugify($title);
            $loc  = $base . "rents/{$slug}-{$id}";

            $lastmod = $formatLastmod($r['rental_updated_at'] ?? null);

            $addUrl($loc, $lastmod, 'weekly', '0.8');
        }

        $xml->endElement();   // urlset
        $xml->endDocument();

        echo $xml->outputMemory();
        exit;
    }
}
