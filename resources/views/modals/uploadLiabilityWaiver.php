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
            <small id="waiver_error" style="color: red; display: none;">Archivo inválido. Debe ser un PDF menor a 10MB.</small>
            <br><br>

            <div class="modal-actions">
                <a target="_blank" href="/descargoresponsabilidad" type="button" class="main-action-bright tertiary">Ver relevo
                    <i class="fas fa-external-link-alt"></i>
                </a>
                <button type="submit" class="main-action-bright primary">
                    <i class="las la-upload"></i> Subir archivo
                </button>
            </div>
        </form>

    </div>
    <!-- Deactivate red warning -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const waiverInput = document.getElementById("waiver_pdf");
            if (waiverInput) {
                const originalValidateExt = window.validateExt;
                const submitButton = waiverInput.form.querySelector('button[type="submit"]');
                const errorMessage = document.getElementById("waiver_error");
                const MAX_SIZE = 10 * 1024 * 1024;

                window.validateExt = function(fileName, accept, input) {
                    if (input.id === "waiver_pdf") return true;
                    return originalValidateExt(fileName, accept, input);
                };

                // for size
                window.validateSize = function(file, input) {
                    if (input.id === "waiver_pdf") return true;
                    return originalValidateSize(file, input);
                };

                function validateFile() {
                    const file = waiverInput.files[0];

                    if (!file) {
                        setInvalid();
                        return;
                    }

                    const isPDF = file.type === "application/pdf";
                    const isSizeOk = file.size <= MAX_SIZE;

                    if (isPDF && isSizeOk) {
                        setValid();
                    } else {
                        setInvalid();
                    }
                }

                function setValid() {
                    waiverInput.style.border = "2px solid green";
                    errorMessage.style.display = "none";
                    submitButton.disabled = false;
                }

                function setInvalid() {
                    waiverInput.style.border = "2px solid red";
                    errorMessage.style.display = "block";
                    submitButton.disabled = true;
                }

                waiverInput.addEventListener("change", validateFile);
                submitButton.disabled = true;
            }

        });
    </script>
</div>