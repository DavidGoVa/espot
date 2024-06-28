<?php
session_start();
error_reporting(0);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

// Verificar si la sesión está activa y obtener el correo del usuario actual
if (!isset($_SESSION['correoA']) || empty($_SESSION['correoA'])) {
    header("Location: ../inicio.html");
    exit();
}

// Correo del usuario actual
$correo = $_SESSION['correoA'];

// Conexión a la base de datos MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Consulta para obtener la imagen de perfil del usuario actual
$sql = "SELECT pp FROM usera WHERE correo = '$correo'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Si se encuentra un resultado, asignar el BLOB a $_SESSION['pp']
    $row = $result->fetch_assoc();
    $_SESSION['pp'] = $row['pp'];
} else {
    // Si no se encuentra ningún resultado, podrías asignar una imagen por defecto
    $_SESSION['pp'] = null; // Aquí podrías definir una imagen por defecto si el usuario no tiene imagen de perfil
}

$conn->close();

$profileP = $_SESSION['pp'];

// Verificar si la sesión tiene una imagen de perfil (pp)
if ($profileP !== null) {
    // Decodificar el BLOB para mostrar la imagen
    $fotoPerfil = 'data:image/jpeg;base64,' . base64_encode($profileP); // Formato para mostrar BLOB como imagen
} else {
    $fotoPerfil = "img/def.jpg"; // Ruta de la foto por defecto si el BLOB es null o vacío
}
?>
<?php
session_start();
error_reporting(0);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tienda";

