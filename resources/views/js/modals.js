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

function openEnrollModal(modalId, session) {
  document.getElementById(modalId).style.display = "flex";
  window.scrollTo(0, 0);
  // hide scroll
  document.body.style.overflow = "hidden";

  let sessionInput = document.getElementById("session");
  sessionInput.value = session;
}

/**
 * Initializes modal click-to-close functionality.
 * Closes the modal when clicking outside its content.
 */
window.onload = function () {
  let allModals = document.querySelectorAll(".modal");
  allModals.forEach((modal) => {
    modal.addEventListener("click", function (e) {
      if (e.target === this) {
        this.style.display = "none";
        document.body.style.overflow = "auto";
      }
    });
  });

  let termsModal = document.getElementById("terms-modal");
  if (!document.cookie.includes("accepted-terms=true")) {
    termsModal.style.display = "flex";
    document.cookie = "accepted-terms=true; path=/";
  }
};


function setTermsAccepted() {
  document.cookie = "accepted-terms=true; path=/";
  let termsModal = document.getElementById("terms-modal");
  termsModal.style.display = "none";
}