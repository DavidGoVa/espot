<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autos de CABAQ</title>
    <link rel="stylesheet" href="estilo.css">

</head>

<body>
    <div class="wrap-de-navbar">
        <!-- Navbar Imagen -->
        <div class="icono">
            <a href="inicio.html"><img src="img/logo.png" alt="logo CABAQ" id="logoVerCarro"></a>
        </div>
        <!-- Navbar Links -->
        <div class="links-navegacion">
            <ul>
                <li class="navbar-l"><a href="">Ver Autos</a></li>
                <li class="navbar-l"><a href="loginCliente.php">Iniciar Sesion</a></li>
                <li class="navbar-l"><a href="register.html">Registrarte</a></li>
            </ul>
        </div>
    </div>
    <!-- Interfaz donde se veran los carros y los filtros -->
    <div class="displayCarros">
        <!-- Busqueda directa por texto -->
        <div class="wrapbusqueda">
            <div class="busquedaDirecta" id="contenedor-busqueda">
                <input id="busqueda" class="inputBusquedaAuto" type="search" placeholder="Busca un auto o marca en especifico">
            </div>
            <button id="buscaBoton" onclick="ib()">Buscar</button>
        </div>
        <div style="display: flex;">
            <img src="img/filter.png" style="position:absolute; margin-left:95px;width:20px; height: fit-content;">
            <button id="btnF" style="background-color: transparent; cursor:pointer; border: none; display:flex; align-items:center;" onclick="toggleFiltros()">Ocultar filtros</button>
            <div style="width: 100%;display: flex; justify-content: end;"><button style="background-color: transparent; cursor:pointer; border: none; display:flex; align-items:center;" onclick="cargarTodo()">Borrar Filtros</button>
            </div>
        
    </div>
        </div>
        <br>
        <div class="areaCarrosF">
            <!-- Filtros por boton -->
            <div id="botones" class="filtros">
                <div id="f" style="display: block;">
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('relevancia')">Relevancia<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="relevancia" class="opciones">
                            <label for="masmenos">$$$-$</label>
                            <input type="checkbox" id="masmenos" checked onclick="esoi()" onchange="verSeleccionado()">
                            <label for="menosmas" >$-$$$</label>
                            <input type="checkbox" id="menosmas" onclick="esoii()" onchange="verSeleccionado()">
                            <label for="newold">Reciente-Viejo</label>
                            <input type="checkbox" id="newold" onclick="esoiii()" onchange="verSeleccionado()">
                            <label for="oldnew">Viejo-Reciente</label>
                            <input type="checkbox" id="oldnew" onclick="esoiiii()" onchange="verSeleccionado()">
                        </div>
                    </div>
                    
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="cargarProximo()">Proximamente</button>
                        <div style="display:none;" id="proximamente" class="opciones">
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('marca')">Marca<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="marca" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT marca FROM productos";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["marca"] . '" onclick="cargarMarca(\'' . $row["marca"] . '\')">' . $row["marca"] . '</button>';
                                }
                            } else {
                                echo "No hay marcas disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('precio')">Precio<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;max-width:218px;" id="precio" class="opciones">
                            <!-- Inputs de precio mínimo y máximo -->
                            <?php
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener el precio mínimo y máximo
                            $sql = "SELECT 
            MIN(precio) AS precio_minimo,
            MAX(precio) AS precio_maximo
        FROM productos;";
                            $result = $conn->query($sql);

                            // Obtener los valores de precio mínimo y máximo
                            $precio_minimo = 0; // Valor predeterminado si no se encuentra ningún resultado
                            $precio_maximo = 100000; // Valor predeterminado si no se encuentra ningún resultado

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $precio_minimo = $row["precio_minimo"];
                                $precio_maximo = $row["precio_maximo"];
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                            <p>min:</p>
                            <p>max:</p> 
                            <input style="max-width:100px;" type="number" id="precio_minimo" name="precio_minimo" min="<?php echo isset($precio_minimo) ? $precio_minimo : '0'; ?>" value="<?php echo isset($precio_minimo) ? $precio_minimo : '0'; ?>" max="<?php echo isset($precio_maximo) ? ($precio_maximo - 1) : '149999';?>" required>

                          
                            <input style="max-width:100px;" type="number" id="precio_maximo" name="precio_maximo" min="<?php echo isset($precio_minimo) ? ($precio_minimo + 1) : '1'; ?>" value="<?php echo isset($precio_maximo) ? $precio_maximo : '100000'; ?>"  max="<?php echo isset($precio_maximo) ? $precio_maximo : '1500000';?>" required>
                            <button id="botonPrecio" onclick="catalogoPrecio()">Aplicar</button>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('modelo')">Modelo<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="modelo" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT modelo FROM productos ORDER BY modelo DESC";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["modelo"] . '" onclick="cargarModelo(\'' . $row["modelo"] . '\')">' . $row["modelo"] . '</button>';
                                }
                            } else {
                                echo "No hay modelos disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('ubicacion')">Ubicacion Sucursal<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="ubicacion" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT estado FROM productos";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["estado"] . '" onclick="cargarEstado(\'' . $row["estado"] . '\')">' . $row["estado"] . '</button>';
                                }
                            } else {
                                echo "No hay estados disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('color')">Color<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="color" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }


                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT color FROM productos";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["color"] . '" onclick="cargarColor(\'' . $row["color"] . '\')">' . $row["color"] . '</button>';
                                }
                            } else {
                                echo "No hay colores disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('kilometraje')">Kilometraje<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="kilometraje" class="opciones">
                        <?php
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener el precio mínimo y máximo
                            $sql = "SELECT 
            MIN(kilometraje) AS kilometraje_minimo,
            MAX(kilometraje) AS kilometraje_maximo
        FROM productos;";
                            $result = $conn->query($sql);

                            // Obtener los valores de precio mínimo y máximo
                            $kilometraje_minimo = 0; // Valor predeterminado si no se encuentra ningún resultado
                            $kilometraje_maximo = 100000; // Valor predeterminado si no se encuentra ningún resultado

                            if ($result->num_rows > 0) {
                                $row = $result->fetch_assoc();
                                $kilometraje_minimo = $row["kilometraje_minimo"];
                                $kilometraje_maximo = $row["kilometraje_maximo"];
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                            <p>min:</p>
                            <p>max:</p> 
                            <input style="max-width:100px;" type="number" id="kilometraje_minimo" name="kilometraje_minimo" min="<?php echo isset($kilometraje_minimo) ? $kilometraje_minimo : '0'; ?>" value="<?php echo isset($kilometraje_minimo) ? $kilometraje_minimo : '0'; ?>" max="<?php echo isset($kilometraje_maximo) ? ($kilometraje_maximo - 1) : '999999';?>" required>

                          
                            <input style="max-width:100px;" type="number" id="kilometraje_maximo" name="kilometraje_maximo" min="<?php echo isset($kilometraje_minimo) ? ($kilometraje_minimo + 1) : '1'; ?>" value="<?php echo isset($kilometraje_maximo) ? $kilometraje_maximo : '100000'; ?>"  max="<?php echo isset($kilometraje_maximo) ? $kilometraje_maximo : '1000000';?>" required>
                            <button id="botonkilometraje" onclick="catalogokilometraje()">Aplicar</button>
                        </div>
                    </div>
                        
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('tipo')">Tipo<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="tipo" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT tipo_auto FROM productos";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["tipo_auto"] . '" onclick="cargarTipo(\'' . $row["tipo_auto"] . '\')">' . $row["tipo_auto"] . '</button>';
                                }
                            } else {
                                echo "No hay tipos disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                    <div style="flex-direction:column;" class="divBotonXd">
                        <button class="botonXd" onclick="toggleOpciones('transmision')">Transmision<img src="img/flechadrop.png" style="width:20px; height:fit-content;"></button>
                        <div style="display:none;" id="transmision" class="opciones">
                            <?php
                            // Conectar a la base de datos
                            $conn = new mysqli("localhost", "root", "", "tienda");

                            // Verificar la conexión
                            if ($conn->connect_error) {
                                die("Conexión fallida: " . $conn->connect_error);
                            }

                            // Consulta para obtener todas las marcas únicas
                            $sql = "SELECT DISTINCT transmision FROM productos";
                            $result = $conn->query($sql);

                            // Generar los botones para cada marca
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo '<button id="' . $row["transmision"] . '" onclick="cargarTransmision(\'' . $row["transmision"] . '\')">' . $row["transmision"] . '</button>';
                                }
                            } else {
                                echo "No hay transmisiones disponibles.";
                            }

                            // Cerrar la conexión
                            $conn->close();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Area donde los carros cargaran -->
            <div class="contenedorAutos" id="contenedorAutos">
                <div id="catalogo" class="autos">
                    <!-- Aqui se cargaran los autos -->
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <!-- Pie de pagina -->
    <div class="piedepagina">
        <!-- Pie de pagina columna izquierda -->
        <div class="ppIzq">
            <h4>Contacto</h4>
            <ul>
                <li><a href="">Manda un whatsapp</a></li>
                <li><a href="">llama a cabaq</a></li>
            </ul>
        </div>
        <!-- Pie de pagina columna medio -->
        <div class="ppMedio">
            <h4>Dudas</h4>
            <ul>
                <li><a href="">Preguntas frecuentes</a></li>
                <li><a href="">Metodos de pago</a></li>
            </ul>
        </div>
        <!-- Pie de pagina columna derecha -->
        <div class="ppDerecha">
            <h4>Siguenos</h4>
            <ul>
                <img src="" alt="Facebook">
                <img src="" alt="Instagram">
            </ul>
        </div>
    </div>

    <script src="funcionesCliente.js"></script>
</body>

</html>