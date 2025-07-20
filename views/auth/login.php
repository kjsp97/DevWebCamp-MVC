<div class="auth">
    <h2 class="auth__heading"><?= $titulo ?></h2>
    <p class="auth__texto">Inicia sesión en DevWebCamp</p>
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    
    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Correo electronico">
        </div>
        <div class="formulario__campo">
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Contraseña">
        </div>
        <input type="submit" class="formulario__submit" value="Iniciar Sesión">
    </form>
    
    <div class="acciones">
        <a href="/registro">¿Nuevo usuario? Registrarse</a>
        <a href="/olvide">Olvide mi contraseña</a>
    </div>
</div>