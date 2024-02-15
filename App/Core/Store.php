<?php

class Store
{
    public static function store($source, $dst, $filename)
    {

        $folder = $_SERVER['DOCUMENT_ROOT'] . "/Public/Assets" . $dst;
        $fullPath = $folder . "/" . $filename;

        if (!file_exists($folder)) {
            mkdir($folder, 0775, true);
        }

        if (move_uploaded_file($source, $fullPath)) {
            $_SESSION['missatge_flash_ok'] = "El fitxer " . basename($filename) . " s'ha carregat correctament";
        } else {
            $_SESSION['missatge_flash_ko'] = "Error al carregar el fitxer";
        }
    }

    public static function get($dst, $filename)
    {
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/Public/Assets" . $dst;
        $fullPath = $folder . "/" . $filename;

        // echo '<pre>';
        // var_dump($fullPath);
        // echo '</pre>';

        // die();

        if (file_exists($fullPath)) {
            return $fullPath;
        } else {
            return null;
        }
    }


    // Puedes utilizar la función realpath() junto con la función str_replace() para obtener la ruta relativa desde la carpeta donde te encuentras. Aquí hay una versión modificada de tu función que hace eso:

    public static function getRelativePath($dst, $filename)
    {
        $folder = $_SERVER['DOCUMENT_ROOT'] . "/Public/Assets" . $dst;
        $fullPath = $folder . "/" . $filename;

        if (file_exists($fullPath)) {
            $absolutePath = realpath($fullPath);
            $basePath = realpath($_SERVER['DOCUMENT_ROOT'] . "/Public/Assets");

            // Verifica si la ruta es válida y está dentro de la carpeta base
            if ($absolutePath !== false && strpos($absolutePath, $basePath) === 0) {
                // Calcula la ruta relativa
                $relativePath = substr($absolutePath, strlen($basePath));
                return ltrim($relativePath, DIRECTORY_SEPARATOR);
            } else {
                // La ruta no es válida o no está dentro de la carpeta base
                return null;
            }
        } else {
            return null;
        }
    }
}
