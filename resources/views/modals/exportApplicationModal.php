<div id="exportApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('exportApplicationModal')"><i class="fas fa-times"></i></span>
        <h2>¿Deseas descargar esta solicitud?</h2>
        <div class="modal-details">
            <p>Se descargará un archivo .zip en tu ordenador.</p>
        </div>
        <form action="/admin/requests/download" method="POST">
            <input type="hidden" name="id" value="<?= $_GET['id'] ?>">
            <div class="modal-actions">
                <a href="#" class="main-action-bright" onclick="closeModal('exportApplicationModal')">Cancelar</a>
                <button class="main-action-bright primary" onclick="closeModal('exportApplicationModal')"><i class="fas fa-download"></i>Descargar</button>
            </div>
        </form>
    </div>
</div>