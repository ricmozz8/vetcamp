<div id="confirmDeleteAccountModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeleteAccountModal')"><i class="fas fa-times"></i></span>
        <h2><i class="fas fa-exclamation-circle"></i> ¿Quieres eliminar tu cuenta?</h2>


        <div class="modal-details">
            <p>Se perderán <span style="font-weight: bold">todos los datos</span> y tendrás que crear una cuenta nueva
                para
                acceder nuevamente. </p>
        </div>
        <?php if ($isAdmin) { ?>
            <p class="warning-box">
                Eres administrador, por lo que si borras esta cuenta, has de solicitar al administrador que te
                asignen una nueva, y se perderán todos los datos.
            </p>
        <?php } ?>
        <form action="/user/delete" method="POST">
            <div class="form-group">
                <label for="confirmation-text">Escribe 'borrar mi cuenta' para confirmar la acción</label>
                <input type="text" required name="confirmation-text" id="confirmation-text" placeholder="Escribe 'borrar mi cuenta'"/>

            </div>
            <div class="modal-actions">
                <button type="submit" class="main-action-bright danger"><i class="fas fa-trash"></i> Borrar</button>
            </div>
        </form>
    </div>
</div>