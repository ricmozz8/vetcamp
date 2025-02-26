<div id="filterModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('filterModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-filter"></i>
            Filtros
        </h2>


        <form action="">
            <div class="filter-list">
            <label for="s">Por Estado</label>
                <?php $s = $_GET['s'] ?? 0; ?>
                <?= renderSelect('s',
                    [
                        'Seleccione una',
                        'Activo',
                        'Desactivo'
                    ], (int)$s);?>
                <label for="d">Ordenar por fecha</label>
                <?php $order = $_GET['order'] ?? ''; ?>
                <?= renderSelect('order', ['' => 'Selecciona una', 'asc' => 'Ascendente', 'desc' => 'Descendente'], $order) ?>
                <label for="order">Filtro</label>
                <div class="choice-group">
                    <input type="checkbox" name="order" id="order-select">

                </div>
            </div>

            <div class="actions">

                <a class="main-action-bright quaternary" onclick="closeModal('filterModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">Aplicar</button>
            </div>
        </form>

    </div>
</div>
