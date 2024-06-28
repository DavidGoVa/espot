<?php
$conexion = mysqli_connect("localhost", "root", "", "tienda");

function esCorreoValido($email)
{
    if (is_bool(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        return false;
    } else {
        return true;
    }
}

if (isset($_POST['registrar'])) {
    if (esCorreoValido($_POST['correo'])) {
        if (
            strlen($_POST['nombre']) >= 1 && strlen($_POST['correo']) >= 1 && strlen($_POST['telefono']) >= 1
            && strlen($_POST['password']) >= 1
        ) {
            $nombre = trim($_POST['nombre']);
            $correo = trim($_POST['correo']);
            $telefono = trim($_POST['telefono']);
            $password = trim($_POST['password']);
            $pp = NULL;

            // Comprueba si se ha subido una imagen
            if (isset($_FILES['pp']) && $_FILES['pp']['error'] === UPLOAD_ERR_OK) {
                $pp = file_get_contents($_FILES['pp']['tmp_name']);
            }

            // Escapa las variables para prevenir inyecciones SQL
            $nombre = mysqli_real_escape_string($conexion, $nombre);
            $correo = mysqli_real_escape_string($conexion, $correo);
            $telefono = mysqli_real_escape_string($conexion, $telefono);
            $password = mysqli_real_escape_string($conexion, $password);
            $pp = $pp ? mysqli_real_escape_string($conexion, $pp) : NULL;

            // Prepara la consulta SQL
            $consulta = "INSERT INTO user (nombre, correo, telefono, password, pp)
                VALUES ('$nombre', '$correo', '$telefono', '$password', " . ($pp ? "'$pp'" : "NULL") . ")";

            // Ejecuta la consulta y maneja los errores
            try {
                if ($conexion->query($consulta) === TRUE) {
                    echo "<script> 
                    alert('Registro completado');
                    window.location.href='/pruebaEspot/loginCliente.php';
                    </script>";
                } else {
                    throw new Exception($conexion->error);
                }
            } catch (Exception $e) {
                if (strpos($e->getMessage(), 'Duplicate entry') !== false && strpos($e->getMessage(), 'for key \'unique_correo\'') !== false) {
                    echo "<script> 
                    alert('Registro no exitoso: El correo ya está registrado.');
                    window.location.href='volver.php';
                    </script>";
                } else {
                    echo "<script> 
                    alert('Registro no exitoso: " . $e->getMessage() . "');
                    window.location.href='';
                    </script>";
                }
            }
        } else {
            echo "<script>
            alert('Por favor, complete todos los campos.');
            window.location.href='';
            </script>";
        }
    } else {
        echo "<script>
        alert('Correo no válido.');
        window.location.href='';
        </script>";
    }
} 
?>
