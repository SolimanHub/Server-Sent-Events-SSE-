<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$mysqli = new mysqli('localhost', 'root', '', 'pruebas');
$conecto=1;
if ($mysqli->connect_error) {
    die('Error de conexión a la base de datos: ' . $mysqli->connect_error);
$conecto=2;
}
$counter = 0;
while (true) {
  $result = $mysqli->query("SELECT MAX(id) as id FROM tabla1");
    $row = $result->fetch_assoc();
    $maxId = $row['id'];
    // Simulamos algún proceso en el servidor que genera datos
    $data = "Contador: ". $conecto . " - " . $maxId;
    // Enviamos los datos al cliente en el formato adecuado para SSE
    echo "data: $data\n\n";
    ob_flush(); // Liberamos el búfer de salida
    flush(); // Forzamos el envío de los datos al navegador
    // Esperamos un segundo antes de enviar la próxima actualización
    sleep(1);
}

?>

