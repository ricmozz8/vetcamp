<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>

    <?php require __DIR__ . '/partials/homeNavbar.php'; ?>
    <div class="hero">
        <div class="main-copy">
            <h1>¡Explora tu pasión por la medicina veterinaria!</h1>
            <p>
                Tendrás la oportunidad de trabajar con estudiantes y profesionales del campo,
                participando en presentaciones, laboratorios y visitas emocionantes.
            </p>
        </div>
        <?php if (!Auth::check()) : ?>
            <div class="hero-buttons">
                <a class="main-action-bright gradiented" href="/register">Regístrate ya</a>
                <a class="main-action-bright no-deco-action" href="/login">O inicia sesión</a>

            </div>
        <?php elseif (Auth::user()->type === 'admin') : ?>
            <div class="hero-buttons">
                <a class="main-action-bright tertiary" href="/admin">
                    <i class="las la-cog"></i>
                    Admin
                </a>
            </div>

        <?php else: ?>

            <div class="hero-buttons">
                <a class="main-action-bright tertiary" href="/apply">!Solicita ya!</a>
            </div>
        <?php endif; ?>
        <p class="close-date-text">Solicitudes cierran el <?= get_date_spanish($limit_dates->end_date, false) ?></p>

        <div class="images-grid-hero no-mobile">

            <div class="hero-image hi-1">
                <img src=<?= asset('img/cow-2.jpeg') ?> alt="Vetcamp Verano 2023">
            </div>

            <div class="top-of-another-images">

                <div class=" hi-2">
                    <img src=<?= asset('img/doggo-checkup-2.jpeg') ?> alt="Vetcamp Verano 2023">
                </div>
                <div class="
                 hi-3">
                    <img src=<?= asset('img/microscopes-2.jpeg') ?> alt="Vetcamp Verano 2023">
                </div>


            </div>

            <div class="hero-image hi-4">
                <img src=<?= asset('img/group-looking-away-2.jpeg') ?> alt="Vetcamp Verano 2023">
            </div>

        </div>

        <div class="sponsors">
            <h2>Traído a ustedes por:</h2>
            <div class="sponsor-logos">
                <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="UPR Logo" class="sponsor-logo">
                <img src="https://upra.edu/wp-content/uploads/2019/08/aetv.jpg" alt="TVET LOGO">
            </div>
        </div>
    </div>

    <div class="sections-dynamic">
        <div class="splitted-header">
            <div class="block">
                <h3>Secciones abiertas</h3>
                <p>*14 estudiantes por sección</p>
            </div>

            <p>¡Solicita entre el <?= get_date_spanish($limit_dates->start_date, false) ?> y el <?= get_date_spanish($limit_dates->end_date) ?>!</p>
        </div>

        <div class="sections-blocked-dynamic ">
            <?php
            $loop = 1;
            foreach ($sessions as $session) {
            ?>
                <div class="section-block shade-<?php echo $loop; ?>">
                    <h1><?= get_date_spanish($session->start_date, false, false) . ' al ' . get_date_spanish($session->end_date); ?></h1>
                </div>
                <?php
                if ($loop == 4) {
                    $loop = 1;
                } ?>

            <?php $loop++;
            } ?>
        </div>
        <p class="min-margin cost-ad">Vetcamp tendrá un costo de participación de <b>$500.00 por estudiante</b></p>
    </div>

    <div class="participation-requirements">
        <div class="splitted-header">
            <h3>Requisitos de participación</h3>
            <p>Serán elegibles para participar aquellos/as estudiantes,
                de 14 a 18 años y que actualmente cursen los grados 9,
                10, 11 y 12 de escuela superior. Además, para poder
                participar del campamento deben tener un promedio de 2.50
                o más y es necesario que cada uno/a presente:</p>
        </div>

        <div class="requirement-cards-grid">
            <div class="req-card">
                <div class="flex-min">
                    <i class="las la-file-alt"></i>
                    <i class="las la-play-circle"></i>
                </div>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
            </div>
            <div class="req-card">
                <i class="las la-envelope-open"></i>
                <h4>Carta de autorización</h4>
                <p>De tus padres o tutor legal</p>
            </div>
            <div class="req-card">
                <i class="las la-file"></i>
                <h4>Transcripción de crédito</h4>
            </div>
            <div class="req-card">
                <i class="las la-portrait"></i>
                <h4>Foto 2x2</h4>
            </div>
            <div class="req-card ">
                <i class="las la-clipboard-list"></i>
                <h4>Certificación Estudiantil</h4>
                <p>Firmada por el encargado y director de la escuela.
                    En caso de que el estudiante sea educado en el hogar, deberá
                    llenar la Certificación de Estudiante Educado en el Hogar
                    (certificación de la UPR - Administración Central) y
                    entregarla junto a la solicitud del VetCamp.</p>

            </div>
            <div class="req-card">
                <i class="las la-file-signature"></i>
                <h4>Carta de recomendación</h4>
                <p>De tu maestro de ciencias</p>

            </div>
        </div>
    </div>

    <div class="objectives-carroussel">
        <div class="bio-container">
            <h1 class="team-title">Nuestro Equipo</h1>

            <div class="team-people-grid">

                <div class="bio-card">
                    <img src="resources/assets/img/Dra._Rebeka_Sanabria-2.jpeg" alt="Dra. Rebeka Sanabria León" class="bio-image">
                    <div class="bio-info">
                        <h2 class="bio-name">Dra. Rebeka Sanabria León</h2>
                        <p class="bio-title">Fundadora y Coordinadora del VetCamp <br>
                        </p>
                    </div>
                </div>

                <div class="bio-card">
                    <img src="resources/assets/img/Kenializ_Rosado_Molina-2.jpeg" alt="Kenializ Rosado Molina" class="bio-image">
                    <div class="bio-info">
                        <h2 class="bio-name">Kenializ Rosado Molina</h2>
                        <p class="bio-title"> LVT <br>
                            Coordinadora SCNAVTA <br>
                            Técnica de Laboratorio del Programa de Tecnología Veterinaria - UPR Arecibo <br></p>
                    </div>
                </div>

            </div>

            <h3 class="team-title">Perrinstructores y Gatinstructores</h3>
            <div class="instructor-grid">
                <div class="instructor-item">
                    <img src="resources/assets/img/Eugenio-2.jpeg" alt="Perrinstructor Eugenio" class="instructor-image">
                    <p class="instructor-name">Eugenio</p>
                </div>
                <div class="instructor-item">
                    <img src="resources/assets/img/Manolo-2.jpeg" alt="Perrinstructor Manolo" class="instructor-image">
                    <p class="instructor-name">Manolo</p>
                </div>
                <div class="instructor-item">
                    <img src="resources/assets/img/Twiggy.jpg" alt="Gatinstructor Twiggy" class="instructor-image">
                    <p class="instructor-name">Twiggy</p>
                </div>
                <div class="instructor-item">
                    <img src="resources/assets/img/Punky.jpg" alt="Gatinstructor Punky" class="instructor-image">
                    <p class="instructor-name">Punky</p>
                </div>
            </div>
        </div>
    </div>



    <div class="contact-section">
        <div class="left-flex">
            <div class="top-flex">
                <h2>¿Tienes preguntas? ¡Contáctanos!</h2>
            </div>
            <div class="bottom-flex">
                <p>Universidad de Puerto Rico en Arecibo Carr. 653 Km. 0.8 Sector Las Dunas, Arecibo P.O. Box 4010 Arecibo P.R. 00614-4010</p>
                <p>787-815-0000 Ext. 3475</p>
                <a class="no-deco-action" href="mailto:vetcamp.arecibo@upr.edu">vetcamp.arecibo@upr.edu</a>
            </div>
        </div>

        <div class="right-flex">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.3445102878864!2d-66.74303132508336!3d18.468047770777044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c02e71441a83073%3A0xf81fe612f4f1f3f7!2sUniversidad%20de%20Puerto%20Rico%20-%20Recinto%20de%20Arecibo!5e0!3m2!1ses-419!2spr!4v1729822604252!5m2!1ses-419!2spr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <?php require_once('partials/footer.php'); ?>



</body>

</html>