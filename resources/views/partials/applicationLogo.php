<a href="/">
    <div style="display: flex; align-items: center; gap: 5px; cursor: pointer; image-rendering: pixelated;" id="app-logo">
        <img draggable="false" class="app-logotype cs" src="/<?= asset('logo/PNG/cbrsme.png') ?>" alt="Vetcamp Logo">
        <p class="noprint" style="padding: 5px;  color: gray; border-radius: 5px; font-weight: bold;">BETA</p>
    </div>
</a>

<script>
    const appLogo = document.getElementById('app-logo');
    appLogo.addEventListener('contextmenu', event => event.preventDefault());
    appLogo.addEventListener('mousedown', event => {
        if (event.button === 2) {
            window.location.href = '/branding';
        }
    });
</script>