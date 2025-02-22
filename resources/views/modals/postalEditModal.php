<?php
$postal_address = Auth::user()->postal_address();
?>
<div id="postalEditModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('postalEditModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-envelope"></i>
            Editar dirección postal
        </h2>


        <form action="/profile/postal/update" method="POST">
            <div class="form-group">
                <label for="postal_aline1">Línea de calle 1</label>
                <input type="text" name="postal_aline1" id="postal_aline1" value="<?= $postal_address->aline1 ?? '' ?>" required>
            </div>
            <div class="form-group">
                <label for="postal_aline2">Línea de calle 2</label>
                <input type="text" name="postal_aline2" id="postal_aline2" value="<?= $postal_address->aline2 ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="postal_city">Ciudad</label>
            <?php
            $city = $postal_address->city ?? '';
            $citylabel = 'postal_city';
            require __DIR__ . '/../application/cityselector.php';
            ?>
            </div>
            <div class="form-group">
                <label for="postal_zip">Código postal</label>
                <input type="number" name="postal_zip" id="postal_zip" value="<?= $postal_address->zip_code ?? '' ?>" required>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('postalEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> <i class="fas fa-save"></i> Guardar</button>

            </div>
        </form>


    </div>
</div>