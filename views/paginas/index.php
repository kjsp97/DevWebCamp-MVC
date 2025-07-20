<?php include_once __DIR__ . '/conferencias.php' ?>

<section class="resumen">
    <div class="resumen__grid">
        <div class="resumen__bloque"  data-aos="fade-down">
            <p class="resumen__texto resumen__texto--numero"><?= $ponentes_totales ?></p>
            <p class="resumen__texto">Speakers</p>
        </div>


        <div class="resumen__bloque" data-aos="fade-down">
            <p class="resumen__texto resumen__texto--numero"><?= $conferencias_totales ?></p>
            <p class="resumen__texto">Conferencias</p>
        </div>


        <div class="resumen__bloque"  data-aos="fade-up">
            <p class="resumen__texto resumen__texto--numero"><?= $workshops_totales ?></p>
            <p class="resumen__texto">Workshops</p>
        </div>


        <div class="resumen__bloque"  data-aos="fade-up">
            <p class="resumen__texto resumen__texto--numero">+500</p>
            <p class="resumen__texto">Asistentes</p>
        </div>
    </div>
</section>

<section class="ponentes">
    <h2 class="ponentes__heading">Ponentes</h2>
    <p class="ponentes__descripcion">Conoce más sobre nuestros ponentes</p>
    <div class="ponentes__grid">
        <?php foreach ($ponentes as $ponente) : ?>
            <div class="ponente" data-aos="zoom-out-down">

                <picture>
                    <source srcset="img/speakers/<?= $ponente->imagen ?>.webp" type="image/webp">
                    <img class="ponente__imagen" loading="lazy" height="200" width="200" src="img/speakers/<?= $ponente->imagen ?>.png" alt="Imagen Ponente">
                </picture>
                
                <h4 class="ponente__nombre"><?= $ponente->nombre . ' ' . $ponente->apellido ?></h4>

                <p class="ponente__origen"><?= $ponente->ciudad . ', ' . $ponente->pais ?></p>
                
                <nav class="ponente-redes"> 
                    <?php $redes = json_decode($ponente->redes) ?>
                        <?php if ($redes->facebook) : ?>
                            <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://facebook.com/#">
                                <span class="ponente-redes__ocultar">Facebook</span>
                            </a> 
                        <?php endif ?>
                        <?php if ($redes->twitter) : ?>
                            <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://x.com/#">
                            <span class="ponente-redes__ocultar">Twitter</span>
                            </a> 
                        <?php endif ?>
                        <?php if ($redes->youtube) : ?>
                            <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://youtube.com/#">
                            <span class="ponente-redes__ocultar">YouTube</span>
                            </a> 
                        <?php endif ?>
                        <?php if ($redes->instagram) : ?>
                            <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://instagram.com/#">
                            <span class="ponente-redes__ocultar">Instagram</span>
                            </a> 
                        <?php endif ?>
                        <?php if ($redes->tiktok) : ?>
                            <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://tiktok.com/@#">
                            <span class="ponente-redes__ocultar">Tiktok</span>
                            </a> 
                        <?php endif ?>
                        <?php if ($redes->github) : ?>
                        <a class="ponente-redes__enlace" rel="noopener noreferrer" target="_blank" href="https://github.com/#">
                            <span class="ponente-redes__ocultar">Github</span>
                            </a>
                        <?php endif ?>
                </nav>

                <ul class="ponente__habilidades">
                    <?php 
                    $tags = explode(',', $ponente->tags);
                    foreach ($tags as $tag) : ?>
                        <li class="ponente__habilidad"><?= $tag ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endforeach ?>
    </div>
</section>

<div id="mapa" class="mapa"></div>

<section class="boletos">
    <h2 class="boletos__heading">Tickets</h2>
    <p class="boletos__descripcion">Precios de las entradas</p>

    <div class="boletos__grid">
        <div class="boleto boleto--presencial" data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="boleto__logo ">&#60;DevWebCamp /></h3>
            <p class="boleto__plan">Presencial</p>
            <p class="boleto__precio">199 €</p>
        </div>
        <div class="boleto boleto--virtual" data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="boleto__logo ">&#60;DevWebCamp /></h3>
            <p class="boleto__plan">Virtual</p>
            <p class="boleto__precio">49 €</p>
        </div>
        <div class="boleto boleto--gratis" data-aos="flip-left" data-aos-easing="ease-out-cubic">
            <h3 class="boleto__logo  ">&#60;DevWebCamp /></h3>
            <p class="boleto__plan">Pase Gratuito</p>
            <p class="boleto__precio">0 €</p>
        </div>
    </div>

    <div class="boleto__enlace-contenedor">
        <a href="/paquetes" class="boleto__enlace">Ver Paquetes</a>
    </div>
</section>