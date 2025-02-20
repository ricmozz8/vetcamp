<div id="logoutModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('logoutModal')"><i class="fas fa-times"></i></span>
        <h2>¿Deseas cerrar la sesión?</h2>
        <div class="modal-details">
            <p>Tendrás que iniciar sesión nuevamente para acceder.</p>
        </div>
        <form action="/logout" method="POST">
            <div class="modal-actions">
                <button type="submit" class="main-action-bright danger"><i class="fas fa-sign-out-alt"></i> Salir</button>
            </div>
        </form>
    </div>
</div>