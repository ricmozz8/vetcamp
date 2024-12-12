// JavaScript to open and close the modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}

function showModal(modalId) {
    document.getElementById(modalId).style.display = "block";
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