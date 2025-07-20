<div class="auth">
    <h2 class="auth__heading"><?= $titulo ?></h2>
    <p class="auth__texto">Solicitar código de Recuperación</p>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>
    <form class="formulario" method="POST">
        <div class="formulario__campo">
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Correo electronico">
        </div>

        <input type="submit" class="formulario__submit" value="Enviar">
    </form>
    
    <div class="acciones">
        <a href="/login">Volver</a>
        <a href="/login">Iniciar Sesión</a>
    </div>
</div>