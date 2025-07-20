<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información Personal</legend>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre" value="<?= $ponente->nombre?? '' ?>">
    </div>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Apellidos" value="<?= $ponente->apellido?? '' ?>">
    </div>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="ciudad" id="ciudad" placeholder="Ciudad" value="<?= $ponente->ciudad?? '' ?>">
    </div>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="pais" id="pais" placeholder="País" value="<?= $ponente->pais?? '' ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Imagen del poniente</label>
        <input type="file" class="formulario__input--file" name="imagen" id="imagen" accept="image/png, image/jpeg">
    </div>

    <?php if (isset($ponente->imagen_actual)) : ?>
        <p class="formulario__texto">Imagen Actual: </p>
        <div class="formulario__imagen">
            <picture>
                <source srcset="<?= $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen ?>.webp" type="image/webp">
                <source srcset="<?= $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen ?>.png" type="image/png">
                <img src="<?= $_ENV['HOST'] . '/img/speakers/' . $ponente->imagen ?>.png" alt="imagen ponente">
            </picture>
        </div>
    <?php endif ?>
</fieldset>

<fieldset class="formulario__fieldset">
<legend class="formulario__legend">Información Extra</legend>
    <div class="formulario__campo">
        <label class="formulario__label">Areas de Experiencia<span> / Añadir con coma " , " y eliminar dando "click"</span></label>
        <input type="text" class="formulario__input" id="tags_input" placeholder="Ej. Node.js, Java, Python, UX/UI ...">
        <ul id="tags" class="formulario__listado"></ul>
        <input type="hidden" name="tags" value="<?= $ponente->tags?? '' ?>">
    </div>
</fieldset>

<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Enlaces a Redes Sociales</legend>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[facebook]" placeholder="Facebook" value="<?= $redes->facebook?? '' ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-x-twitter"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[x]" placeholder="X" value="<?= $redes->x?? '' ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[youtube]" placeholder="Youtube" value="<?= $redes->youtube?? '' ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[instagram]" placeholder="Instagram" value="<?= $redes->instagram?? '' ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[tiktok]" placeholder="TikTok" value="<?= $redes->tiktok?? '' ?>">
        </div>
    </div>
    <div class="formulario__campo">
        <div class="formulario__contenedor-icono">
            <div class="formulario__icono">
                <i class="fa-brands fa-github"></i>
            </div>
            <input type="text" class="formulario__input formulario__input--icono" name="redes[github]" placeholder="GitHub" value="<?= $redes->github?? '' ?>">
        </div>
    </div>

</fieldset>