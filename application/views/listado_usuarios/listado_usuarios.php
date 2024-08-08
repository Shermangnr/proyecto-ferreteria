    <div
        class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1>Listado de usuarios</h1>
    </div>

    <div class="tabla">
        <table id="tabla" class="table table-hover table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre empleado</th>
                    <th scope="col">Apellido empleado</th>
                    <!-- <th scope="col">Tipo identificación</th> -->
                    <!-- <th scope="col">Número identificación</th> -->
                    <!-- <th scope="col">Correo</th> -->
                    <th scope="col">Cargo</th>
                    <!-- <th scope="col">Nombre usuario</th> -->
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php $contador = 1; ?>
                <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td>
                        <?php echo $contador++; ?>
                    </td>
                    <td>
                        <?php echo $usuario->nombre_empleado; ?>
                    </td>
                    <td>
                        <?php echo $usuario->apellido_empleado; ?>
                    </td>
                    <!-- <td>
                        <?php echo $usuario->nombre_tipo_identificacion; ?>
                    </td>
                    <td>
                        <?php echo $usuario->numero_identificacion; ?>
                    </td>
                    <td>
                        <?php echo $usuario->correo; ?>
                    </td> -->
                    <td>
                        <?php echo $usuario->nombre_cargo; ?>
                    </td>
                    <!-- <td>
                        <?php echo $usuario->nombre_usuario; ?>
                    </td> -->
                    <td class="text-center">
                        <div class="btn-group" role="group" aria-label="Basic outlined example">

                            <a href="<?php echo IP_SERVER ?>home/editar_usuarios/<?php echo $usuario->id ?>"
                                type="button" class="boton-editar btn btn-primary" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Editar usuario">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <button data-id="<?php echo $usuario->id ?>" type="button"
                                class="boton-eliminar btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Eliminar usuario">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script>
// Funcion del datatable
$(function() {
    $('#tabla').DataTable({
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

const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger espacio"
    },
    buttonsStyling: false
});

// Funcion para eliminar usuario
$(document).ready(function() {
    $('.boton-eliminar').on('click', function() {
        swalWithBootstrapButtons.fire({
            title: "¿Estas seguro de eliminar este usuario?",
            text: "Esta accion no se puede revertir!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                let id = $(this).data('id')
                $.post('<?php echo IP_SERVER; ?>home/eliminar_usuario', {
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
            $('.boton-eliminar').tooltip('hide')
        })
    });

})



var tooltipTriggerList = Array.prototype.slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
})



<?php if ($this->session->flashdata('actualizacion_exito')): ?>
Toast.fire({
    icon: "success",
    title: "<?php echo $this->session->flashdata('actualizacion_exito'); ?>"
});
<?php endif; ?>
</script>