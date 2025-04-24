<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
<?php require_once(__DIR__ . '../../partials/profileNav.php'); ?>
<script src="<?= web_resource("js/fileupload.js") ?>"></script>


<div class="application_header">
    <h1 class="">Documentos Requeridos</h1>
    <a href="/apply" class="main-action-bright secondary"><i class="fas fa-arrow-left"></i>Atrás</a>
</div>

<p class="subtext" style="margin: 1em var(--main-margin); text-align: left;">
    Nota: si la plataforma no le permite subir documentos, intente reducir su tamaño comprimiéndolos y luego subirlos.
    <b style="font-weight: bold">Suba el archivo en el formato especificado NO suba archivos .zip, .7z, .rar ni parecidos</b> estos formatos
    no son permitidos.</p>

<p class="warning-box" style="margin: 1em var(--main-margin); text-align: left;">
    Los documentos deben pesar <b style="font-weight: 800;"> menos de 10 MB</b> de lo contrario, la plataforma no
    subirá los archivos.

</p>


<div class="application-form-card">
    <!-- Document upload section -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="document-section">
            <!-- Document upload boxes -->

            <!-- medical plan -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['medical_plan'])) { ?>

                        <?php $medical_plan = $saved_documents['medical_plan']; ?>
                        <label formats="pdf" for="medical_plan"> <span> <i class="fas fa-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $medical_plan['name'] ?>" type="file"
                               id="medical_plan" name="medical_plan" onchange="updateFileName(this)">


                    <?php } else { ?>

                        <label formats="pdf" for="medical_plan"> <i class="fas fa-file-upload"></i> <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="medical_plan" name="medical_plan"
                               onchange="updateFileName(this)">

                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Plan médico (PDF)</label>
                    <?php if (isset($saved_documents['medical_plan'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $medical_plan['name'] ?>')"
                           class="btn-download">
                            <i class="fas fa-eye"></i> Visualizar
                        </a>
                        <a href="#" class="btn-delete" onclick="confirmDeleteSingleDocumentModal('<?= $medical_plan['name'] ?>')">
                            <i class="fas fa-trash-alt"></i> Borrar
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- payment_receipt -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['payment_receipt'])) { ?>

                        <?php $payment_receipt = $saved_documents['payment_receipt']; ?>
                        <label formats="pdf" for="payment_receipt"> <span> <i class="fas fa-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $payment_receipt['name'] ?>" type="file"
                               id="payment_receipt" name="payment_receipt" onchange="updateFileName(this)">


                    <?php } else { ?>

                        <label formats="pdf" for="payment_receipt"> <i class="fas fa-file-upload"></i> <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="payment_receipt" name="payment_receipt"
                               onchange="updateFileName(this)">

                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Recibo de pago (PDF)</label>
                    <?php if (isset($saved_documents['payment_receipt'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $payment_receipt['name'] ?>')"
                           class="btn-download">
                            <i class="fas fa-eye"></i> Visualizar
                        </a>
                        <a href="#" class="btn-delete" onclick="confirmDeleteSingleDocumentModal('<?= $payment_receipt['name'] ?>')">
                            <i class="fas fa-trash-alt"></i> Borrar
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- liability_waiver -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['liability_waiver'])) { ?>

                        <?php $liability_waiver = $saved_documents['liability_waiver']; ?>
                        <label formats="pdf" for="liability_waiver"> <span> <i class="fas fa-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $liability_waiver['name'] ?>" type="file"
                               id="liability_waiver" name="liability_waiver" onchange="updateFileName(this)">


                    <?php } else { ?>

                        <label formats="pdf" for="liability_waiver"> <i class="fas fa-file-upload"></i> <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="liability_waiver" name="liability_waiver"
                               onchange="updateFileName(this)">

                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Revelo de responsabilidad (PDF)</label>
                    <?php if (isset($saved_documents['liability_waiver'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $liability_waiver['name'] ?>')"
                           class="btn-download">
                            <i class="fas fa-eye"></i> Visualizar
                        </a>
                        <a href="#" class="btn-delete" onclick="confirmDeleteSingleDocumentModal('<?= $liability_waiver['name'] ?>')">
                            <i class="fas fa-trash-alt"></i> Borrar
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="form-actions">
            <input type="hidden" name="stage" value="4">
            <p>Se guardará la información una vez pulses siguiente.</p>
            <button type="submit" id="next-button" class="main-action-bright gradiented">Siguiente</button>
        </div>
    </form>
</div>
<!-- including here file view popup -->
<?php foreach ($saved_documents as $file) { ?>
    <?php require(__DIR__ . '../../modals/fileViewPopup.php'); ?>
<?php } ?>

<?php require_once __DIR__ . '../../modals/confirmDeleteSingleDocumentModal.php';?>

<?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>