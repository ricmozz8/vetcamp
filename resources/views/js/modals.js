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


/**
 * Initializes modal click-to-close functionality.
 * Closes the modal when clicking outside its content.
 */
window.onload = function () {
    let allModals = document.querySelectorAll(".modal");
    allModals.forEach(modal => {
        modal.addEventListener("click", function (e) {
            if (e.target === this) {
                this.style.display = "none";
                document.body.style.overflow = "auto";
            }
        });
    });
};