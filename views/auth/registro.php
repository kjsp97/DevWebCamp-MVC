<div class="auth">
    <h2 class="auth__heading"><?= $titulo ?></h2>
    <p class="auth__texto">Completar los siguientes campos</p>
    
    <?php include_once __DIR__ . '/../templates/alertas.php' ?>

    <form method="POST" class="formulario">
        <div class="formulario__campo">
            <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre" value="<?= $usuario->nombre ?>">
        </div>
        <div class="formulario__campo">
            <input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Apellidos" value="<?= $usuario->apellido ?>">
        </div>
        <div class="formulario__campo">
            <input type="email" class="formulario__input" name="email" id="email" placeholder="Correo electronico" value="<?= $usuario->email ?>">
        </div>
        <div class="formulario__campo">
            <input type="password" class="formulario__input" name="password" id="password" placeholder="Contraseña">
        </div>
        <div class="formulario__campo">
            <input type="password" class="formulario__input" name="password2" id="password2" placeholder="Repetir contraseña">
        </div>
        <input type="submit" class="formulario__submit" value="Crear Cuenta">
    </form>
</div>