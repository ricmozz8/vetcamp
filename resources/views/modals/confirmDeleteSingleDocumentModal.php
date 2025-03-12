<!-- Modal de Confirmación para Borrar Archivo -->
<form id="deleteFileForm" method="POST" action="/apply/application/deletedocuments">
    <input type="hidden" name="file_name" id="deleteFileName">
</form>

<div id="confirmDeleteSingleDocumentModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeleteSingleDocumentModal')">
            <i class="fas fa-times"></i>
        </span>
        <i class="fas fa-exclamation-circle"></i>
        <h2 id="deleteModalText">¿Estás seguro de que deseas borrar este archivo?</h2>
        <p>Si borras este archivo y no tienes una copia lo perderás porque esta acción no se puede deshacer.</p>

        <div class="modal-actions">
            <a href="#" class="main-action-bright" onclick="closeModal('confirmDeleteSingleDocumentModal')">Cancelar</a>
            <button type="submit" class="main-action-bright danger" onclick="submitDelete()">Borrar</button>
        </div>
    </div>
</div>

<script>
    function confirmDeleteSingleDocumentModal(fileName) {
        document.getElementById('deleteFileName').value = fileName;
        document.getElementById('deleteModalText').innerText = `¿Estás seguro de que deseas borrar el archivo "${fileName}"?`;
        openModal('confirmDeleteSingleDocumentModal');
    }
    function submitDelete() {
        document.getElementById('deleteFileForm').submit();
    }
</script>
