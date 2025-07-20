<h2 class="dashboard--heading"><?= $titulo ?></h2>

<div class="dashboard__contenedor">
    <?php if (empty($registros)) : ?>
        <h3 class="text-center">No hay registros existentes</h3>
    <?php else : ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Plan</th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach ($registros as $registro) : ?>
                    <tr class="table__tr">
                        <td class="table__td"><?= $registro->usuario->nombre . ' ' . $registro->usuario->apellido ?></td>
                        <td class="table__td"><?= $registro->usuario->email ?></td>
                        <td class="table__td"><?= $registro->paquete->nombre ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>

<?= $paginacion ?>