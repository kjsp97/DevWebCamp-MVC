<h2 class="dashboard--heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
<form method="POST" class="formulario">
        <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
        <?php include_once __DIR__ . '/formulario.php' ?>
        <input type="submit" class="formulario__submit formulario__submit--registro" value="Registrar Evento">
    </form>
</div>