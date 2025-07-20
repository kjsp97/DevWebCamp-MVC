<h2 class="dashboard--heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes">
        <i class="fa-solid fa-arrow-left"></i>
        Volver
    </a>
</div>

<div class="dashboard__formulario">
<form method="POST" class="formulario" enctype="multipart/form-data">
        <?php include_once __DIR__ . '/../../templates/alertas.php' ?>
        <?php include_once __DIR__ . '/formulario.php' ?>
        <input type="submit" class="formulario__submit formulario__submit--registro" value="Registrar Ponente">
    </form>
</div>