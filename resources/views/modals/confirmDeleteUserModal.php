<div id=<?= "confirmDeleteUserModal-" . $loop ?> class="modal">
    <div class="modal-content">
        <span class="close-button" onclick=<?= "closeModal('confirmDeleteUserModal-" . $loop . "')"  ?>><i class="las la-times"></i></span>
        <h2>
            <i class="las la-user"></i>
            Eliminar usuario
        </h2>
        <p>¿Seguro que quieres borrar este usuario? Se perderán todos sus datos incluyendo sus solicitudes</p>

        <?php
        if ($user->application()) {
        ?>
            <div class="warning-box">
                <p>Este usuario tiene solicitudes pendientes. Si eliminas su cuenta, se borrará todo lo asociado a este usuario, incluyendo direcciones, solicitudes y documentos.</p>
            </div>
        <?php
        }
        ?>
        <?php
        if ($user->type == 'admin') {
        ?>
            <div class="danger-box">
                <p>Este usuario es un administrador, tenga en cuenta que si eliminas su cuenta, se perderán todos sus permisos.</p>
            </div>
        <?php
        }
        ?>

        <?php if ($user->user_id == Auth::user()->user_id) { ?>
            <div class="">
                <p>No puedes eliminar tu propia cuenta.</p>
            </div>
        <?php } else { ?>
            <form action="/users/delete" method="POST">
                <input type="hidden" name="user_id" value="<?= $user->user_id ?>">
                <div class="modal-actions">
                    <a class="main-action-bright" onclick=<?= "closeModal('confirmDeleteUserModal-" . $loop . "')" ?>>Cancelar</a>
                    <button type="submit" class="main-action-bright danger" onclick=<?= "closeModal('confirmDeleteUserModal-" . $loop . "')" ?>>Eliminar</button>
                </div>
            </form>
        <?php } ?>

    </div>
</div>