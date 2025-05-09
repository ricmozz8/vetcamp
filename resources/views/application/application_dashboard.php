<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
$application = Auth::user()->application();
$status = 'Sin llenar';


if ($application && $application->isSubmitted()) {
    $status = $application->status === 'Necesita Cambios' ? 'Necesita Cambios' : 'Sometida';
} else if ($application) {
    $status = $application->status;
}
?>

<body>
    <?php require_once(__DIR__ . '../../partials/profileNav.php'); ?>
    <div class="application-dashboard">
        <div class="application-card">

            <div class="application-card-action">

                <div class="application-card-head">
                    <div class="application-title">
                        <img class="no-mobile companion-icon" src="/<?= asset('logo/SVG/vetcamp-icon-black.svg') ?>" alt="">
                        <h2> Solicitud Vetcamp <?php echo date('Y'); ?></h2>
                    </div>

                    <div class="application-actions">

                        <?php if ($current_status === 'Aceptado' || $current_status === 'Matriculado') : ?>
                                <a href="/apply/requireddocuments" class="" style="margin-right: 1rem;">
                                    <i class="fas fa-upload"></i> Subir documentos finales
                                </a>
                        <?php endif; ?>
                       
                        <div
                            class="status-info <?= str_replace(' ', '-', strtolower($status)) ?>">
                            <p class="status"><?php echo $status; ?></p>
                        </div>
                        
                    </div>
                </div>

                <div class="application-card-progress">

                    <?php
                    $src = '/' . asset('img/statuses/status-unsubmitted.webp');
                    if ($application && $application->isSubmitted()) {
                        if ($application->status === 'Sometida') {
                            $src = '/' . asset('img/statuses/status-submitted.webp');
                        } else {
                            $src = '/' . asset('img/statuses/status-complete.webp');
                        }
                    }
                    ?>

                    <img draggable="false" class="status-image" src="<?= $src ?>" alt="status">

                </div>

            </div>

            <div class="check-blocks">

                <h2><i class="fas fa-file"></i> Documentos Guardados</h2>

                <div class="application-card-check-grid">

                    <?php $documents = $application ? $application->getSubmittedDocuments() : []; ?>

                    <!-- doc-ok or doc-no -->

                    <div class="application-card-check">
                        <?php if (isset($documents['written_essay'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Ensayo Escrito</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['video_essay'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Ensayo en vídeo</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['authorization_letter'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Carta de autorización</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['transcript'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Transcripción de crédito</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['picture'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Foto 2x2</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['written_application'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Certificación Estudiantil</p>
                    </div>

                    <div class="application-card-check">
                        <?php if (isset($documents['recommendation_letter'])) { ?>
                            <span class="doc-ok">
                                <i class="fas fa-check-circle"></i>
                            </span>
                        <?php } else { ?>
                            <span class="doc-no">
                                <i class="fas fa-times"></i>
                            </span>
                        <?php } ?>
                        <p>Carta de Recomendación</p>
                    </div>



                </div>

            </div>
            <div class="application-card-actions">
                <a href="/apply/application"
                    class="main-action-bright <?php echo !$can_apply ? 'disabled-alt' : 'secondary'; ?> " type="submit">
                    <?php if ($can_apply) { ?>
                        <i class="fas fa-pencil"></i>
                    <?php } ?>
                    <?php echo $can_apply ? ($status == 'Sin llenar' ? 'Llenar Solicitud' : 'Editar Solicitud') : 'Ha cerrado el proceso de solicitud'; ?>
                </a>
            </div>


        </div>
    </div>

    <?php require_once(__DIR__ . '../../modals/applicationStatusHelp.php'); ?>
    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>