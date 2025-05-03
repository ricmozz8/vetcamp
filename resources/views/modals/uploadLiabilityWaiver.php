<script src="<?= web_resource("js/fileupload.js") ?>"></script>
<div id="uploadLiabilityWaiver" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('uploadLiabilityWaiver')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-user"></i><br>
            Subir el archivo de descargo de responsabilidad
        </h2>
        <p>Este archivo debe ser formato PDF. Este archivo tendrá todos los descargo de responsabilidad necesario para el campamento, este archivo aparecerá a los usuarios ya aceptados en la sección de documentos finales.</p>
        <br>
        <form action="/admin/upload-waiver" method="post" enctype="multipart/form-data">
            <label for="waiver_pdf" class="main-action-bright secondary">
                <span>Seleccionar archivo PDF:</span>
            </label>
            <input type="file" name="waiver_pdf" id="waiver_pdf" accept="application/pdf" style="border-style: solid;" required onchange="updateFileName(this)">
            <br><br>

            <button type="submit" class="main-action-bright primary">
                <i class="las la-upload"></i> Subir archivo
            </button>
        </form>

    </div>
</div>