// Verificar si la sesión está activa y obtener el correo del usuario actual
if (!isset($_SESSION['correoA']) || empty($_SESSION['correoA'])) {
    header("Location: ../inicio.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Auto</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contC"> 
        <div class="wrap-de-navbar" onmouseleave="plegarSalida()">
        <!-- Navbar Imagen -->
        <div class="icono">
           <a href="dashboardA.php"><img src="img/logo.png" alt="logo CABAQ" id="logoVerCarro"></a>
        </div>
        <!-- Navbar Links -->
        <div class="links-navegacion">
            <ul>
            <li class="navbar-l"><a href="crearCarro.php">Crear Carro</a></li>
                    <li class="navbar-l"><a href="editarCarro.php">Editar Carro</a></li>
                    <li class="navbar-l"><a href="dashboardA.php">Mi sitio</a></li>
                    <li><img class="fotoPerfil" id="profilePic" src="<?php echo $fotoPerfil; ?>" alt="fotodefault" onmouseenter="desplegarSalida()"></li>
                    <li id="cs" style="display:none;"><a style="cursor:pointer;" href="logout.php">Cerrar sesión</a></li>
            </ul>
        </div>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";
            $username = "root";
            $password = ""; // Cambiar si es necesario
            $dbname = "tienda";

            // Crear conexión
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Verificar conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $nombre = $_POST['nombre'];
            $marca = $_POST['marca'];
            $modelo = $_POST['modelo'];
            $precio = $_POST['precio'];
            $estado = $_POST['estado'];
            $kilometraje = $_POST['kilometraje'];
            $transmision = $_POST['transmision'];
            $tipo_auto = $_POST['type'];
            $color = $_POST['color'];
            $stock = $_POST['stock'];
            
            // Procesar la imagen
            $imagen = addslashes(file_get_contents($_FILES['imagen']['tmp_name']));

            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, estado, kilometraje, transmision, tipo_auto, color, imagen, stock)
                    VALUES ('$nombre', '$marca', '$modelo', '$precio', '$estado', '$kilometraje', '$transmision', '$tipo_auto', '$color', '$imagen', '$stock')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Registro exitoso');
                        window.location.href=''; // Recargar la misma página
                      </script>";
            } else {
                echo "<script>
                        alert('No se pudo subir el registro');
                        window.location.href=''; // Recargar la misma página
                      </script>";
            }

            $conn->close();
        }
        ?>

        <div class="formularioCC">
            <form action="" method="POST" class="formCC" enctype="multipart/form-data">
                <div id="login">
                    <div>
                        <div id="login-row">
                            <div id="login-column">
                                <div id="login-box">
                                    <br>
                                    <br>
                                    <h3 style="font-size: 30px; text-align: center;">Nuevo Carro</h3>
                                    <div>
                                        <label for="nombre" class="form-label">Nombre carro: *</label>
                                        <input type="text" id="nombre" name="nombre" placeholder="Nombre del carro" required>
                                    </div>
                                    <div>
                                        <label for="marca">Marca:</label><br>
                                        <input type="text" name="marca" id="marca" placeholder="Marca del carro" required>
                                    </div>
                                    <div>
                                        <label for="modelo">Modelo *</label>
                                        <input type="number" id="modelo" name="modelo" placeholder="Año del carro" required>
                                    </div>
                                    <div>
                                        <label for="precio">Precio:</label><br>
                                        <input type="number" name="precio" id="precio" placeholder="Precio" required>
                                    </div>
                                    <div>
                                        <label for="estado" class="form-label">Estado Sucursal: *</label>
                                        <select id="estado" name="estado" required>
                                            <option value="" disabled selected>Seleccione el estado</option>
                                            <option value="Aguascalientes">Aguascalientes</option>
                                            <option value="Baja California">Baja California</option>
                                            <option value="Baja California Sur">Baja California Sur</option>
                                            <option value="Campeche">Campeche</option>
                                            <option value="Chiapas">Chiapas</option>
                                            <option value="Chihuahua">Chihuahua</option>
                                            <option value="CDMX">Ciudad de México</option>
                                            <option value="Coahuila">Coahuila</option>
                                            <option value="Colima">Colima</option>
                                            <option value="Durango">Durango</option>
                                            <option value="Estado de México">Estado de México</option>
                                            <option value="Guanajuato">Guanajuato</option>
                                            <option value="Guerrero">Guerrero</option>
                                            <option value="Hidalgo">Hidalgo</option>
                                            <option value="Jalisco">Jalisco</option>
                                            <option value="Michoacán">Michoacán</option>
                                            <option value="Morelos">Morelos</option>
                                            <option value="Nayarit">Nayarit</option>
                                            <option value="Nuevo León">Nuevo León</option>
                                            <option value="Oaxaca">Oaxaca</option>
                                            <option value="Puebla">Puebla</option>
                                            <option value="Querétaro">Querétaro</option>
                                            <option value="Quintana Roo">Quintana Roo</option>
                                            <option value="San Luis Potosí">San Luis Potosí</option>
                                            <option value="Sinaloa">Sinaloa</option>
                                            <option value="Sonora">Sonora</option>
                                            <option value="Tabasco">Tabasco</option>
                                            <option value="Tamaulipas">Tamaulipas</option>
                                            <option value="Tlaxcala">Tlaxcala</option>
                                            <option value="Veracruz">Veracruz</option>
                                            <option value="Yucatán">Yucatán</option>
                                            <option value="Zacatecas">Zacatecas</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="kilometraje">Kilometraje: *</label>
                                        <input type="number" id="kilometraje" name="kilometraje" placeholder="Kilometraje" required>
                                    </div>
                                    <div>
                                        <label for="transmision">Transmision: *</label>
                                        <select id="transmision" name="transmision" required>
                                            <option value="" disabled selected>Seleccione la transmisión</option>
                                            <option value="automatico">Automático</option>
                                            <option value="estandar">Estándar</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="type">Tipo de Auto: *</label>
                                        <select id="type" name="type" required>
                                            <option value="" disabled selected>Seleccione el tipo de auto</option>
                                            <option value="SUV">SUV</option>
                                            <option value="Hatchback">Hatchback</option>
                                            <option value="Sedan">Sedan</option>
                                            <option value="Pick-up">Pick-up</option>
                                            <option value="Deportivo">Deportivo</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="color">Color: *</label>
                                        <select id="color" name="color" required>
                                            <option value="" disabled selected>Seleccione el color</option>
                                            <option value="Rojo">Rojo</option>
                                            <option value="Azul">Azul</option>
                                            <option value="Amarillo">Amarillo</option>
                                            <option value="Plateado">Plateado</option>
                                            <option value="Negro">Negro</option>
                                            <option value="Blanco">Blanco</option>
                                            <option value="Verde">Verde</option>
                                            <option value="Naranja">Naranja</option>
                                            <option value="Morado">Morado</option>
                                        </select>
                                    </div>
                                    <div>
                                        <label for="imagen">Imagen Icono: *</label>
                                        <input type="file" id="imagen" name="imagen" placeholder="Imagen" required>
                                    </div>
                                    <div>
                                        <label for="stock">Existencia: *</label>
                                        <select id="stock" name="stock" required>
                                            <option value="" disabled selected>Seleccione la existencia</option>
                                            <option value="1">Listo_Stock</option>
                                            <option value="2">Proximamente</option>
                                        </select>
                                    </div>
                                    <br>
                                    <div>
                                        <input type="submit" id="estexd" value="Guardar" name="registrar">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="funcionesCliente.js"></script>
</body>
</html>
