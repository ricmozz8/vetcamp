<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php'; ?>


<body class="document-printable">

<div class="document-action-topbar">

    <div class="mw-doc">
        <div class="flex-col">
            <h3>Certificación Estudiantil</h3>
            <p>Llévela a su director o consejero escolar para firmar y timbrar.</p>
        </div>
        <a class="main-action-bright primary" href="javascript:window.print();"> <i class="fas fa-download"></i>
            Imprimir (Ctrl+P)</a>
    </div>
</div>

<div class="printable-application">

    <?php require_once(__DIR__ . '/partials/applicationLogo.php'); ?>

    <div class="address-split">
        <div class="address">
            <p>Universidad de Puerto Rico, Arecibo
                Departamento de biología | Programa de Tecnología veterinaria
                Carr. 653 Km. 0.8 Sector Las Dunas, Arecibo / P.O. Box 4010 Arecibo P.R. 00614 <br>
                http://upra.edu/biologia/asociado/ <br>
                787-815-0000 ext. 3475, 3450, 3451, 3460, 3461</p>
        </div>

        <div class="logos">
            <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="UPR Logo" class="sponsor-logo">
            <img src="https://upra.edu/wp-content/uploads/2019/08/aetv.jpg" alt="TVET LOGO">

        </div>
    </div>


    <h1 class="document-title">Certificación Estudiantil para Vetcamp <?= date('Y') ?></h1>

    <div class="document-content">
        <div class="printed-form-group">
            <div class="form-print-grid">
                <div class="form-print-data">
                    <h4>Nombre</h4>
                    <p><?= Auth::user()->first_name . ' ' . Auth::user()->last_name ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Tamaño de ropa</h4>
                    <p><?= Auth::user()->application()->shirt_size ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Fecha de Nacimiento</h4>
                    <p><?= get_date_spanish(Auth::user()->birthdate) ?> (<?= Auth::user()->get_age() ?> años)</p>
                </div>
                <div class="form-print-data">
                    <h4>Teléfono residencial o celular</h4>
                    <p><?= format_phone(Auth::user()->phone_number) ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Dirección postal</h4>
                    <p><?= Auth::user()->postal_address()->build() ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Dirección Física</h4>
                    <p><?= Auth::user()->physical_address()->build() ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Escuela de procedencia</h4>
                    <p><?= Auth::user()->school_address()->build() ?></p>
                </div>
                <div class="form-print-data">
                    <h4>Sesión preferida</h4>
                    <p><?= Auth::user()->application()->preferred_session(true) ?></p>
                </div>

            </div>

        </div>

        <hr>
        <p class="document-centered">Para completar por un consejero(a) o director(a) de la escuela de procedencia:
        </p>

        <div class="fillable-document-block">
                <span class="document-blanks">
                    <p>Yo, </p> <span class="blank-space">Nombre del consejero(a) o director(a)</span>
                    <p> certifico que el estudiante</p>
                    <span class="blank-space">Nombre del estudiante</span>
                    <p> cursa el</p> <span class="blank-space">Grado que cursa</span>
                    <p> en nuestra institución</p>
                </span>

            <div class="certification">

                <span class="blank-space wf">Certifico correcto</span>
                <span class="seal-square">Sello oficial</span>
                <span class="blank-space wf">Fecha</span>


            </div>
        </div>

        <hr>

        <div class="legal-notice">
            <p>Se entregarán los siguientes documentos para completar el proceso de solicitud al VetCamp 2025:
                1. Solicitud de inscripción completada en todas sus partes.
                2. Transcripción de créditos oficial de la escuela de procedencia.
                3. Ensayo escrito (500 palabras) y digital (video; 2 minuto o menos) que indique cuál es su interés por
                participar en el VetCamp.
                4. Carta de recomendación del maestro de ciencias
                5. Foto 2x2 adjunta a la solicitud
                6. Carta de autorización de padre/madre/encargado(a) autorizando al/la estudiante participar.
                Las solicitudes serán evaluadas solo si se entrega toda la documentación requerida. Cupo máximo para 14
                estudiantes por sección. Los
                documentos deberán entregarse en http://vetcamp.upra.edu/ o en el Laboratorio de TVET (Salón E-110) de
                la UPR de Arecibo de
                lunes a viernes de 7:00 am a 3:30 pm. Para dudas o información adicional llame al 787-815-0000 extensión
                3475 o escriba a
                vetcamp.arecibo@upr.edu.
                *Patrono con igualdad de oportunidades de empleo</p>
        </div>


    </div>

</body>