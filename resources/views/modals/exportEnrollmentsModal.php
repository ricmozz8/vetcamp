<div id="exportEnrollmentsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('exportEnrollmentsModal')"><i class="fas fa-times"></i></span>
        <h2>¿Deseas descargar la matrícula?</h2>
        <div class="modal-details">
            <p>Se descargará un archivo .zip en tu ordenador.</p>
        </div>
        <form action="/admin/enrollments/download" method="POST">
            <div class="modal-actions">
                <a href="#" class="main-action-bright" onclick="closeModal('exportEnrollmentsModal')">Cancelar</a>
                <button class="main-action-bright primary" onclick="closeModal('exportEnrollmentsModal')"><i class="fas fa-download"></i>Descargar</button>
            </div>
        </form>
    </div>
</div>