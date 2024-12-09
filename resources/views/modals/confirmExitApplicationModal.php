<div id="confirmExitApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmExitApplicationModal')"><i class="las la-times"></i></span>
        <h2>
        <i class="las la-exclamation-triangle"></i>
            ¿Deseas salir de la solicitud?
        </h2>
        <p>Tus cambios no se guardarán correctamente</p>

        <div class="modal-actions">
            <input type="hidden" name="-1">
            <a class="main-action-bright quaternary" onclick="closeModal('confirmExitApplicationModal')">Cancelar</a>
            <a class="main-action-bright danger" href="/apply"><i class="las la-times"></i>Salir sin guardar</a>
        </div>
    </div>
</div>