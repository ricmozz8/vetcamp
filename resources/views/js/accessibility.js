document.addEventListener('DOMContentLoaded', function () {
    let icon = document.getElementById('icon-contrast');
    let icon2 = document.getElementById('icon-read');

    // Manage cookies and body classes on load
    let isReadable = document.cookie.includes('setReadable=true');
    let isContrasted = document.cookie.includes('setContrasted=true');

    if (isReadable) {
        document.body.classList.add('readable');
        icon2?.classList.add('active');
    } else {
        document.body.classList.remove('readable');
        icon2?.classList.remove('active');
    }

    if (isContrasted) {
        document.body.classList.add('contrasted');
        icon?.classList.add('active');
    } else {
        document.body.classList.remove('contrasted');
        icon?.classList.remove('active');
    }

    // Add event listener to buttons
    icon?.addEventListener('click', function () {
        let currentState = document.cookie.includes('setContrasted=true');
        document.cookie = `setContrasted=${!currentState}; path=/`;
        document.body.classList.toggle('contrasted', !currentState);
        icon.classList.toggle('active', !currentState);
    });

    icon2?.addEventListener('click', function () {
        let currentState = document.cookie.includes('setReadable=true');
        document.cookie = `setReadable=${!currentState}; path=/`;
        document.body.classList.toggle('readable', !currentState);
        icon2.classList.toggle('active', !currentState);
    });
});