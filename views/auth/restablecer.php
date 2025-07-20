<div class="auth medium text-center">
    <h2 class="auth__heading"><?= $titulo ?></h2>
    <p class="auth__texto">Inserta tu nueva contraseña.</p>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Contraseña Nueva">
        </div>
        <input type="submit" class="formulario__submit" value="Enviar">
    </form>
</div>