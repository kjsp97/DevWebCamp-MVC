<h2 class="pagina__heading"><?= $titulo ?></h2>
<p class="pagina__descripcion">Elige hasta 5 eventos con tu entrada presencial!</p>

<div class="eventos-registro">   
    <main class="eventos-registro__listado">
        <h3 class="eventos-registro__heading--conferencias">&#60;Conferencias /></h3>
        <p class="eventos-registro__fecha">Viernes 3 de Octubre</p>

        <div class="eventos-registro__grid" data-aos="fade-right">
            <?php foreach ($eventos['conferencias_v'] as $evento) : ?>
            <?php include __DIR__ . '/evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Sabado 4 de Octubre</p>

        <div class="eventos-registro__grid" data-aos="fade-right">
            <?php foreach ($eventos['conferencias_s'] as $evento) : ?>
            <?php include __DIR__ . '/evento.php' ?>
            <?php endforeach; ?>
        </div>

        <h3 class="eventos-registro__heading--workshops">&#60;Workshops /></h3>
        <p class="eventos-registro__fecha">Viernes 3 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops" data-aos="fade-right">
            <?php foreach ($eventos['workshops_v'] as $evento) : ?>
            <?php include __DIR__ . '/evento.php' ?>
            <?php endforeach; ?>
        </div>

        <p class="eventos-registro__fecha">Sabado 4 de Octubre</p>

        <div class="eventos-registro__grid eventos--workshops" data-aos="fade-right">
            <?php foreach ($eventos['workshops_s'] as $evento) : ?>
            <?php include __DIR__ . '/evento.php' ?>
            <?php endforeach; ?>
        </div>

    </main>

    <aside class="registro">
        <h2 class="registro__heading">Registro</h2>

        <div id="registro-resumen" class="registro__resumen"></div>

        <div class="registro__regalo">
            <label for="regalo" class="registro__label">Seleciona tu Regalo</label>
            <select id="regalo" class="registro__select">
                <option value="">--Selecciona tu regalo--</option>
                <?php foreach ($regalos as $regalo) : ?>
                    <option value="<?= $regalo->id ?>"><?= $regalo->nombre ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <form id="registro" class="formulario" method="POST">
            <input class="registro__submit" type="submit" value="Enviar">
        </form>
    </aside>
</div>
    
