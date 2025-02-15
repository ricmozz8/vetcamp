document.addEventListener('DOMContentLoaded', () => {
    const submitButtons = document.querySelectorAll('button[type="submit"]');

    submitButtons.forEach(button => {
        button.addEventListener('click', (event) => {

            if (!button.form.checkValidity()) {
                return;
            }

            if (event.defaultPrevented) {
                return;
            }
            const loader = document.createElement('div');
            loader.id = 'loader';
            button.innerHTML = ''; // Clear existing button content
            button.appendChild(loader);
            button.className = 'main-action-bright disabled'; // Replace button classes

        });
    });
});