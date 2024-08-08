<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/pagina_principal.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/registro_usuarios.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/listado_usuarios.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/inventario.css">
    
    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- Links de sweetalert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <!-- Datatables -->
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.2/r-3.0.2/sc-2.4.3/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.1.2/r-3.0.2/sc-2.4.3/datatables.min.js"></script>
    <!-- Icono de ventana -->
    <link rel="icon" type="image/png" href="<?php echo IP_SERVER ?>assets/imagenes/material-peligroso.png">
    <link rel="shortcut icon" href="<?php echo IP_SERVER ?>assets/imagenes/material-peligroso.png" title="CCS"
        id="CCS" type="image/x-icon" />
        
        <script>
            var IP_SERVER = '<?php echo IP_SERVER; ?>';
        </script>

</head>

<body class="d-flex">
    <button class="menu-hamburguesa btn btn-secondary" id="hamburguesa" onclick="ampliar()"><i
            class="bi bi-arrow-left-circle"></i></button>
    <div class="menu" id="menu-hamburguesa">
        <header class="menu2">
            <div class="row">
                <!-- Sidebar -->
                <nav id="sidebar" class="d-md-block sidebar">
                    <div class="perfil-img">
                        <img src="<?php echo IP_SERVER; ?>assets/imagenes/foto_usuarios/<?php echo ($this->session->datosusuario->foto_perfil) ? $this->session->datosusuario->foto_perfil : 'usuario.png'; ?>" class="img-login">
                    </div>

                    <a class="nombre-logeado d-flex align-items-center justify-content-center border-bottom">
                        <h4><?php echo $this->session->datosusuario->nombre_completo; ?></h4>
                    </a>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?php echo($inicio == 'inicio')?'active':'' ?>" aria-current="page"
                                href="<?php echo IP_SERVER ?>home/pagina_principal"><i
                                    class="bi bi-house mx-2 navicon"></i>Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo($inicio == 'registro')?'active':'' ?>" aria-current="page"
                                href="<?php echo IP_SERVER ?>home/registro_usuarios"><i
                                    class="bi bi-person-add mx-2"></i>Registro de usuarios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo($inicio == 'listado')?'active':'' ?>"
                                href="<?php echo IP_SERVER ?>home/listado_usuarios"><i
                                    class="bi bi-people mx-2"></i>Listado de usaurios</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo($inicio == 'inventario')?'active':'' ?>"
                                href="<?php echo IP_SERVER ?>home/inventario"><i
                                    class="bi bi-card-checklist mx-2"></i>Inventario</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo($inicio == 'facturas')?'active':'' ?>"
                                href="<?php echo IP_SERVER ?>home/facturas"><i
                                    class="bi bi-receipt mx-2"></i>Facturas</a>
                        </li>
                        <br>
                        <br>
                        <br>
                        <li class="nav-item border-top border-bottom">
                            <a class="nav-link" href="<?php echo IP_SERVER ?>login/salir"><i
                                    class="bi bi-box-arrow-in-left mx-2"></i>Cerrar sesión</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    </div>
    <main id="main">

    <script src="<?php echo IP_SERVER; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo IP_SERVER; ?>assets/vendor/typed.js/typed.umd.js"></script>
    <script src="<?php echo IP_SERVER ?>assets/js/main.js"></script>


    <script>
// Función para obtener el estado actual del toggle del localStorage
function obtenerEstadoToggle() {
    const estadoGuardado = localStorage.getItem('toggleState');
    // Si no hay un estado guardado, retorna false por defecto
    return estadoGuardado ? JSON.parse(estadoGuardado) : false;
}

// Función para guardar el estado del toggle en el localStorage
function guardarEstadoToggle(estado) {
    localStorage.setItem('toggleState', JSON.stringify(estado));
}

// Función para aplicar el estado del toggle a los elementos del DOM
function aplicarEstadoToggle(estado) {
    const menu = document.getElementById('menu-hamburguesa');
    const main = document.getElementById('main');
    const hamburguesa = document.getElementById('hamburguesa');
    
    if (estado) {
        menu.classList.add('ampliar');
        main.classList.add('ampliar_2');
        hamburguesa.classList.add('rotar');
    } else {
        menu.classList.remove('ampliar');
        main.classList.remove('ampliar_2');
        hamburguesa.classList.remove('rotar');
    }
}

// Función para manejar el clic en el toggle
function ampliar() {
    let toggleState = obtenerEstadoToggle(); // Obtener el estado actual del localStorage
    toggleState = !toggleState; // Invertir el estado al hacer clic

    aplicarEstadoToggle(toggleState); // Aplicar el estado actual al DOM
    guardarEstadoToggle(toggleState); // Guardar el estado actual en el localStorage
}

// Aplicar el estado guardado al cargar la página
document.addEventListener('DOMContentLoaded', () => {
    const estadoInicial = obtenerEstadoToggle();
    aplicarEstadoToggle(estadoInicial);
});

    </script>