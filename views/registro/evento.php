<div class="evento">
    <p class="evento__hora"><?= $evento->hora->hora ?></p>
    <div class="evento__informacion">
        <h4 class="evento__nombre evento__nombre--registro"><?= $evento->nombre ?></h4>
        <div>
            <p class="evento__descripcion"><?= $evento->descripcion ?></p>
        </div>
        <div class="evento__ponente-info">
            <picture>
                <source srcset="<?= $_ENV['HOST'] ?>/img/speakers/<?= $evento->ponente->imagen ?>.webp" type="image/webp">
                <img class="evento__ponente-imagen" loading="lazy" height="200" width="200" src="<?= $_ENV['HOST'] ?>/img/speakers/<?= $evento->ponente->imagen ?>.png" alt="Imagen Ponente">
            </picture>
            <p class="evento__ponente-nombre"><?= $evento->ponente->nombre . ' ' . $evento->ponente->apellido ?></p>
        </div>
        <button class="evento__boton" type="button" data-id="<?= $evento->id ?>" <?= $evento->disponibles === '0' ? 'disabled' : '' ?>><?= $evento->disponibles === '0' ? 'Agotado' : 'Agregar / ' . $evento->disponibles . ' Disponibles' ?></button>
    </div>
</div>