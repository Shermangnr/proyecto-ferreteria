    <div
        class="contenido-principal d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1>Inicio</h1>
    </div>

    <section>
        <div class="mensaje-inicial" data-aos="fade-up" data-aos-delay="100">
            <h2>Hola <?php echo $this->session->datosusuario->usuario; ?> !</h2> <br><br><br>
            <p class="descripcion">Para empezar puede dar clic en
                <span class="typed"
                    data-typed-items="Registro de usuarios., Listado de usuarios., Inventario., Facturas."></span>
                <span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span>
                <span class="typed-cursor typed-cursor--blink" aria-hidden="true"></span>
            </p>
        </div>
    </section>