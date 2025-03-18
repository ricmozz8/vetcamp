<div id="confirmDownloadUsersModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDownloadUsersModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="fas fa-file-excel"></i>
            Exportar la tabla de usuarios a Excel
        </h2>
        <p>¿Seguro que quieres exportar la tabla a un archivo CSV?</p>

        <form action="/admin/registered/export-to-csv" method="post">
            <input type="hidden" name="export-to-csv" value="1">
            <div class="modal-actions">
                <a class="main-action-bright quaternary" onclick="closeModal('confirmDownloadUsersModal')">Cancelar</a>
                <button onclick="closeModal('confirmDownloadUsersModal')" class="main-action-bright primary">Confirmar</button>
            </div>
        </form>
    </div>
</div>