<div id="filterModalRequest" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('filterModalRequest')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-filter"></i>
            Filtros
        </h2>


        <form action="">
            <div class="filter-list">

                <label for="order">Por Estado</label>
                <?php
                echo renderSelect('estado', ['Seleccione una', 'Sometida', 'Necesita cambios', 'Aceptado', 'Rechazado', 'Incompleta', 'En lista de espera'], 'Seleccione una');
                ?>
            </div>

            <div class="actions">

                <a class="main-action-bright quaternary" onclick="closeModal('filterModalRequest')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">Aplicar</button>
            </div>
        </form>

    </div>
</div>
