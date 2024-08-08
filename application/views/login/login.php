<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar seseón</title>
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo IP_SERVER ?>assets/css/login.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link rel="icon" type="image/png" href="<?php echo IP_SERVER ?>assets/imagenes/material-peligroso.png">
    <link rel="shortcut icon" href="<?php echo IP_SERVER ?>assets/imagenes/material-peligroso.png" title="CCS"
        id="CCS" type="image/x-icon" />
</head>

<body>
    <div class="div-exterior">
        <div class="tarjeta">
            <div class="d-flex justify-content-center mb-3">
                <h3>Iniciar sesión</h3>
            </div>

            <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
            <?php endif; ?>
            <form id="form-sesion">
                <div class="mb-3">
                    <label for="nombre_usuario">Nombre usuario:</label>
                    <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" required>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <button type="submit" class="btn btn-primary">Iniciar sesión</button>
                </div>
            </form>
        </div>

    </div>
</body>

</html>
<script src="<?php echo IP_SERVER; ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>

<script>
$(function() {
    $('#form-sesion').on('submit', function(ev) {
        ev.preventDefault()
        formData = new FormData;
        usuario = $('#nombre_usuario')[0].value;
        contrasena = $('#contrasena')[0].value;

        formData.append('contrasena',contrasena)
        formData.append('nombre_usuario',usuario)

        $.ajax({
            url: "<?php echo IP_SERVER ?>login/ingresar",
            type: "post",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(data) {
                if (data['resp'] == 1) {
                    window.location.assign('<?php echo IP_SERVER; ?>home')
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: data.msg
                    });
                }
            }
        })
    })
})
</script>