<div
    class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1>Inventario</h1>
        <div class="d-flex justify-content-center">
            <a type="button" class="btn btn-success" href="<?php echo IP_SERVER ?>home/agregar_material"><i class="bi bi-plus-circle"></i>
                Agrear material</a>
        </div>
</div>


<div class="m-0">
    <div class="tabla">
        <table id="tabla-inventario" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nombre material</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach ($materiales as $material): ?>
                <tr>
                    <td>
                        <?php echo $material->codigo; ?>
                    </td>
                    <td>
                        <?php echo $material->nombre_material; ?>
                    </td>
                    <td>
                        <?php echo $material->cantidad; ?>
                    </td>
                    <td>
                        <?php echo $material->descripcion; ?>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">

                            <button data-id="<?php echo $material->id ?>" type="button"
                                class="boton-editar btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Editar material">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button data-id="<?php echo $material->id ?>" type="button"
                                class="boton-eliminar-material btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Eliminar material">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
</div>

<!-- modal -->

<div class="modal" id="editar_inventario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_modal_inventario">Modificar material</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="form_inventario" class="row">
                    <input type="hidden" id="id" name="id">
                    <div class="col-lg-6">
                        <label for="nombre_material" class="form-label">Nombre material</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/materiales-de-construccion.png" alt="Icono" width="18" height="18"></span>
                            <input type="text" class="form-control" name="nombre_material" id="nombre_material" aria-label="nombre_material" aria-describedby="basic-addon1" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <label for="usu_modificador" class="form-label">Usuario modificador</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon5"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/usu-creador.png" alt="Icono" width="18" height="18"></span>
                            <input type="text" class="form-control" name="usu_modificador" id="usu_modificador" aria-label="usu_modificador" aria-describedby="basic-addon5" value="<?php echo $this->session->datosusuario->usuario; ?>" readonly>
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <label for="cantidad" class="form-label">Cantidad</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon3"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/cantidad.png" alt="Icono" width="18" height="18"></span>
                            <input type="number" min="0" class="form-control" name="cantidad" id="cantidad" aria-label="cantidad" aria-describedby="basic-addon3" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label for="codigo" class="form-label">Código (Sku)</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon4"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/codigo.png" alt="Icono" width="18" height="18"></span>
                            <input type="text" class="form-control" name="codigo" id="codigo" aria-label="codigo" aria-describedby="basic-addon4" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <label for="tamano" class="form-label">Tamaño</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon7"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/tamano.png" alt="Icono" width="18" height="18"></span>
                            <input type="text" class="form-control" name="tamano" id="tamano" aria-label="tamano" aria-describedby="basic-addon7" required>
                        </div>
                    </div>

                    <div class="col-lg-6">
                    <label for="precio_unitario" class="form-label">Precio unitario</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon8"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/precio.png" alt="Icono" width="18" height="18"></span>
                            <input type="text" class="form-control" name="precio_unitario" id="precio_unitario" aria-label="precio_unitario" aria-describedby="basic-addon8" required>
                        </div>
                    </div>

                    <div class="col-lg-12">
                    <label for="descripcion" class="form-label">Descripción</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon2"><img src="<?php echo IP_SERVER; ?>assets/imagenes/img_form_inv/descripcion.png" alt="Icono" width="18" height="18"></span>
                            <textarea rows="2" type="text" class="form-control" name="descripcion" id="descripcion" aria-label="descripcion" aria-describedby="basic-addon2" required></textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button class="btn btn-success" type="submit">Guardar cambios</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

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
// Funcion del datatable
$(function() {
    $('#tabla-inventario').DataTable({
        "ordering": false,
        "language": {
            "decimal": ",",
            "thousands": ".",
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }

        }
    });
})

$(document).ready(function() {
    $(document).on('click', '.boton-editar', function() {
        let id = $(this).data('id')

        $.ajax({
            url: IP_SERVER + 'home/traer_material/' + id,
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.resp == 1) {
                    $('#editar_inventario').modal('toggle')
                    $('#id').val(data.material.id)
                    $('#nombre_material').val(data.material.nombre_material)
                    $('#descripcion').val(data.material.descripcion)
                    $('#cantidad').val(data.material.cantidad)
                    $('#codigo').val(data.material.codigo)
                    $('#tamano').val(data.material.tamano)
                    $('#precio_unitario').val(data.material.precio_unitario)
                }
            }
        })
    });

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

    $('#form_inventario').on('submit', function(ev) {
        ev.preventDefault()
        $.ajax({
            url: IP_SERVER + 'home/editar_material',
            type: 'post',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                if (data.resp == 1) {
                    Toast.fire({
                        icon: "success",
                        title: data.mensaje
                    }).then(()=>{
                        location.reload()
                    })
                }
            }
        })
    })
})
</script>

<!-- Funcion para eliminar material -->
 <script>
    const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger espacio"
    },
    buttonsStyling: false
    });

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

    $(document).ready(function() {
    $('.boton-eliminar-material').on('click', function() {
        swalWithBootstrapButtons.fire({
            title: "¿Estas seguro de eliminar este material?",
            text: "Esta accion no se puede revertir!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).data('id')
                $.post('<?php echo IP_SERVER; ?>home/eliminar_material', {
                    id: id
                }, function(data) {
                    if (data.resp = 1) {
                        Toast.fire({
                            icon: "success",
                            title: data.msg
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "Something went wrong!",
                            footer: '<a href="#">Why do I have this issue?</a>'
                        });
                    }
                })
            }
            $('.boton-eliminar-material').tooltip('hide')
        })
    });

})
 </script>

<!-- Funcion del tooltip -->
<script>
    var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>