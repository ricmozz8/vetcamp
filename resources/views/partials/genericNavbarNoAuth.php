<nav class="navbar">

    <div class="nav-bar-island" id="island-border-b">

        <?php require_once('applicationLogo.php'); ?>
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