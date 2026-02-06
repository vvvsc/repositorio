<?php
$archivo_lista = 'https://porcuerda.se.eu.org/lists/repositorio.txt'; // Archivo con lista de PDFs
$archivo_salida = 'index.html'; // Archivo HTML que se generará

// Abrir archivo lista para lectura
$handle = fopen($archivo_lista, 'r');
if (!$handle) {
    die("No se pudo abrir el archivo $archivo_lista");
}

// Abrir archivo html para escritura
$html_file = fopen($archivo_salida, 'w');
if (!$html_file) {
    fclose($handle);
    die("No se pudo crear el archivo $archivo_salida");
}

// Escribir estructura inicial HTML
fwrite($html_file, "<!DOCTYPE html>\n<html>\n<head><title>Lista de PDFs</title><link rel=\"stylesheet\" href=\"https://cdn.simplecss.org/simple.min.css\"></head>\n<body>\n<img src=\"https://villalba.is.eu.org/img/logo.svg\">");

while (($linea = fgets($handle)) !== false) {
    $linea = trim($linea);
    if ($linea === '') continue;

    $url_pdf = "https://rep.hstn.me/$linea"; // Cambia al dominio real y ruta

    // Escribir cada entrada en HTML
    fwrite($html_file, "<iframe src=\"$url_pdf\" id=\"$linea\" width=\"600\" height=\"400\"></iframe>\n<br><br>\n");
    fwrite($html_file, "<a href=\"$url_pdf\" download><p>$linea</p></a>\n");
}

// Cerrar etiquetas HTML y archivos
fwrite($html_file, "</body>\n</html>");
fclose($handle);
fclose($html_file);

echo "Archivo $archivo_salida generado correctamente.\n";
