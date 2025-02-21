<?php
$physical_address = Auth::user()->physical_address();
?>
<div id="physicalEditModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('physicalEditModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-home"></i>
            Editar dirección física
        </h2>


        <form action="/profile/physical/update" method="POST">
            <div class="form-group">
                <label for="physical_aline1">Línea de calle 1</label>
                <input type="text" name="physical_aline1" id="physical_aline1" value="<?= $physical_address->aline1 ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="physical_aline2">Línea de calle 2</label>
                <input type="text" name="physical_aline2" id="physical_aline2" value="<?= $physical_address->aline2 ?? '' ?>">
            </div>
            <?php
                $city = $physical_address->city ?? '';
                $citylabel = 'physical_city';
                require __DIR__ . '/../application/cityselector.php';
            ?>
            <div class="form-group">
                <label for="physical_zip">Código postal</label>
                <input type="number" name="physical_zip" id="physical_zip" value="<?= $physical_address->zip_code ?? '' ?>" required>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('physicalEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> <i class="fas fa-save"></i> Guardar</button>

            </div>
        </form>


    </div>
</div>