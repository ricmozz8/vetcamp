<div id="filterModalRequest" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('filterModalRequest')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-filter"></i>
            Filtros
        </h2>


        <form action="/admin/requests" method="GET">
            <div class="filter-list">

                <label for="s">Por Estado</label>
                <?php $s = $_GET['s'] ?? 0; ?>
                <?= renderSelect('s',
                    [
                        
                        'Seleccione una',
                        'Sometida',
                        'Necesita cambios',
                        'Aceptado',
                        'Rechazado',
                        'Incompleta',
                        'En lista de espera',
                        'Sin subir',
                    ], (int)$s);?>

                <label for="d">Ordenar por fecha</label>
                <?php $order = $_GET['order'] ?? ''; ?>
                <?= renderSelect('order', ['' => 'Selecciona una', 'asc' => 'Ascendente', 'desc' => 'Descendente'], $order) ?>

                <?php $doc = $_GET['doc'] ?? ''; ?>
                <label for="d">Documentos Subidos</label>
                <?= renderSelect('doc', ['' => 'Selecciona una', 'asc' => 'Ascendente', 'desc' => 'Descendente'], $doc) ?>
            </div>

            <div class="actions">
                <a class="main-action-bright" onclick="closeModal('filterModalRequest')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">Aplicar</button>
            </div>
        </form>

    </div>
</div>
