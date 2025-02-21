<nav class="navbar">

    <div class="nav-bar-island" id="island-border-b">

        <?php require_once('applicationLogo.php'); ?>

        <?php if (Auth::check()): ?>
            <div class="flex no-mobile">
                <p style="text-wrap: nowrap;">¡Hola, <?= Auth::user()->first_name ?>!</p>
                <?php if (Auth::user()->type === 'admin'): ?>
                    <a class="main-action-bright tertiary" href="/admin"><i class="fas fa-cog"></i></a>
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
    </div>
    <script>
        window.addEventListener('scroll', function() {
            const navbarIsland = document.getElementById('island-border-b');
            if (window.scrollY >= 500) {
                navbarIsland.style.borderBottom = 'transparent';
            } else {
                navbarIsland.style.borderBottom = '';
            }
        });
    </script>

</nav>