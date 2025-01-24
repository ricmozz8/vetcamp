<header class="navbar">

    <?php require_once('applicationLogo.php'); ?>

    <?php if (Auth::check()): ?>
        <div class="flex no-mobile">
            <p style="text-wrap: nowrap;">¡Hola <?= Auth::user()->first_name ?>!</p>
            <?php if (Auth::user()->type === 'admin'): ?>
                <a class="main-action-bright tertiary" href="/admin">Panel de Administrador</a>
            <?php else: ?>
                <a class="main-action-bright tertiary" href="/apply">¡Solicita!</a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="flex no-mobile">
            <a class="main-action-bright no-deco-action" href="/login">Inicia Sesión</a>
            <a class="main-action-bright tertiary" href="/register">Regístrate</a>
        </div>
    <?php endif; ?>
</header>