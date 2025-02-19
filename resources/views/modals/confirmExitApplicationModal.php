<div id="confirmExitApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmExitApplicationModal')"><i class="fas fa-times"></i></span>
        <h2>
        <i class="fas fa-exclamation-triangle"></i>
            ¿Deseas salir de la solicitud?
        </h2>
        <p>Puede que tus cambios no se actualicen del todo, te sugerimos que guardes antes de salir.</p>

        <div class="modal-actions">
            <input type="hidden" name="-1">
            <a class="main-action-bright" onclick="closeModal('confirmExitApplicationModal')">Cancelar</a>
            <a class="main-action-bright danger" href="/apply"><i class="fas fa-times"></i>Salir sin guardar</a>
        </div>
    </div>
</div>