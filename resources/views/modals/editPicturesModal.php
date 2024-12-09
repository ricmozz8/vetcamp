<div id="editPicturesModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('editPicturesModal')"><i class="las la-times"></i></span>
        <i class="las la-paw"></i>
        <h2>Editar fotos de la página de inicio</h2>
        <div class="modal-details">
            <form action="">

                <div class="upload-box">
                    <label for="file-">
                        <span> Selecciona un archivo</span>
                    </label>
                    <input name="file-1" type="file" onchange="updateFileName(this)">
                </div>
                <div class="upload-box">
                    <label for="file-2">
                        <span> Selecciona un archivo</span>
                    </label>
                    <input name="file-2" type="file" onchange="updateFileName(this)">
                </div>
                <div class="upload-box">
                    <label for="file-3">
                        <span> Selecciona un archivo</span>
                    </label>
                    <input name="file-3" type="file" onchange="updateFileName(this)">
                </div>
                <div class="upload-box">
                    <label for="file-5">
                        <span> Selecciona un archivo</span>
                    </label>
                    <input name="file-5" type="file" onchange="updateFileName(this)">
                </div>


            </form>

        </div>

        <div class="modal-actions">
            <button onclick="closeModal('editPicturesModal')" class="main-action-bright quaternary"><i class="las la-times"></i> Cancelar</button>
            <button class="main-action-bright secondary"><i class="las la-save"></i> Guardar</button>
        </div>

        </form>
    </div>
</div>