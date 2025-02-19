<div id=<?= "deleteCommentModal-" . $loop ?> class="modal">
    <div class="modal-content">
        <span class="close-button" onclick=<?= "closeModal('deleteCommentModal-" . $loop . "')" ?>><i
                    class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-trash"></i>
            Eliminar nota
        </h2>
        <p>¿Seguro que quieres borrar esta nota?</p>

        <form action="/admin/comment/delete" method="POST">
            <input type="hidden" name="comment_id" value="<?= $comment->id ?>">
            <input type="hidden" name="application_user" value="<?= $user->user_id ?>">


            <div class="modal-actions">
                <a class="main-action-bright"
                   onclick=<?= "closeModal('deleteCommentModal-" . $loop . "')" ?>>Cancelar</a>
                <button type="submit" class="main-action-bright danger">Eliminar
                </button>
            </div>
        </form>


    </div>
</div>