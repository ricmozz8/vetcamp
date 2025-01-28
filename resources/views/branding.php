<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php'; ?>

<body>
    <?php require_once(__DIR__ . '/partials/genericNavbarNoAuth.php'); ?>


    <div class="section-image-blog">
        <img src="/<?= asset('img/logogrid_image.png') ?>" alt="Construcción del logotipo de vetcamp">
    </div>
    <div class="blog-content">
        <h1>Vetcamp vuelve mejor que nunca</h1>
        <p>Con una nueva plataforma y una nueva identidad visual más moderna y reconocible, adaptándose a los nuevos tiempos y a las redes sociales.</p>
        <div class="section-image-blog">
            <img style="width: 100%; object-fit:contain;" src="/<?= asset('img/before&after.png') ?>" alt="Rebranding de Vetcamp">
        </div>
        <p class="blog-description">
            Se ha
            creado una imagen visual más atractiva y versátil para el uso en diferentes entornos sin perder calidad,
            manteniendo el mensaje y la identidad de la marca.
            Recopilamos aquí los recursos de imagen de marca. Estos recursos están listos para ser
            utilizados tanto en el sitio web como en las redes sociales, material impreso y demás.
        </p>
        <br>
        <hr><br>

        <h2>Logotipo</h2>
        <p class="blog-description">
            El logotipo es una representación geométrica que conecta con la mascota universitaria, el lobo de la UPRA.
        </p>
        <div class="section-image-blog-full-contain">
            <img src="/<?= asset('img/iphone-14-case-mockup.png') ?>" alt="Construcción del logotipo de vetcamp">
        </div>
        <div class="section-image-blog">
            <img src="/<?= asset('img/sizeshow.png') ?>" alt="Construcción del logotipo de vetcamp">
        </div>
        <div class="section-image-blog">
            <img src="/<?= asset('img/grid_logo.png') ?>" alt="Construcción del logotipo de vetcamp">
        </div>
        <p class="blog-description">Mantenga un área del logotipo despejada de otros elementos visuales.</p>

        <h3><i class="las la-download"></i> Descargar logotipos (SVG)</h3>

        <div class="logo-elements">
            <div class="logo-square bright-logo-square">
                <img src="/<?= asset('logo/SVG/vetcamp-full-white.svg') ?>" alt="">
                <a download target="_blank" class="main-action-bright quaternary" href=<?= asset('logo/SVG/vetcamp-full-white.svg') ?>>
                    <i class="las la-download"></i> Descargar logotipo en positivo (SVG)
                </a>
            </div>
            <div class="logo-square dark-logo-square">
                <img src="/<?= asset('logo/SVG/vetcamp-full-black.svg') ?>" alt="">
                <a download target="_blank" class="main-action-bright tertiary" href=<?= asset('logo/SVG/vetcamp-full-white.svg') ?>>
                    <i class="las la-download"></i> Descargar logotipo en negativo (SVG)
                </a>
            </div>

            <div class="logo-square bright-logo-square">
                <img src="/<?= asset('logo/SVG/vetcamp-icon-white.svg') ?>" alt="">
                <a download target="_blank" class="main-action-bright quaternary" href=<?= asset('logo/SVG/vetcamp-full-white.svg') ?>>
                    <i class="las la-download"></i> Descargar isotipo en positivo (SVG)
                </a>
            </div>
            <div class="logo-square dark-logo-square">
                <img src="/<?= asset('logo/SVG/vetcamp-icon-black.svg') ?>" alt="">
                <a download target="_blank" class="main-action-bright tertiary" href=<?= asset('logo/SVG/vetcamp-full-white.svg') ?>>
                    <i class="las la-download"></i> Descargar isotipo en negativo (SVG)
                </a>
            </div>
        </div>
        <br>
        <hr><br>
        <h3><i class="las la-download"></i> Descargar logotipos (PNG)</h3>

        <div class="logo-elements">
            <div class="logo-square bright-logo-square">
                <img src="/<?= asset('logo/PNG/vetcamp-full-white.png') ?>" alt="">
                <a download target="_blank" class="main-action-bright quaternary" href=<?= asset('logo/PNG/vetcamp-full-white.png') ?>>
                    <i class="las la-download"></i> Descargar logotipo en positivo (PNG)
                </a>
            </div>
            <div class="logo-square dark-logo-square">
                <img src="/<?= asset('logo/PNG/vetcamp-full-black.png') ?>" alt="">
                <a download target="_blank" class="main-action-bright tertiary" href=<?= asset('logo/PNG/vetcamp-full-black.png') ?>>
                    <i class="las la-download"></i> Descargar logotipo en negativo (PNG)
                </a>
            </div>

            <div class="logo-square bright-logo-square">
                <img src="/<?= asset('logo/PNG/vetcamp-icon-white.png') ?>" alt="">
                <a download target="_blank" class="main-action-bright quaternary" href=<?= asset('logo/PNG/vetcamp-icon-white.png') ?>>
                    <i class="las la-download"></i> Descargar isotipo en positivo (PNG)
                </a>
            </div>
            <div class="logo-square dark-logo-square">
                <img src="/<?= asset('logo/PNG/vetcamp-icon-black.png') ?>" alt="">
                <a download target="_blank" class="main-action-bright tertiary" href=<?= asset('logo/PNG/vetcamp-icon-black.png') ?>>
                    <i class="las la-download"></i> Descargar isotipo en negativo (PNG)
                </a>
            </div>
        </div>

        <br>
        <hr><br>

        <h2>Tipografía</h2>
        <p class="blog-description">
            Utilizamos Parkinsans para los títulos o contenido que queramos destacar, y 'Figtree' para el resto de elementos visuales. Puedes
            conseguir estas fuentes en Google fonts sin coste alguno.
        </p>

        <div class="section-image-blog-full">
            <img src="/<?= asset('img/type_showcase.png') ?>" alt="Construcción del logotipo de vetcamp">
        </div>

        <div class="main-actions">
            <a class="main-action-bright tertiary" href="https://fonts.google.com/specimen/Parkinsans" target="_blank">Descargar Parkinsans</a>
            <a class="main-action-bright tertiary" href="https://fonts.google.com/specimen/Figtree" target="_blank">Descargar Figtree</a>

        </div>

        <br>
        <hr><br>
        <h2>Colores</h2>
        <p>El color principal que se utiliza para el contenido, y los elementos visuales es el color identificativo del
            recinto de la Universidad de Puerto Rico en Arecibo: el amarillo (específicamente el PANTONE 803 C).
            A partir de ese color principal, se ha creado una paleta de colores que permitirá realizar recursos visuales
            atractivos y modernos sin perder la identificación con el recinto.
        </p>


        <div class="color-palette">
            <div class="color-block block-primary">
                <p class="color-value">#ffe900</p>
            </div>
            <div class="color-block block-primary-s-1">

                <p class="color-value">#fff36d</p>
            </div>
            <div class="color-block block-primary-s-2">

                <p class="color-value">#fff7a0</p>
            </div>
            <div class="color-block block-primary-s-3">

                <p class="color-value">#fffbcf</p>
            </div>
        </div>

        <br>
        <hr><br>

        <h2>Créditos</h2>
        <p>Esta plataforma ha sido realizada gracias a los alumnos del departamento de Ciencias de Cómputos.</p>
        <a href="/credits" class="main-action-bright tertiary">Ver créditos</a>

    </div>

</body>

<?php require_once(__DIR__ . '/partials/footer.php'); ?>