    <div
        class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1>Facturas</h1>
    </div>

    <div class="acordeon accordion accordion-flush mt-3" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Cargar facturas
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body row">

                    <div class="mb-2 col-lg-6">
                        <label for="tipo_factura" class="form-label">Tipo de factura</label>
                        <div>
                            <select class="form-select" name="tipo_factura" id="tipo_factura">
                            <option selected>Seleccione tipo de factura</option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-2 col-lg-6">
                        <label for="cargar_factura" class="form-label">Cargar factura</label>
                        <input type="file" class="form-control" accept=".pdf">
                    </div>

                    <div class="mb-2 col-lg-6">
                        <label for="numero_factura" class="form-label">Número de factura</label>
                        <input type="text" class="form-control">
                    </div>

                    <div class="mb- 2 col-lg-6">
                        <label for="fecha_emision" class="form-label">Fecha de emisión</label>
                        <input type="date" class="form-control" name="fecha_emision" id="fecha_emision" aria-label="fecha_emision" aria-describedby="basic-addon6">
                    </div>

                    <div class="mb-2 col-lg-12">
                        <label for="descripcion">Descripción</label>
                        <textarea name="descripcion" id="descripcion" type="text" class="form-control" row="2"></textarea>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button class="btn btn-success">Añadir factura</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Ver lista de facturas
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Listado de facturas
                </div>
            </div>
        </div>
    </div>

