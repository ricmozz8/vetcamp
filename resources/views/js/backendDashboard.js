// JavaScript for User Section Functionality

// Function to update user information in the sidebar
function updateUserInfo() {
    const userAvatar = document.getElementById('userAvatar');
    const userEmail = document.getElementById('userEmail');

    if (userAvatar && userEmail) {
        userAvatar.textContent = user.avatar;
        userEmail.textContent = user.email;
    }
}

// Call the function when the page loads
document.addEventListener('DOMContentLoaded', updateUserInfo);


// JavaScript for Modal Functionality
const modal = {
    overlay: document.getElementById('popupOverlay'),
    popup: document.getElementById('messagePopup'),
    closeButton: document.getElementById('closePopup'),
    openButton: document.getElementById('openModalButton'),
    approvedButton: document.getElementById('approvedButton'),
    deniedButton: document.getElementById('deniedButton'),
    allButton: document.getElementById('allButton'),
    presetCheckbox: document.getElementById('usePresetMessage'),
    textarea: document.querySelector('.message-textarea'),
    sendButton: document.querySelector('.send-button'),
    dropdownSelect: document.getElementById('sectionDropdown')
};

// Initialize modal state
let modalState = {
    isOpen: false,
    selectedFilter: null,
    usePresetMessage: false
};

// Approved, denied and message for all students preset messages
const presetMessages = {
    approvedButton: "¡Felicidades! Tu solicitud al campamento de verano de la UPRA (Vetcamp) ha sido aprobada.",
    deniedButton: "Lo sentimos, tu solicitud al campamento de verano de la UPRA (Vetcamp) ha sido denegada debido a...",
    allButton: "Saludos estudiantes interesados en el campamento de verano de la UPRA (Vetcamp),..."
};


// Function to open the modal
function openMainMessageModal() {
    modal.overlay.style.display = 'block';
    modal.popup.style.display = 'flex';
    modalState.isOpen = true;
}

// Function to close the modal
function closeMainMessageModal() {
    modal.overlay.style.display = 'none';
    modal.popup.style.display = 'none';
    modalState.isOpen = false;
}

// Function to handle filter button selection
function selectFilter(button) {
// Remove active state from all buttons
[modal.approvedButton, modal.deniedButton, modal.allButton].forEach(btn => {
    btn.style.backgroundColor = '';
    btn.querySelector('.indicator-dot').style.backgroundColor = 'rgba(235, 235, 235, 1)';
    btn.querySelector('.option-text').style.color = 'rgba(129, 129, 129, 1)';
});

// Add active state to selected button
button.querySelector('.indicator-dot').style.backgroundColor = 'rgba(129, 129, 129, 1)';
button.querySelector('.option-text').style.color = 'rgba(0, 0, 0, 1)';

modalState.selectedFilter = button.id;

// Show/hide the section dropdown based on the selected filter
modal.dropdownSelect.style.display = (button.id === 'approvedButton') ? 'flex' : 'none';

updatePresetMessage();
}
// Handles preset message state
function updatePresetMessage() {
    if (modalState.usePresetMessage && modalState.selectedFilter) {
        modal.textarea.value = presetMessages[modalState.selectedFilter];
    } else if (!modalState.usePresetMessage) {
        modal.textarea.value = "";
        modal.textarea.placeholder = "Escriba su mensaje aquí...";
    }
}

// Event Listeners
modal.openButton.addEventListener('click', openMainMessageModal);
modal.closeButton.addEventListener('click', closeMainMessageModal);

// Close modal when clicking overlay
modal.overlay.addEventListener('click', (e) => {
    if (e.target === modal.overlay) {
        closeModal();
    }
});

// Handle filter button clicks
modal.approvedButton.addEventListener('click', () => selectFilter(modal.approvedButton));
modal.deniedButton.addEventListener('click', () => selectFilter(modal.deniedButton));
modal.allButton.addEventListener('click', () => selectFilter(modal.allButton));

// Handle preset message checkbox
modal.presetCheckbox.addEventListener('change', (e) => {
    modalState.usePresetMessage = e.target.checked;
    updatePresetMessage();
});


// Handle send button click
modal.sendButton.addEventListener('click', () => {
    // Validate form
    if (!modalState.selectedFilter) {
        alert('Por favor seleccione una opción...');
        return;
    }
    if (!modal.textarea.value.trim() && !modalState.usePresetMessage) {
        alert('Por favor introduzca un mensaje...');
        return;
    }

    // Where data is sent to the backend
    const formData = {
        filter: modalState.selectedFilter,
        usePresetMessage: modalState.usePresetMessage,
        message: modal.textarea.value,
    };

    console.log('Sending message:', formData);
    // Add API call here

    // Close the modal after sending
    closeModal();
});

// Handle dropdown select
modal.dropdownSelect.addEventListener('click', () => {
    // Create and show dropdown menu
    const dropdownMenu = document.createElement('div');
    dropdownMenu.className = 'dropdown-menu';
    dropdownMenu.innerHTML = `
        <div class="dropdown-item">Sección 1</div>
        <div class="dropdown-item">Sección 2</div>
        <div class="dropdown-item">Sección 3</div>
        <div class="dropdown-item">Sección 4</div>
    `;
    modal.dropdownSelect.appendChild(dropdownMenu);

    // Handle item selection
    dropdownMenu.addEventListener('click', (e) => {
        if (e.target.classList.contains('dropdown-item')) {
            modal.dropdownSelect.querySelector('span').textContent = e.target.textContent;
            dropdownMenu.remove();
        }
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function closeDropdown(e) {
        if (!modal.dropdownSelect.contains(e.target)) {
            dropdownMenu.remove();
            document.removeEventListener('click', closeDropdown);
        }
    });
});