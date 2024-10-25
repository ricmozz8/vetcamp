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
        <img class="logotype" src="<?= asset('logo/SVG/vetcamp_full_hoz_b.svg') ?>" alt="Vetcamp Logo">
    </header>
    <div class="hero">
        <h1>¡Explora tu pasión por la salud animal!</h1>
        <a href="/register">regístrate ya</a>
    </div>

    <div class="splitted-header">
        <h3>¿Qué es Vetcamp?</h3>
        <p>
            El VetCamp de la Universidad de Puerto Rico Recinto de Arecibo (UPRA)
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
                <img src="https://placehold.co/600x400" alt="a python snake">
                <img src="https://placehold.co/600x400" alt="a python snake">
                <img src="https://placehold.co/600x400" alt="a python snake">
                <img src="https://placehold.co/600x400" alt="a python snake">
            </div>
        </div>
        <div class="carrousel-actions">
            <div onclick="scrollLeft" id="scroll-action-l" class="c-action scroll-left"><i class="las la-angle-left"></i>
            </div>
            <div onclick="scrollRight" id="scroll-action-r" class="c-action scroll-right"><i class="las la-angle-right"></i>
            </div>
        </div>
        <div class="objectives">
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

    </div>




    <div class="sections-dynamic">
        <div class="splitted-header">
            <div class="block centered">
                <h3>Secciones abiertas</h3>
                <p>14 estudiantes por sección</p>
            </div>

            <p>¡Solicita entre el 15 de febrero hasta el 8 de marzo de 2024!</p>
        </div>

        <div class="sections-blocked-dynamic ">
            <div class="section-block shade-1">
                <h1>3 al 7 de junio de 2024</h1>
                <p>Sección 1</p>
            </div>
            <div class="section-block shade-2">
                <h1>3 al 7 de junio de 2024</h1>
                <p>Sección 2</p>
            </div>
            <div class="section-block shade-3">
                <h1>3 al 7 de junio de 2024</h1>
                <p>Sección 3</p>
            </div>
            <div class="section-block shade-4">
                <h1>3 al 7 de junio de 2024</h1>
                <p>Sección 4</p>
            </div>
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
                <i class="las la-file-alt"></i>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
            </div>
            <div class="req-card">
                <i class="las la-file-alt"></i>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
            </div>
            <div class="req-card">
                <i class="las la-file-alt"></i>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
            </div>
            <div class="req-card">
                <i class="las la-file-alt"></i>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
            </div>
            <div class="req-card">
                <i class="las la-file-alt"></i>
                <h4>Ensayo (Escrito Y Vídeo)</h4>
                <p>Indicando porqué te interesa participar en el campamento</p>
                <a href="">Descargar</a>
            </div>
        </div>
    </div>

    <div class="contact-section">
        <div class="left-flex">
            <div class="top-flex">
                <h2>¿Tienes preguntas? ¡Contáctanos!</h2>
            </div>
            <div class="bottom-flex">
                <p>Universidad de Puerto Rico en AreciboCarr. 653 Km. 0.8 Sector Las Dunas, AreciboP.O. Box 4010 Arecibo P.R. 00614-4010
                    787-815-0000 Ext. 3475vetcamp.arecibo@upr.edu</p>
            </div>
        </div>

        <div class="right-flex">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3784.3445102878864!2d-66.74303132508336!3d18.468047770777044!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c02e71441a83073%3A0xf81fe612f4f1f3f7!2sUniversidad%20de%20Puerto%20Rico%20-%20Recinto%20de%20Arecibo!5e0!3m2!1ses-419!2spr!4v1729822604252!5m2!1ses-419!2spr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> | Universidad de Puerto Rico Arecibo</p>
        <img class="university-logo" src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra">
    </footer>



</body>

</html>