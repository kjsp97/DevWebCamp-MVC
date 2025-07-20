<aside class="dashboard__sidebar">
    <nav class="dashboard__menu">
        <a href="/admin/dashboard" class="dashboard__enlace <?= currentPath('/dashboard')? 'dashboard__enlace--actual' : '' ?>">
            <i class="fa-solid fa-house dashboard__iconos"></i>
            <span class="dashboard__menu-texto">
                Inicio
            </span>
        </a>

        <a href="/admin/ponentes" class="dashboard__enlace <?= currentPath('/ponentes')? 'dashboard__enlace--actual' : '' ?>">
            <i class="fa-solid fa-microphone dashboard__iconos"></i>
            <span class="dashboard__menu-texto">
            Ponentes
            </span>
        </a>

        <a href="/admin/eventos" class="dashboard__enlace <?= currentPath('/eventos')? 'dashboard__enlace--actual' : '' ?>">
            <i class="fa-solid fa-calendar-days dashboard__iconos"></i>
            <span class="dashboard__menu-texto">
                Eventos
            </span>
        </a>

        <a href="/admin/registrados" class="dashboard__enlace <?= currentPath('/registrados')? 'dashboard__enlace--actual' : '' ?>">
            <i class="fa-solid fa-users dashboard__iconos"></i>
            <span class="dashboard__menu-texto">
                Registrados
            </span>
        </a>

        <a href="/admin/regalos" class="dashboard__enlace <?= currentPath('/regalos')? 'dashboard__enlace--actual' : '' ?>">
            <i class="fa-solid fa-gift dashboard__iconos"></i>
            <span class="dashboard__menu-texto">
                Regalos
            </span>
        </a>


    </nav>
</aside>