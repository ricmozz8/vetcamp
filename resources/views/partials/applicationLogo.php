<div style="display: flex; align-items: center; gap: 5px; cursor: pointer;" id="app-logo">
<img draggable="false" class="app-logotype" src="/<?= asset('logo/SVG/vetcamp-full-black.svg') ?>" alt="Vetcamp Logo">
<p style="padding: 5px; background-color: #000; color: #fff; border-radius: 5px; font-weight: bold;">BETA</p>
</div>

<script>
    const appLogo = document.getElementById('app-logo');
    appLogo.addEventListener('contextmenu', event => event.preventDefault());
    appLogo.addEventListener('mousedown', event => {
        if (event.button === 2) {
            window.location.href = '/branding';
        }
    });
</script>

