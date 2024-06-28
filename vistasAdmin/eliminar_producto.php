<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

// Crear conexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexion
if ($conn->connect_error) {
    die("Conexion fallida: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $producto_id = $_POST['producto_id'];

    // SQL para eliminar el producto
    $sql = "DELETE FROM productos WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $producto_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Producto eliminado correctamente')</script>";
    } else {
        echo "<script>alert('Error al eliminar el producto: ')</script>" . $conn->error;
    }

    $stmt->close();
}

$conn->close();

// Redirigir de vuelta a la página de productos
header("Location: editarCarro.php");
exit();
?>
