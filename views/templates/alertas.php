<?php foreach ($alertas as $tipo => $alerta): ?>
    <?php foreach ($alerta as $mensaje): ?>
        <div class="alerta alerta__<?= $tipo ?>"><?= $tipo === 'error' ? '&#x26A0;' : '&#10004;'  ?> <?= $mensaje ?></div>
    <?php endforeach; ?>
<?php endforeach; ?>