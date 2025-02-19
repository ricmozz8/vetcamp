<div id="clearLogModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('clearLogModal')"><i class="fas fa-times"></i></span>
        <h2>Clear crash reports?</h2>
        <p>This action can't be reversed.</p>
        <p style="max-width: 500px; margin: 10px auto" class="warning-box">Please delete only if storage issues are present. This operation is only for
        web admins only.</p>
        <form action="/admin/error/clear" method="post">
            <div class="modal-actions">

                <a href="#" onclick="closeModal('clearLogModal')" class="main-action-bright">Cancel</a>
                <button type="submit" class="main-action-bright danger"> <i class="fas fa-broom"></i>Clear</button>

            </div>
        </form>
    </div>
</div>