<?php
   
require_once ("_dbA.php");




if (isset($_POST['accionA'])){ 
    switch ($_POST['accionA']){
        //casos de registros
        case 'editar_registro':
            editar_registro();
            break; 

            case 'eliminar_registro';
            eliminar_registro();
    
            break;

            case 'acceso_userA';
            acceso_userA();
            break;


		}

	}

    function editar_registro() {
		$conexion=mysqli_connect("localhost","root","","tienda");
		extract($_POST);
		$consulta="UPDATE a SET nombre = '$nombre', correo = '$correo', telefono = '$telefono',
		password ='$password', rol = '$rol' WHERE id = '$id' ";

		mysqli_query($conexion, $consulta);


		header('Location: ../views/user.php');

}

function eliminar_registro() {
    $conexion=mysqli_connect("localhost","root","","tienda");
    extract($_POST);
    $id= $_POST['id'];
    $consulta= "DELETE FROM usera WHERE id= $id";

    mysqli_query($conexion, $consulta);


    header('Location: ../views/user.php');

}

function acceso_userA() {
    $correo=$_POST['correoA'];
    $password=$_POST['passwordA'];
    session_start();
    $_SESSION['correoA']=$correo;

    $conexion=mysqli_connect("localhost","root","","tienda");
    $consulta= "SELECT * FROM usera WHERE correo='$correo' AND password='$password'";
    $resultado=mysqli_query($conexion, $consulta);
    $filas=mysqli_fetch_array($resultado);


    if($filas['correo'] == $correo){ 

        echo "<script>window.location.href='/pruebaEspot/vistasAdmin/dashboardA.php';
         alert('Bienvenido Admin'); </script>";        
        exit();
    }else{
        echo "<script> alert('Admin no encontrado') </script>";
        header('Location: ../pruebaEspot/loginAdmin.php');
        
        session_destroy();
        exit();
    }
    
    
    

  
}






