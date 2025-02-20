<!-- confirmDeleteApplicationModal.php -->
<div id="confirmDeleteApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmDeleteApplicationModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-file"></i>
            Eliminar solicitud
        </h2>
        <p>¿Seguro que quieres borrar esta solicitud? Se perderán todos los datos asociados a esta solicitud.</p>

        <?php if ($application->status == 'pendiente') { ?>
            <div class="warning-box">
                <p>Esta solicitud está pendiente de revisión. Si eliminas esta solicitud, se perderán todos los datos asociados a esta solicitud.</p>
            </div>
        <?php } ?>

        <?php if ($application->user->type == 'admin') { ?>
            <div class="danger-box">
                <p>Esta solicitud pertenece a un administrador, tenga en cuenta que si eliminas esta solicitud, se perderán todos los permisos asociados a esta solicitud.</p>
            </div>
        <?php } ?>

        <?php if ($application->user_id == Auth::user()->user_id) { ?>
            <div class="">
                <p>No puedes eliminar tu propia solicitud.</p>
            </div>
        <?php } else { ?>
            <form action="admin/delete/application" method="POST">
                <input type="hidden" name="application_id" value="<?= $application->id ?>">
                <div class="modal-actions">
                    <a class="main-action-bright" onclick=<?= "closeModal('confirmDeleteApplicationModal-" . $loop . "')" ?>>Cancelar</a>
                    <button class="main-action-bright danger" onclick=<?= "closeModal('confirmDeleteApplicationModal-" . $loop . "')" ?>>Eliminar</button>
                </div>
            </form>
        <?php } ?>
    </div>
</div>