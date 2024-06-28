document.addEventListener("DOMContentLoaded", (event) => {
    verSeleccionado();
  cargarTodo();

  // Agregar event listener para el botón con ID Nissan
});
let ultimaAPI = "";

function desplegarSalida() {
  var linkCerrarSesion = document.getElementById("cs");
  linkCerrarSesion.style.display = "flex";
}
function plegarSalida() {
  var linkCerrarSesion = document.getElementById("cs");
  linkCerrarSesion.style.display = "none";
}

function ib() {
  let texto = document.getElementById("busqueda").value;
  let xd = verSeleccionado();
  
  fetch(`catalogoBusqueda.php?xd=${xd}` + " &busqueda=" + texto + "&otra=" + texto)

    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));

  document.getElementById("busqueda").value = "";
  ultimaAPI = "catalogoBusqueda.php";
}
function catalogoPrecio() {
  let pMin = document.getElementById("precio_minimo").value;
  let pMax = document.getElementById("precio_maximo").value;
  let xd = verSeleccionado();
  
  fetch(`catalogoPrecio.php?xd=${xd}` + " &precio_minimo=" + pMin + "&precio_maximo=" + pMax)

    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));

  ultimaAPI = "catalogoPrecio.php";
}
function catalogokilometraje() {
  let kMin = document.getElementById("kilometraje_minimo").value;
  let kMax = document.getElementById("kilometraje_maximo").value;
  let xd = verSeleccionado();
  
  fetch(`catalogoKilometraje.php?xd=${xd}` + " &kilometraje_minimo=" + kMin + "&kilometraje_maximo="+kMax)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));

  ultimaAPI = "catalogoKilometraje.php";
}

function cargarMarca(marca) {
    let xd = verSeleccionado();
  
  fetch(`catalogoMarca.php?xd=${xd}` + " &marca=" + marca)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoMarca.php";
}
function cargarTransmision(transmision) {
    let xd = verSeleccionado();
  
  fetch(`catalogoTransmision.php?xd=${xd}` + " &transmision=" + transmision)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoTransmision.php";
}
function cargarModelo(modelo) {
    let xd = verSeleccionado();
  
  fetch(`catalogoModelo.php?xd=${xd}` + " &modelo=" + modelo)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoModelo.php";
}
function cargarEstado(estado) {
    let xd = verSeleccionado();
  
  fetch(`catalogoEstado.php?xd=${xd}` + " &estado=" + estado)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoEstado.php";
}
function cargarColor(color) {
    let xd = verSeleccionado();
  
  fetch(`catalogoColor.php?xd=${xd}` + " &color=" + color)
  
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoColor.php";
}
function cargarTipo(tipo) {
    let xd = verSeleccionado();
  
  fetch(`catalogoTipo.php?xd=${xd}` + " &tipo_auto=" + tipo)
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoTipo.php";
}

function cargarProximo() {
    let xd = verSeleccionado();
    fetch(`catalogoProximos.php?xd=${xd}`)
    .then((response) => response.text())
    .then((data) => {
      let DivAutos = document.getElementById("catalogo");
      DivAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error: ", error));
  ultimaAPI = "catalogoProximo.php";
  console.log(ultimaAPI);
}

function cargarTodo() {

    let xd = verSeleccionado();
  fetch(`catalogo.php?xd=${xd}`)
    .then((response) => response.text())
    .then((data) => {
      let divAutos = document.getElementById("catalogo");
      divAutos.innerHTML = data;
    })
    .catch((error) => console.error("Error:", error));
    
}

function toggleOpciones(id) {
  const opciones = document.getElementById(id);
  if (opciones.style.display === "none") {
    opciones.style.display = "grid";
    opciones.style.gridTemplateColumns = "repeat(2,1fr)";
    opciones.style.maxWidth = "218px";
  } else {
    opciones.style.display = "none";
  }
}
let c1 = document.getElementById("masmenos");
let c2 = document.getElementById("menosmas");
let c3 = document.getElementById("newold");
let c4 = document.getElementById("oldnew");
let cb = "ORDER BY precio DESC"
function verSeleccionado() {
  if (c1.checked) {
    cb = "ORDER BY precio DESC";
    console.log(cb);
    return cb;
  } else if (c2.checked) {
    cb = "ORDER BY precio ASC";
    console.log(cb);
    return cb;
  } else if (c3.checked) {
    cb = "ORDER BY fecha DESC";
    console.log(cb);
    return cb;
  } else if (c4.checked) {
    cb = "ORDER BY fecha ASC";
    console.log(cb);
    return cb;
  } else {
    return cb;
  }
}

function esoi() {
  if (c1.checked) {
    c2.checked = false;
    c3.checked = false;
    c4.checked = false;
  }
}
function esoii() {
  if (c2.checked) {
    c1.checked = false;
    c3.checked = false;
    c4.checked = false;
  }
}
function esoiii() {
  if (c3.checked) {
    c2.checked = false;
    c1.checked = false;
    c4.checked = false;
  }
}
function esoiiii() {

  if (c4.checked) {
    c2.checked = false;
    c3.checked = false;
    c1.checked = false;
  }
}

function toggleFiltros() {
  const filtros = document.getElementById("f");
  const contenedorAutos = document.getElementById("contenedorAutos");
  const sign = document.getElementById("btnF");
  const d = document.getElementById("botones");

  if (filtros.style.display === "none") {
    sign.textContent = "Ocultar Filtros";
    filtros.style.display = "block";
    contenedorAutos.classList.remove("expand");
  } else {
    sign.textContent = "Mostrar Filtros";
    filtros.style.display = "none";
    contenedorAutos.classList.add("expand");
  }
}
