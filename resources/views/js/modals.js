// JavaScript to open and close the modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
    window.scrollTo(0, 0);
    // hide scroll
    document.body.style.overflow = "hidden";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
    document.body.style.overflow = "auto";
}

function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
    window.scrollTo(0, 0);
    // hide scroll
    document.body.style.overflow = "hidden";
}


function handleResize() {
    if (window.matchMedia("(min-width: 768px)").matches) {
        sidebar.style.display = "flex";
    } else {
        sidebar.style.display = "none";
    }
}

window.addEventListener("resize", handleResize);

// Initial check
handleResize();