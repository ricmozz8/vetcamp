<div id=<?= "editCommentModal-" . $loop ?> class="modal">
    <div class="modal-content">
        <span class="close-button" onclick=<?= "closeModal('editCommentModal-" . $loop . "')" ?>><i
                    class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-comment"></i>
            Editar nota
        </h2>
        <form action="/admin/comment/update" method="POST">
            <input type="hidden" name="comment_id" value="<?= $comment->id ?>">
            <input type="hidden" name="application_user" value="<?= $user->user_id ?>">
            <textarea placeholder="<?= $comment->comment ?>" name="comment" required
                      id="comment"><?= $comment->comment ?></textarea>

            <div class="modal-actions">
                <a class="main-action-bright" onclick=<?= "closeModal('editCommentModal-" . $loop . "')" ?>>Cancelar</a>
                <button type="submit" class="main-action-bright primary"
                >Actualizar
                </button>
            </div>
        </form>


    </div>
</div>