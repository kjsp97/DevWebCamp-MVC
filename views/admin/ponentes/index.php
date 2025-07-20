<h2 class="dashboard--heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/ponentes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Ponente
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (empty($ponentes)) : ?>
        <h3 class="text-center">No hay ponentes existentes</h3>
    <?php else : ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicación</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach ($ponentes as $ponente) : ?>
                    <tr class="table__tr">
                        <td class="table__td"><?= $ponente->nombre . ' ' . $ponente->apellido ?></td>
                        <td class="table__td"><?= $ponente->ciudad . ' ,' . $ponente->pais ?></td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/ponentes/editar?id=<?= $ponente->id ?>"><i class="fa-solid fa-user-pen"></i>Editar</a>
                            <form class="table__formulario" method="POST" action="/admin/ponentes/eliminar">
                                <input type="hidden" name="id" value="<?= $ponente->id ?>">
                                <button class="table__accion table__accion--eliminar" type="submit"><i class="fa-solid fa-trash-can"></i>Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>

<?= $paginacion ?>