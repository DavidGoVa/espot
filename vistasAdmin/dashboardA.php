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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CABAQ</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="wrap-de-todo">
        <!--navbar-->
        <div class="wrap-de-navbar" onmouseleave="plegarSalida()">
            <!--navbar Imagen-->
            <div class="icono">
                <a href="dashboardA.php"><img src="img/logo.png" alt="logo CABAQ"></a>
            </div>
            <!--navbar Links-->
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
<!--carga datos de usuario -->


           <div class="contenidoDashC">
            <h3 style="text-align:center;">Datos personales</h3>
            <br>
            <br>
            <div class="datosC">
                <table class="datosCT">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Contraseña</th>
                            <th>Telefono</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                
                
                    $conexion = mysqli_connect("localhost","root","","tienda");            
                    $n = $_SESSION['correoA'];
                    $SQL = "SELECT * 
                            FROM usera
                            WHERE usera.correo = '$n'";
                    $dato = mysqli_query($conexion, $SQL);
                   
                    
                    

                    if($dato -> num_rows >0){
                      while($fila=mysqli_fetch_array($dato)){
                      
                  ?>
                  <tr>
                  <td><?php echo $fila['nombre']; ?></td>
                  <td><?php echo $fila['correo']; ?></td>
                  <td><?php echo $fila['password']; ?></td>
                  <td><?php echo $fila['telefono']; ?></td>                  
                  
</tr>


<?php
}
}else{

    ?>
    <tr class="text-center">
    <td colspan="16">No existen registros</td>
    </tr>

    
    <?php
    
}

?>
                        </tr>
                    </tbody>
                </table>
            </div>
           </div>
           <br><br>
        <!--Pie de pagina-->
        <div class="piedepagina">
            <!--Pie de pagina columna izq-->
            <div class="ppIzq">
                <h4>Contacto</h4>
                <ul>
                    <li><a href="">Manda un whatsapp</a></li>
                    <li><a href="">llama a cabaq</a></li>
                </ul>
            </div>
            <!--Pie de pagina columna medio-->
            <div class="ppMedio">
                <h4>Dudas</h4>
                <ul>
                    <li><a href="">Preguntas frecuentes</a></li>
                    <li><a href="">Metodos de pago</a></li>
                </ul>
            </div>
            <!--Pie de pagina columna dere-->
            <div class="ppDerecha">
                <h4>Siguenos</h4>
                <ul>
                    <img src="" alt="Facebook">
                    <img src="" alt="Instagram">
                </ul>
            </div>
        </div>
    </div>
    <script src="funcionesCliente.js"></script>
</body>
</html>
