<h1><?= $titulo ?></h1>

<main class="bloques">
    <div class="bloque">
        <h3 class="bloque__titulo">Ultimos registros</h3>
        <?php foreach ($registros as $registro) : ?>
            <p class="bloque__texto"><?= $registro->usuario->nombre . ' ' . $registro->usuario->apellido ?></p>
        <?php endforeach ?>
    </div>
    <div class="bloque">
        <h3 class="bloque__titulo">Ingresos neto</h3>
        <p class="bloque__texto--ingresos"><?= $ingresos ?> €</p>
    </div>
    <div class="bloque">
        <h3 class="bloque__titulo">Mayor nº plazas disponibles</h3>
        <?php foreach ($mas_disponibles as $plaza) : ?>
            <p class="bloque__texto"><?= $plaza->nombre . ' - ' . $plaza->disponibles . ' disponibles' ?></p>
        <?php endforeach ?>
    </div>
    <div class="bloque">
        <h3 class="bloque__titulo">Menor nº plazas disponibles</h3>
        <?php foreach ($menos_disponibles as $plaza) : ?>
            <p class="bloque__texto"><?= $plaza->nombre . ' - ' . $plaza->disponibles . ' disponibles' ?></p>
        <?php endforeach ?>
    </div>
</main>