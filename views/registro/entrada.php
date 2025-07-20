<main class="pagina">
    <h2 class="pagina__heading"><?= $titulo ?></h2>
    <p class="pagina__descripcion">Tu Entrada - Se recomienda guardarlo y también puedes compartirlo en redes sociales!</p>

    <section class="boleto-virtual">

        <div class="boleto boleto--<?= strtolower($registro->paquete->nombre) ?>  boleto--acceso" data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <div class="boleto__contenido">
                <h3 class="boleto__logo  ">&#60;DevWebCamp /></h3>
                <p class="boleto__plan"><?= $registro->paquete->nombre ?></p>
                <p class="boleto__nombre"><?= $registro->usuario->nombre . ' ' . $registro->usuario->apellido ?></p>
                <p class="boleto__codigo"><?= '#' . $registro->token ?></p>
            </div>
        </div>

    </section>
</main>