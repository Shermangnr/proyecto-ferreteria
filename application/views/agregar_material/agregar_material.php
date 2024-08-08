<div class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1>Agregar material</h1>
</div>

<div class="m-0">
    <form action="<?php echo IP_SERVER; ?>home/guardar_material" method="post" class="formulario">
        <div class="tarjeta row">

            <div class="mb-2 col-lg-6">
                <label for="nombre_material" class="form-label">Nombre material</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/materiales-de-construccion.png" alt="Icono" width="18" height="18"></span>
                    <input type="text" class="form-control" name="nombre_material" id="nombre_material" aria-label="nombre_material" aria-describedby="basic-addon1" required>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="descripcion" class="form-label">Descripción</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon2"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/descripcion.png" alt="Icono" width="18" height="18"></span>
                    <textarea rows="1" type="text" class="form-control" name="descripcion" id="descripcion" aria-label="descripcion" aria-describedby="basic-addon2" required></textarea>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="cantidad" class="form-label">Cantidad</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/cantidad.png" alt="Icono" width="18" height="18"></span>
                    <input type="number" min="0" class="form-control" name="cantidad" id="cantidad" aria-label="cantidad" aria-describedby="basic-addon3" required>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="codigo" class="form-label">Código (Sku)</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon4"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/codigo.png" alt="Icono" width="18" height="18"></span>
                    <input type="text" class="form-control" name="codigo" id="codigo" aria-label="codigo" aria-describedby="basic-addon4" required>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="usu_creador" class="form-label">Usuario creador</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon5"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/usu-creador.png" alt="Icono" width="18" height="18"></span>
                    <input type="text" class="form-control" name="usu_creador" id="usu_creador" aria-label="usu_creador" aria-describedby="basic-addon5" value="<?php echo $this->session->datosusuario->usuario; ?>" readonly>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="fecha_creacion" class="form-label">Fecha creación</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon6"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/calendario.png" alt="Icono" width="18" height="18"></span>
                    <input type="date" class="form-control" name="fecha_creacion" id="fecha_creacion" aria-label="fecha_creacion" aria-describedby="basic-addon6" required>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="tamano" class="form-label">Tamaño</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon7"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/tamano.png" alt="Icono" width="18" height="18"></span>
                    <input type="text" class="form-control" name="tamano" id="tamano" aria-label="tamano" aria-describedby="basic-addon7" required>
                </div>
            </div>

            <div class="mb-2 col-lg-6">
                <label for="precio_unitario" class="form-label">Precio unitario</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon8"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/precio.png" alt="Icono" width="18" height="18"></span>
                    <input type="text" class="form-control" name="precio_unitario" id="precio_unitario" aria-label="precio_unitario" aria-describedby="basic-addon8" required>
                </div>
            </div>

            <div class="mt-3 d-flex justify-content-center">
                <button type="submit" class="boton-enviar btn btn-primary">Guardar</button>
            </div>

        </div>
    </form>
</div>

<!-- calendario -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var fechaInput = document.getElementById("fecha_creacion");
        var today = new Date().toISOString().split('T')[0];
        fechaInput.value = today;
        fechaInput.min = today;
        fechaInput.max = today;
    });
</script>

<!-- Valores de precio -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var precioInput = document.getElementById("precio_unitario");

        precioInput.addEventListener("focus", function() {
            // Eliminar el símbolo de $ y los separadores de miles al enfocar
            this.value = this.value.replace(/[^0-9.]/g, '');
        });

        precioInput.addEventListener("blur", function() {
            var value = parseFloat(this.value.replace(/,/g, ''));
            if (!isNaN(value)) {
                this.value = formatCurrency(value);
            } else {
                this.value = '';  // Clear invalid value
            }
        });

        precioInput.addEventListener("input", function() {
            // Limitar la entrada a números y un solo punto decimal
            this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
        });

        function formatCurrency(value) {
            return '$' + value.toLocaleString('de-DE', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }
    });
</script>

<script>
    <?php if ($this->session->flashdata('agregar_exito')): ?>
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
            title: "<?php echo $this->session->flashdata('agregar_exito'); ?>"
        });
    <?php endif; ?>
</script>
