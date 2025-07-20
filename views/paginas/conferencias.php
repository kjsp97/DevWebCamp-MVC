<main class="agenda">
    <h2 class="agenda__heading"><?= $titulo ?></h2>
    <p class="agenda__descripcion">Conferencias y talleres dictados por expertos en desarrollo web</p>

    <div class="eventos">   
        <h3 class="eventos__heading">&#60;Conferencias /></h3>

        <p class="eventos__fecha">Viernes 3 de Octubre</p>
        
        <div class="evento__listado slider swiper">
            <div class="swiper-wrapper" data-aos="fade-left">
                <?php foreach ($eventos['conferencias_v'] as $evento) : ?>
                <?php include __DIR__ . '/../templates/evento.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        
        <p class="eventos__fecha">Sabado 4 de Octubre</p>
        
        <div class="evento__listado slider swiper" data-aos="fade-left">
            <div class="swiper-wrapper">
                <?php foreach ($eventos['conferencias_s'] as $evento) : ?>
                <?php include __DIR__ . '/../templates/evento.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <div class="eventos eventos--workshops" >
        <h3 class="eventos__heading">&#60;Workshops /></h3>

        <p class="eventos__fecha">Viernes 3 de Octubre</p>
        
        <div class="evento__listado slider swiper" data-aos="fade-right">
            <div class="swiper-wrapper">
                <?php foreach ($eventos['workshops_v'] as $evento) : ?>
                <?php include __DIR__ . '/../templates/evento.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
        
        <p class="eventos__fecha">Sabado 4 de Octubre</p>
        
        <div class="evento__listado slider swiper" data-aos="fade-right">
            <div class="swiper-wrapper">
                <?php foreach ($eventos['workshops_s'] as $evento) : ?>
                <?php include __DIR__ . '/../templates/evento.php' ?>
                <?php endforeach; ?>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>
</main>
