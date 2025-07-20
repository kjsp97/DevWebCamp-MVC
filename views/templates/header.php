<header class="header">
    <div class="header__barra">
        <a href="/">
            <h2 class="logo">&#60DevWebCamp /></h2>
        </a>
        <nav class="header__navegacion">
            <a href="/devwebcamp" class="header__enlace <?= currentPath('devwebcamp') ? 'header__enlace--activo' : '' ?>">DWC</a>
            <a href="/paquetes" class="header__enlace <?= currentPath('paquetes') ? 'header__enlace--activo' : '' ?>">Planes</a>
            <a href="/conferencias" class="header__enlace <?= currentPath('conferencia') ? 'header__enlace--activo' : '' ?>">Conferencias</a>
            <?php if (isset($_SESSION['nombre'])) : ?>
                <a href="<?= $_SESSION['admin'] === '1' ? '/admin/dashboard' : '/finalizar-registro' ?>" class="header__enlace <?= currentPath('entrada')  ? 'header__enlace--activo' : '' ?>"><?= $_SESSION['admin'] === '1' ? 'Administrar' : 'Entrada' ?></a>
                <form class="header__form" action="/logout" method="POST"><input class="header__submit" type="submit" value="Cerrar Sesión"></form>
            <?php else : ?>
                <a href="/registro" class="header__enlace <?= currentPath('registro') ? 'header__enlace--activo' : '' ?>">Registro</a>
                <a href="/login" class="header__enlace <?= currentPath('login') ? 'header__enlace--activo' : '' ?>">Iniciar Sesión</a>
            <?php endif ?>
        </nav>
    </div>
    <div class="header__contenedor">
        <div class="header__contenido">
            <a href="/">
                <h1 class="header__logo">&#60DevWebCamp /></h1>
            </a>
            <p class="header__texto">3 y 4 de Octubre de 2025</p>
            <p class="header__texto header__texto--modalidad">En Línea - Presencial</p>
            <a href="/registro" class="header__boton">Comprar Entrada</a>
        </div>
    </div>
</header>