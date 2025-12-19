<?php

if (!function_exists('slugify')) {
    function slugify($string)
    {
        // Reemplazo manual de caracteres acentuados y ñ
        $unwanted = array(
            'á' => 'a',
            'à' => 'a',
            'ä' => 'a',
            'â' => 'a',
            'Á' => 'a',
            'À' => 'a',
            'Ä' => 'a',
            'Â' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ë' => 'e',
            'ê' => 'e',
            'É' => 'e',
            'È' => 'e',
            'Ë' => 'e',
            'Ê' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'ï' => 'i',
            'î' => 'i',
            'Í' => 'i',
            'Ì' => 'i',
            'Ï' => 'i',
            'Î' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'ö' => 'o',
            'ô' => 'o',
            'Ó' => 'o',
            'Ò' => 'o',
            'Ö' => 'o',
            'Ô' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'ü' => 'u',
            'û' => 'u',
            'Ú' => 'u',
            'Ù' => 'u',
            'Ü' => 'u',
            'Û' => 'u',
            'ñ' => 'n',
            'Ñ' => 'n',
            'ç' => 'c',
            'Ç' => 'c'
        );
        $string = strtr($string, $unwanted);

        // Pasar a minúsculas
        $string = strtolower(trim($string));

        // Reemplazar cualquier cosa que no sea letra o número por guiones
        $string = preg_replace('/[^a-z0-9]+/i', '-', $string);

        // Eliminar guiones repetidos
        $string = preg_replace('/-+/', '-', $string);

        // Eliminar guiones al inicio y fin
        return trim($string, '-');
    }
}
