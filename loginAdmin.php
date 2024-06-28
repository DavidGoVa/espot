<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión Admin CABAQ</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="form-container">
        

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login Admin</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<form  action="_functionsA.php" method="POST">
<div id="login" >
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
                        <br>
           
                   <br>
                                    <h3 class="text-center">Iniciar Sesión Administrador</h3>
                       <br>
                            <div class="form-group">
                                <label for="correoA">Correo:</label><br>
                                <input type="email" name="correoA" id="correoA" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="passwordA">Contraseña:</label><br>
                                <input type="password" name="passwordA" id="passwordA" class="form-control" required>
                                <input type="hidden" name="accionA" value="acceso_userA">
                            </div>
                            <div class="form-group">
                             <br>
                    <center>
                                <input type="submit"class="btn btn-success" value="Ingresar">   
                                </center>
                                
                        </form>
                        <br>
                        <br>
                        <p>Si eres cliente, inicia sesión <a href="loginCliente.php">aqui</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

    </div>
</body>
</html>