<div class="evento swiper-slide">
    <p class="evento__hora"><?= $evento->hora->hora ?></p>
    <div class="evento__informacion">
        <h4 class="evento__nombre"><?= $evento->nombre ?></h4>
        <div>
            <p class="evento__descripcion"><?= $evento->descripcion ?></p>
        </div>
        <div class="evento__ponente-info">
            <picture>
                <source srcset="img/speakers/<?= $evento->ponente->imagen ?>.webp" type="image/webp">
                <img class="evento__ponente-imagen" loading="lazy" height="200" width="200" src="img/speakers/<?= $evento->ponente->imagen ?>.png" alt="Imagen Ponente">
            </picture>
            <p class="evento__ponente-nombre"><?= $evento->ponente->nombre . ' ' . $evento->ponente->apellido ?></p>
        </div>
    </div>
</div>