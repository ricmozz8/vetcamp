<?php
$school_address = Auth::user()->school_address();
?>
<div id="schoolEditModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('schoolEditModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-school"></i>
            Editar dirección de la escuela
        </h2>


        <form action="/profile/school/update" method="POST">
            <div class="form-group">
                <label for="school_aline1">Línea de calle 1</label>
                <input type="text" name="school_aline1" id="school_aline1" value="<?= $school_address->street ?? '' ?>"
                       required>
            </div>
            <div class="form-group">
                <label for="postal_city">Ciudad</label>
                <?php
                $city = $school_address->city ?? '';
                $citylabel = 'school_city';
                require __DIR__ . '/../application/cityselector.php';
                ?>
            </div>
            <div class="form-group">
                <label for="school_zip">Código postal</label>
                <input type="number" name="school_zip" id="school_zip" value="<?= $school_address->zip_code ?? '' ?>"
                       required>
            </div>

            <div class="form-group">
                <label for="schoolType">Tipo de escuela</label>
                <select required name="schoolType">
                    <option value="">Selecciona una</option>
                    <?php $school_type = isset($school_address) ? ($school_address->school_type) : ''; ?>
                    <option <?php echo $school_type == 'public' ? 'selected' : '' ?> value="public">Pública</option>
                    <option <?php echo $school_type == 'private' ? 'selected' : '' ?> value="private">Privada
                    </option>
                    <option <?php echo $school_type == 'homeschooled' ? 'selected' : '' ?> value="homeschooled">
                        Homeschooled
                    </option>
                    <!-- Add more options here -->
                </select>
            </div>


            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('schoolEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"><i class="fas fa-save"></i> Guardar</button>

            </div>
        </form>


    </div>
</div>