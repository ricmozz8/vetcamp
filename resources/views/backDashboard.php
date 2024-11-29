<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';

// greeting personalizer by time of day (SPANISH-PR)


$hour = date('G');
if ($hour >= 5 && $hour < 12) {
    $greeting = 'Buenos días';
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = 'Buenas tardes';
} else {
    $greeting = 'Buenas noches';
}
?>

<body>
    <!-- Main dashboard container -->
    <div class="back-dash">


        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


        <!-- Main content area -->
        <div class="main-content">

            <a onclick="openModal('sidebar')" href="#" class="openSidebar">
                <i class="las la-bars">
                </i>
            </a>

            <!-- Header with welcome message and action button -->
            <header class="header">

                <h1 class="welcome"><?= $greeting ?>, <?= Auth::user()->first_name ?></h1>
                <button class="main-action-bright" id="openModalButton">
                    <i class="las la-envelope"></i>
                    Enviar mensaje
                </button>
            </header>


            <!-- Statistics grid section -->
            <div class="stats-grid">
                <!-- Applicants stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">
                            <i class="las la-id-badge"></i>
                            Solicitantes
                        </h2>

                    </div>
                    <div class="stat-number"><?php echo $all_applicants; ?></div>

                </div>

                <!-- Registered users stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">
                            <i class="las la-user-friends"></i>
                            Registrados

                        </h2>

                    </div>
                    <div class="stat-number"><?php echo $all_users; ?></div>

                </div>
            </div>

            <!-- Recent activity section -->
            <div class="stats-grid">

                <!-- Recent applications card -->
                <div class="stat-card">
                    <h2 class="stat-title">Solicitudes más recientes</h2>
                    <br>

                    <div class="recent-list">
                        <?php
                        foreach ($recent_applications as $application) {
                            // Get the full name
                            $full_name = htmlspecialchars($application->first_name . ' ' . $application->last_name . ' ');

                            echo "<div class='recent-application'>";
                            echo "<img src=" . htmlspecialchars($application->application()->url_picture) . " alt='Profile Picture' class='avatar';>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($application->email) . "</td>";
                            echo "</div>";
                        }
                        ?>
                    </div>

                    <div class="button-container">
                        <a href="/admin/requests" class="secondary main-action-bright">Ver todos</a>
                    </div>
                </div>

                <!-- Recent registrations card -->
                <div class="stat-card">
                    <h2 class="stat-title">Registros Recientes</h2>
                    <br>

                    <div class="recent-list">
                        <?php foreach ($recent_registered as $user): ?>
                            <div class="recent-registered">
                                <span class="recent-email"><?php echo $user->email; ?></span>
                                <span class="time-stamp"><?php echo $user->created_at; ?></span> <!-- Will update soon... $user->formatted_created_at -->
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="button-container">
                        <a href="/admin/registered" class="secondary main-action-bright">Ver todos</a>
                    </div>
                </div>
            </div>

            <!-- Modal Popup -->
            <!-- The overlay provides a semi-transparent dark background behind the popup -->
            <div class="popup-overlay" id="popupOverlay" style="display: none"></div>

            <!-- Main popup container with the form -->

            <div class="message-popup" id="messagePopup" style="display: none">
                <!-- Close button in the top-right corner -->
                <a href="#" class="plain-action" id="closePopup"><i class="las la-times"></i></a>

                <!-- Popup title -->
                <h2 class="message-title">Enviar mensaje</h2>

                <!-- Message filter options -->
                <div class="message-options">
                    <!-- Filter buttons for different message states -->
                    <button id="approvedButton" class="option-button">
                        <div class="option-indicator">
                            <div class="indicator-dot"></div>
                        </div>
                        <span class="option-text">Aprobados</span>
                    </button>
                    <button class="option-button" id="deniedButton">
                        <div class="option-indicator">
                            <div class="indicator-dot"></div>
                        </div>
                        <span class="option-text">Denegados</span>
                    </button>
                    <button class="option-button" id="allButton">
                        <div class="option-indicator">
                            <div class="indicator-dot"></div>
                        </div>
                        <span class="option-text">Todos</span>
                    </button>


                    <select class="form-rounded" name="section" id="sectionDropdown" style="display: none;">
                        <option value="">Seleccione una sección</option>
                        <option value="1">Sección 1</option>
                        <option value="2">Sección 2</option>
                        <option value="3">Sección 3</option>
                        <option value="4">Sección 4</option>
                    </select>
                </div>

                <!-- Preset message option -->
                <label class="preset-message">
                    <input type="checkbox" class="preset-checkbox" id="usePresetMessage">
                    <span>Utilizar Mensajes Predefinidos</span>
                </label>

                <!-- Message input area -->
                <textarea class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"></textarea>

                <!-- Send button -->
                <button class="secondary main-action-bright" id="sendButton">Enviar</button>
            </div>
        </div>
    </div>

    <script>
        // JavaScript for User Section Functionality
        console.warn('hola');

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
        <div class="dropdown-item">Sección 4</div> `;
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
    </script>


    <?php require_once('partials/footer.php'); ?>

</body>

</html>