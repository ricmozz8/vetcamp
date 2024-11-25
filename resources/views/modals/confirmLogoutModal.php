<div id="logoutModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('logoutModal')"><i class="las la-times"></i></span>
        <h2>¿Deseas cerrar la sesión?</h2>
        <div class="modal-details">
            <p>Tendrás que iniciar sesión nuevamente para acceder.</p>
        </div>
        <form action="/logout" method="POST">
            <button class="main-action-bright danger"><i class="las la-sign-out-alt"></i> Salir</button>
        </form>
    </div>
</div>