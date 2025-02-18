let active = false;

function toggleDropdown(dropdown) {
    let element = document.getElementById(dropdown);

    if (active) {
        element.style.display = "none";
        active = false;
        document.removeEventListener('click', handleOutsideClick);
    } else {
        element.style.display = "block";
        active = true;

        setTimeout(() => {
            document.addEventListener('click', handleOutsideClick);
        }, 0); // To ensure this code runs after the current click event
    }

    function handleOutsideClick(event) {
        if (!element.contains(event.target)) {
            element.style.display = "none";
            active = false;
            document.removeEventListener('click', handleOutsideClick);
        }
    }
}

