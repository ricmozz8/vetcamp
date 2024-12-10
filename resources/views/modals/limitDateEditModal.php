<!-- Main popup container with the form -->
<div class="message-popup" id="limitDateEditModal" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('limitDateEditModal')"><i class="las la-times"></i></a>


    <!-- Popup title -->
    <h2 class="message-title">Manejar fechas límite</h2>
    <br>
    <h3> Establezca las fechas límite para registrarse al campamento. </h3>



    <form action="settings/e/dates" style="width: 100%;" method="POST">
        <!-- Main modal area -->
        <div class="session-modal-area">
            <!-- Session modification area -->
            <div class="session-modal-edit-area">

                <!-- Individual line area -->
                <div class="session-modal-dates">
                    <label for="startDate">Inicio:</label>
                    <input value="<?= $limit_dates->start_date ?>" class="session-edit-input" type="date" name="startDate" />

                    <label for="endDate">Cierre:</label>
                    <input value="<?= $limit_dates->end_date ?>" class="session-edit-input" type="date" name="endDate" />
                </div>

            </div>
        </div>

        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <a href="#" class="primary main-action-bright" onclick="closeModal('limitDateEditModal')">Cancelar</a>

            <!-- Save button -->
            <button class="secondary main-action-bright" onclick="closeModal('limitDateEditModal')">Guardar</button>
        </div>
    </form>

</div>