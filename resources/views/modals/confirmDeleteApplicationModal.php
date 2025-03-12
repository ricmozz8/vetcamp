<div id=<?= "confirmDeleteApplicationModal-" . $loop ?> class="modal">
    <div class="modal-content">
        <span class="close-button"
              onclick="closeModal('confirmDeleteUserModal-<?= $loop ?>')"><i
                    class="las la-times"></i></span>
        <h2>
            <i class="las la-user"></i>
            Eliminar solicitud
        </h2>
        <p>¿Seguro que quieres borrar esta solicitud? Se perderán todos los datos</p>


        <form action="/admin/delete/application" method="POST">

            <input type="hidden" name="application_id" value="<?= $application->id_application ?>">

        <div class="modal-actions">
                <a class="main-action-bright"
                   onclick=<?= "closeModal('confirmDeleteApplicationModal-" . $loop . "')" ?>>Cancelar</a>
                <button type="submit" class="main-action-bright danger"
                        onclick=<?= "closeModal('confirmDeleteApplicationModal-" . $loop . "')" ?>>Eliminar
                </button>
            </div>
        </form>

    </div>
</div>