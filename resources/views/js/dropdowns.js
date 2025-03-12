let active = false;

function toggleDropdown(dropdown, caret) {
    let element = document.getElementById(dropdown);

    let arrow = document.getElementById(caret);

    if (active) {
        element.style.display = "none";
        active = false;
        document.removeEventListener('click', handleOutsideClick);
        arrow.classList.remove('fa-caret-up');
        arrow.classList.add('fa-caret-down');
    } else {
        element.style.display = "block";
        active = true;
        arrow.classList.remove('fa-caret-down');
        arrow.classList.add('fa-caret-up');

        setTimeout(() => {
            document.addEventListener('click', handleOutsideClick);
        }, 0); // To ensure this code runs after the current click event
    }

    function handleOutsideClick(event) {
        if (!element.contains(event.target)) {
            element.style.display = "none";
            active = false;
            document.removeEventListener('click', handleOutsideClick);
            arrow.classList.remove('fa-caret-up');
            arrow.classList.add('fa-caret-down');
        }
    }
}

