<?php
// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "FiLe020594", "cotizaciones");

// Verificar si se ha enviado un archivo
if(isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == 0){
    // Obtener información del archivo
    $nombre_archivo = $_FILES["archivo"]["name"];
    $tipo_archivo = $_FILES["archivo"]["type"];
    $tamano_archivo = $_FILES["archivo"]["size"];
    $ruta_archivo = $_FILES["archivo"]["tmp_name"];

    // Abrir archivo para lectura
    $archivo = fopen($ruta_archivo, "rb");
    $contenido_archivo = fread($archivo, $tamano_archivo);
    fclose($archivo);

    // Generar nombre único para el archivo
    $nombre_unico = uniqid().'_'.$nombre_archivo;

    // Guardar archivo en el servidor
    $ruta_destino = "archivos/".$nombre_unico;
    move_uploaded_file($ruta_archivo, $ruta_destino);

    // Guardar información del archivo en la base de datos
    $query = "INSERT INTO archivos (id, nombre, tipo, tamano, ruta) VALUES ('$nombre_unico','$nombre_unico', '$tipo_archivo', $tamano_archivo, '$ruta_destino')";
    mysqli_query($conexion, $query);

    // Cerrar la conexión a la base de datos
    mysqli_close($conexion);

    // Mostrar mensaje de éxito
    echo "El archivo se ha subido correctamente.";
} else {
    // Mostrar mensaje de error
    echo "Error al subir el archivo.";
}
?>
