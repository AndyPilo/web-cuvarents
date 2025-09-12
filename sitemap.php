<?php
header('Content-Type: application/xml; charset=utf-8');
require_once './uixsoftware/config/config.php';
require_once './utils/slugify.php';

echo '<?xml version="1.0" encoding="UTF-8"?>';
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

// URL principal
echo '<url>
        <loc>https://cuvarents.com/</loc>
        <priority>1.0</priority>
      </url>';

echo '<url>
        <loc>https://cuvarents.com/rents</loc>
        <priority>1.0</priority>
      </url>';

echo '<url>
        <loc>https://cuvarents.com/about</loc>
        <priority>1.0</priority>
      </url>';

echo '<url>
        <loc>https://cuvarents.com/contact</loc>
        <priority>1.0</priority>
      </url>';


// Obtener todas las rentas
$sql = "SELECT rental_id, rental_title FROM Rentals";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    $slug = slugify($row['rental_title']);
    $rentalId = $row['rental_id'];
    $categorySlug = slugify($row['rental_category']);
    $url = "https://cuvarents.com/rents/" . $slug . "-" . $rentalId;

    echo "<url>
            <loc>$url</loc>
            <priority>0.8</priority>
          </url>";
}

// Obtener todas las categorías
$sqlCategories = "SELECT rental_category FROM Rentals";
$resultCategories = $conn->query($sqlCategories);

while ($row = $resultCategories->fetch_assoc()) {
    $slug = slugify($row['rental_category']);
    $url = "https://cuvarents.com/rents/" . $slug;

    echo "<url>
            <loc>$url</loc>
            <priority>0.8</priority>
          </url>";
}



echo '</urlset>';
