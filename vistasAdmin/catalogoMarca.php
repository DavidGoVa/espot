<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

// Obtener la marca seleccionada del frontend (JavaScript)
$marcaSeleccionada = $_GET['marca'];

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['xd'])) {
    $cb = $_GET['xd'];

    // Preparar la consulta con un statement preparado para evitar SQL injection
$sql = "SELECT * FROM productos WHERE stock = 1 AND marca = ? $cb";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $marcaSeleccionada);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Salida de datos de cada fila
    while ($row = $result->fetch_assoc()) {
        echo "<a style='cursor:pointer; color:black;' href=''>";
        echo "<div style='border: solid 2px black; border-radius: 10px; margin:10px; max-width:381px; max-height:501px;' >";

        // Cambio para mostrar la imagen desde un campo BLOB en la base de datos
        echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagen']) . '" style="border-radius: 10px;width: 380px; height:fit-content">';
        echo "<form method='post' action='eliminar_producto.php' style='margin-left:10px; margin-bottom:10px;'>";
        echo "<input type='hidden' name='producto_id' value='" . $row['id'] . "'>";
        echo "<button type='submit' style='background-color:red; color:white; border:none; padding:10px; border-radius:5px; cursor:pointer;'>Eliminar</button>";
        echo "</form>";
        echo "</div>";
        echo "<h2 style='text-align: left; margin-left:10px; font-size:20px'>" . $row["marca"] . " • " . $row["nombre"] . "</h2>";
        echo "<p style='margin-left:10px'>" . $row["modelo"] . " • " . $row["kilometraje"] . "km" . " • " . $row["transmision"] . "</p>";
        echo "<p style='font-size:20px; margin-left:10px; margin-bottom: 5px'>Contado</p>";
        echo "<p style='margin-left:10px; font-size: 40px; margin-top:0px;border-bottom:solid 1px gray; margin-bottom:10px; border-top:solid 1px gray; margin-right:10px'> $" . $row["precio"] . "<span style='font-size:20px'>MXN</span></p>";
        echo "<p style='margin-left:10px; display:flex; align-items:center; margin-top:0px;margin-right:10px;'> <img src='img/ubi.png' style='width: 30px; height:fit-content'>" . $row["estado"] . "</p>";
        echo "</div>";
        echo "</a>";
    }
} else {
    echo "0 resultados";
}}
else {
    echo "Parámetro 'xd' no encontrado";
}


$stmt->close();
$conn->close();
?>
