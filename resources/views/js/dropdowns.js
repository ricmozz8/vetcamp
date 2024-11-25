let active = false;
function toggleDropdown(dropdown) {
    let element = document.getElementById(dropdown);

    if (active) {
        element.style.display = "none";
        active = false;
    } else {
        element.style.display = "block";
        active = true;
    }
}

