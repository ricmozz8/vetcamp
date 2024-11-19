// JavaScript to open and close the modal
function openModal(modalId) {
    document.getElementById(modalId).style.display = "flex";
}

function closeModal(modalId) {
    document.getElementById(modalId).style.display = "none";
}


/* may be deleted
let currentModal = null;

function openOverlay(modalId) {
    document.getElementById("popupOverlay").style.display = "block";
    currentModal = modalId;
}

function closeOverlay() {
    document.getElementById("popupOverlay").style.display = "none";
    document.getElementById(currentModal).style.display = "none";
}*/