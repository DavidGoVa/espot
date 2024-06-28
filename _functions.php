<?php
   
require_once ("_db.php");




if (isset($_POST['accion'])){ 
    switch ($_POST['accion']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'eliminar_registro';
            eliminar_registro();
    
            break;

            case 'acceso_user';
            acceso_user();
            break;


		}

	}

    function editar_registro() {
		$conexion=mysqli_connect("localhost","root","","tienda");
		extract($_POST);
		$consulta="UPDATE user SET nombre = '$nombre', correo = '$correo', telefono = '$telefono',
		password ='$password', rol = '$rol' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);


		header('Location: ../views/user.php');

}

function eliminar_registro() {
    $conexion=mysqli_connect("localhost","root","","tienda");
    extract($_POST);
    $id= $_POST['id'];
    $consulta= "DELETE FROM user WHERE id= $id";

    mysqli_query($conexion, $consulta);


    header('Location: ../views/user.php');

}

function acceso_user() {
    $correo=$_POST['correo'];
    $password=$_POST['password'];
    session_start();
    $_SESSION['correo']=$correo;

    $conexion=mysqli_connect("localhost","root","","tienda");
    $consulta= "SELECT * FROM user WHERE correo='$correo' AND password='$password'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);


    if($filas['correo'] == $correo){ 

        echo "<script>window.location.href='/pruebaEspot/vistasCliente/inicioCliente.php';
         </script>";        
        exit();
    }else{
        echo "<script> alert('Uusario no encontrado') </script>";
        header('Location: ../pruebaEspot/loginCliente.php');
        
        session_destroy();
        exit();
    }
    
    
    

  
}






