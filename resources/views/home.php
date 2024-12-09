<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- <div class="top-lbl">
        <p style="font-weight: bold;">DO NOT SHOW TO STAKEHOLDERS | WEBSITE UNDER CONSTRUCTION</p>
    </div> -->
    <header class="navbar">
        <?php require_once('partials/applicationLogo.php'); ?>
    </header>
    <div class="hero">
        <h1>¡Explora tu pasión por la salud animal!</h1>
        <div class="hero-buttons">
            <a class="main-action-bright" href="/register">regístrate ya</a>
            <a class="main-action-bright tertiary" href="/login">O inicia sesión</a>
        </div>
    </div>

    <div class="splitted-header">
        <h3>¿Qué es Vetcamp?</h3>
        <p>
            Vetcamp de la Universidad de Puerto Rico Recinto de Arecibo (UPRA)
            es un campamento genial para estudiantes de escuela superior que aman
            los animales y quieren aprender sobre salud animal.
            <br> <br>
            Aquí, podrás explorar
            diferentes áreas de la medicina y tecnología veterinaria. Tendrás la oportunidad
            de trabajar con estudiantes y profesionales del campo, participando en presentaciones,
            laboratorios y visitas emocionantes. ¡Es una gran manera de descubrir si quieres
            seguir una carrera en este mundo!
        </p>
    </div>

    <div class="objectives-carroussel">

        <div class="carroussel-wrapper">
            <div class="carroussel">
                <img src="resources/assets/img/imageSnake.png">
                <img src="resources/assets/img/imageDogBlack.png">
                <!-- <img src="resources/assets/img/imageLab.png"> -->
            </div>
        </div>
        <div class="carrousel-actions">
            <div onclick="scroll_by_left()" id="scroll-action-l" class="c-action scroll-left">
                <i class="las la-angle-left"></i>
            </div>
            <div onclick="scroll_by_right()" id="scroll-action-r" class="c-action scroll-right">
                <i class="las la-angle-right"></i>
            </div>


        </div>
        <div class="splitted-header">
            <h3>Nuestros objetivos</h3>
            <ul>
                <li>Exponer a estudiantes de escuela superior interesados en el área
                    de salud animal al aspecto teórico y práctico de las labores de técnicos,
                    tecnólogos y médicos veterinarios en diferentes especies de animales.</li>
                <li>Orientarlos/as sobre los requerimientos para
                    estudiar a nivel universitario una carrera relacionada a la medicina veterinaria.
                </li>
                <li>Educar sobre las opciones para proseguir una carrera universitaria en el área de salud animal.</li>
                <li>Interactuar con diferentes especies de animales domésticos y exóticos.</li>
            </ul>
        </div>

            <div class="bio-container">
                <h1 class="team-title">Nuestro Equipo</h1>
                <div class="bio-card">
                    <img src="resources/assets/img/Dra._Rebeka_Sanabria.jpg" alt="Dra. Rebeka Sanabria León" class="bio-image">
                    <div class="bio-info">
                        <h2 class="bio-name">Dra. Rebeka Sanabria León</h2>
                        <p class="bio-title">Fundadora y Coordinadora del VetCamp <br>
                                             Catedrática Auxiliar del Programa de Tecnología Veterinaria – UPR Arecibo <br>
                                             Presidenta del Comité Institucional del Cuidado y Uso Animal – UPR Arecibo <br>
                                             </p>
                        <p class="bio-description"> Educación: <br>
                                                    DVM – Universidad Nacional Pedro Henríquez Ureña, Santo Domingo, RD – 2011 <br>
                                                    MSc – Nutrición Animal y Manejo de Residuos Orgánicos – UPR Mayagüez – 2006 <br>
                                                    BS – Agricultura General – UPR Mayagüez - 2003 <br></p>
                    </div>
                </div>

                <div class="bio-card">
                    <img src="resources/assets/img/Kenializ_Rosado_Molina.jpeg" alt="Kenializ Rosado Molina" class="bio-image">
                    <div class="bio-info">
                        <h2 class="bio-name">Kenializ Rosado Molina</h2>
                        <p class="bio-title"> LVT <br>
                                              Coordinadora SCNAVTA <br>
                                              Técnica de Laboratorio del Programa de Tecnología Veterinaria - UPR Arecibo <br></p>
                        <p class="bio-description"> Educación: <br>
                                                    BS – Microbiología Médica en la UPR de Arecibo <br>
                                                    Grado Asociado en Tecnología Veterinaria – UPR de Arecibo <br></p>
                    </div>
                </div>
                        <h3 class="team-title">Perrinstructores y Gatinstructores</h3>
                        <div class="instructor-grid">
                            <div class="instructor-item">
                                <img src="resources/assets/img/Eugenio.jpg" alt="Perrinstructor Eugenio" class="instructor-image">
                                <p class="instructor-name">Eugenio</p>
                            </div>
                            <div class="instructor-item">
                                <img src="resources/assets/img/Manolo.jpg" alt="Perrinstructor Manolo" class="instructor-image">
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
                    <p><?= $session->title ?></p>
                </div>
                <?php
                if ($loop == 4) {
                    $loop = 1;
                } ?>

            <?php $loop++;
            } ?>
        </div>
        <p class="min-margin">Vetcamp tendrá un costo de participación de <b>$500.00 por estudiante</b></p>
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
                <p>de tus padres o tutor legal</p>
            </div>
            <div class="req-card">
                <i class="las la-file"></i>
                <h4>Transcripción de crédito</h4>
            </div>
            <div class="req-card">
                <i class="las la-portrait"></i>
                <h4>Foto 2x2</h4>
                <p>que debe estar adjunta en la solicitud</p>
            </div>
            <div class="req-card last-card-grid">
                <i class="las la-clipboard-list"></i>
                <h4>Solicitud Escrita</h4>
                <p>Firmada por estudiante, encargado y director de la escuela.
                    En caso de que el estudiante sea educado en el hogar, deberá
                    llenar la Certificación de Estudiante Educado en el Hogar
                    (certificación de la UPR - Administración Central) y
                    entregarla junto a la solicitud del VetCamp.</p>
                <a class="main-action-bright secondary" href="/solicitud">Descargar</a>
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