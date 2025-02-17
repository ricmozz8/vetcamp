<div id="filterApplicationsModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('filterApplicationsModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-filter"></i>
            Filtros
        </h2>


        <form action="">
            <div class="filter-list">





                <div class="filter-group">
                    <label for="order_status">Ordenar por estado</label>
                    <select name="order_status" id="order-select">
                        <option value="">Seleccione una</option>
                        <option value="submitted">Sometida</option>
                        <option value="accepted">Aceptado</option>
                        <option value="denied">Rechazado</option>
                        <option value="waitlist">En lista de espera</option>
                    </select>
                </div>

                <div class="flex-min">
                    <input type="checkbox" name="show_unsubmitted" id="show_unsubmitted">
                    <label for="show_unsubmitted">¿Mostrar solicitudes sin subir?</label>

                </div>


            </div>

            <div class="actions">
                <a class="main-action-bright quaternary" onclick="closeModal('filterApplicationsModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">Aplicar</button>
            </div>
        </form>

    </div>
</div>
