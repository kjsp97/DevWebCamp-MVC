<fieldset class="formulario__fieldset">
    <legend class="formulario__legend">Información del Evento</legend>
    <div class="formulario__campo">
        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre del Evento" value="<?= $evento->nombre ?>">
    </div>
    <div class="formulario__campo">
        <textarea class="formulario__input" name="descripcion" id="descripcion" placeholder="Descripción" rows="6"><?= $evento->descripcion ?></textarea>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="categoria">Categoria</label>
        <select class="formulario__input" name="categoria_id" id="categoria">
                <option disabled value="" <?= empty($evento->categoria_id)? 'selected' : '' ?>>--Selecciona la categoria--</option>
            <?php foreach ($categorias as $categoria) : ?>
                <option value="<?= $categoria->id ?>" <?= $evento->categoria_id === $categoria->id ? 'selected' : '' ?>><?= $categoria->nombre ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Selecciona el día</label>
        <div class="formulario__radio">
            <?php foreach ($dias as $dia) : ?>
                <div>
                    <label for="<?= strtolower($dia->id) ?>"><?= $dia->nombre ?></label>
                    <input type="radio" value="<?= $dia->id ?>" id="<?= strtolower($dia->id) ?>" name="dia" <?= $evento->dia_id === $dia->id ? 'checked' : '' ?>>
                </div>
            <?php endforeach ?>
        </div>
        <input type="hidden" name="dia_id" value="<?= $evento->dia_id ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label">Selecciona la hora</label>
        <ul class="horas">
            <?php foreach ($horas as $hora) : ?>
                <li class="horas__hora horas__hora--deshabilitado" data-hora-id="<?= $hora->id ?>" name="hora"><?= $hora->hora ?></li>
            <?php endforeach ?>
        </ul>
        <input type="hidden" name="hora_id" value="<?= $evento->hora_id ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="ponente">Nombre del Ponente</label>
        <input type="text" class="formulario__input" name="ponente" id="ponente" placeholder="Buscar por nombre"></input>
        <ul class="listado-ponentes"></ul>
        <input type="hidden" name="ponente_id" value="<?= $evento->ponente_id ?>">
    </div>
    <div class="formulario__campo">
        <label class="formulario__label" for="disponibles">Plazas disponibles</label>
        <input type="number" min="1" class="formulario__input" name="disponibles" id="disponibles" placeholder="Indica el numero de plazas" value="<?= $evento->disponibles ?>"></input>
    </div>


</fieldset>
