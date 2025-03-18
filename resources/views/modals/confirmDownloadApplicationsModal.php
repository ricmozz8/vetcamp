<div id="confirmDownloadApplicationsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDownloadApplicationsModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="fas fa-file-excel"></i>
            Exportar la tabla de solicitudes a Excel
        </h2>
        <p>¿Seguro que quieres exportar la tabla a un archivo CSV?</p>

        <form action="/admin/requests/export-to-csv" method="post">
            <input type="hidden" name="export-to-csv" value="1">

            <div class="modal-actions">
                <a class="main-action-bright quaternary" onclick="closeModal('confirmDownloadApplicationsModal')">Cancelar</a>
                <button onclick="closeModal('confirmDownloadApplicationsModal')" class="main-action-bright primary">Confirmar</button>

            </div>
        </form> 
    </div>
</div>