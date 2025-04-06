<!-- Main popup container with the form -->
<div id="autoEnrollModal" class="modal">
    <div class="modal-content">

        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('autoEnrollModal')">
            <i class="fas fa-times"></i>
        </span>
        <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-wand-sparkles"></i>
            ¿Automatricular a todos los aceptados?
        </h2>


        <form action="/admin/enroll/auto" method="POST">

            <div class="form-group">
                <p>Esta acción matriculará a todos los estudiantes aceptados por
                    su sección preferida y cambiará el estado de las mismas a
                    "matriculada". Los estudiantes que no quepan en la sección
                    serán movidos automáticamente a la lista de espera</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('autoEnrollModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">
                    <i class="fas fa-check"></i>
                    Confirmar
                </button>
            </div>

        </form>
    </div>
</div>