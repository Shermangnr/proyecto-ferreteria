    <div
        class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1>Registrar usuarios</h1>
    </div>
    <div class="m-0">
        <form action="<?php echo IP_SERVER; ?>home/guardar_usuario" method="post" class="formulario" enctype="multipart/form-data">
            <div class="tarjeta row">

                <div class="mb-2 col-lg-6">
                    <label for="nombre" class="form-label">Nombre</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/form-nombre.png" alt="Icono" width="18" height="18"></span>
                        <input type="text" class="form-control" name="nombre_empleado" id="nombre" placeholder="Nombre completo" aria-label="Nombre"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="apellido" class="form-label">Apellido</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/form-nombre.png" alt="Icono" width="18" height="18"></span>
                        <input type="text" class="form-control" name="apellido_empleado" id="apellido" placeholder="Apellidos" aria-label="Apellido"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="tipo_identificacion" class="form-label">Tipo identificiación</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/tipo_id.png" alt="Icono" width="18" height="18"></span>
                        <select class="form-select" name="tipo_identificacion" id="tipo_identificacion">
                        <option selected>Seleccione tipo de identificiación</option>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?php echo $tipo->id ?>"><?php echo $tipo->nombre ?></option>
                            <?php endforeach; ?>
                        </select>                        
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="numero_identificacion" class="form-label">Número de identificación</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/identificacion.png" alt="Icono" width="18" height="18"></span>
                        <input type="text" class="form-control" name="numero_identificacion" id="numero_identificacion" aria-label="numero_identificacion"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="correo" class="form-label">Correo</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/correo.png" alt="Icono" width="18" height="18"></span>
                        <input type="email" class="form-control" name="correo" id="correo" placeholder="nombre@ejemplo.com" aria-label="Correo"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="cargo" class="form-label">Cargo</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/cargo.png" alt="Icono" width="18" height="18"></span>
                        <select class="form-select" name="cargo" id="cargo">
                        <option selected>Seleccione el cargo</option>
                            <?php foreach ($cargos as $cargo): ?>
                                <option value="<?php echo $cargo->id ?>"><?php echo $cargo->nombre ?></option>
                                <?php endforeach; ?>                             
                        </select>                        
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="nombre_usuario" class="form-label">Nombre usuario</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/username.png" alt="Icono" width="18" height="18"></span>
                        <input type="text" class="form-control" name="nombre_usuario" id="nombre_usuario" aria-label="nombre_usuario"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>

                <div class="mb-2 col-lg-6">
                    <label for="contrasena" class="form-label">Contraseña</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/password.png" alt="Icono" width="18" height="18"></span>
                        <input type="password" class="form-control" name="contrasena" id="contrasena" aria-label="contrasena"
                            aria-describedby="basic-addon1" required>
                    </div>
                </div>                

                <div class="mt-3 d-flex justify-content-center">
                    <button type="submit" class="boton-enviar btn btn-primary">Registrar</button>
                </div>

            </div>
        </form>
    </div>
    </div>

    <script>
        <?php if ($this->session->flashdata('registro_exito')): ?>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });

            Toast.fire({
                icon: "success",
                title: "<?php echo $this->session->flashdata('registro_exito'); ?>"
            });
        <?php endif; ?>
    </script>