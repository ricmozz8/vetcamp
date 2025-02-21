<div class="profile-dropdown profile-drop " id="profile-drop">

    <?php if (Auth::user()->type !== 'admin') { ?>
        <a href="/apply" class="">
            <i class="fas fa-clipboard"></i>
            Solicitud
        </a>
    <?php } else { ?>
        <a href="/admin" class="">
            <i class="fas fa-cog"></i>
            Administración
        </a>
    <?php } ?>

    <a href="/profile" class="">
        <i class="fas fa-user"></i>
        Mi cuenta
    </a>
    <a onclick="openModal('logoutModal')" href="#" class="nav-danger">
        <i class="fas fa-sign-out-alt"></i>
        Salir
    </a>

</div>