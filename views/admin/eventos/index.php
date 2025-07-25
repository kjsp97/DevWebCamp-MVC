<h2 class="dashboard--heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor-boton">
    <a class="dashboard__boton" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<div class="dashboard__contenedor">
    <?php if (empty($eventos)) : ?>
        <h3 class="text-center">No hay Eventos existentes</h3>
    <?php else : ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th">Día y Hora</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach ($eventos as $evento) : ?>
                    <tr class="table__tr">
                        <td class="table__td"><?= $evento->nombre ?></td>
                        <td class="table__td"><?= $evento->categoria->nombre ?></td>
                        <td class="table__td"><?= $evento->dia->nombre . ', ' . $evento->hora->hora ?></td>
                        <td class="table__td"><?= $evento->ponente->nombre . ' ' . $evento->ponente->apellido ?></td>
                        <td class="table__td--acciones">
                            <a class="table__accion table__accion--editar" href="/admin/eventos/editar?id=<?= $evento->id ?>"><i class="fa-solid fa-pencil"></i>Editar</a>
                            <form class="table__formulario" method="POST" action="/admin/eventos/eliminar">
                                <input type="hidden" name="id" value="<?= $evento->id ?>">
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
        