<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/profileNav.php'); ?>


    <div class=" application_header">
        <h1 class="">Solicitud</h1>
        <a href="/apply/application/basic_info" class="main-action-bright secondary"><i class="las la-arrow-left"></i>Atrás</a>
    </div>



    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress two"></div>
        </div>

        <div class="tabs">
            <a href="/apply/application/basic_info" class="tab">Datos básicos</a>
            <a href="/apply/application/contact" class="tab active">Contacto</a>
            <a href="/apply/application/documents" class="tab">Documentos</a>
            <a href="/apply/application/confirm" class="tab">Confirmar</a>
        </div>


        <form action="" method="POST">
            <!-- ---------------------------- PHYSICAL ADDRESS ------------------------------ -->
            <div class="form-section">
                <h3>Dirección Física</h3>
                <div class="form-block">
                    <div class="form-group">
                        <label for="aline1">Línea 1</label>
                        <input required value="<?= isset($physical_address) ? $physical_address->aline1 : ''  ?>" type="text" id="physical_aline1" name="physical_aline1">
                    </div>
                    <div class="form-group">
                        <label for="aline1">Línea 2</label>
                        <input value="<?= isset($physical_address) ? $physical_address->aline2 : ''  ?>" 
                        type="text" id="physical_aline1" name="physical_aline2">
                        
                    </div>
                    <div class="form-group">
                        <label for="city">Ciudad</label>
                        <?php $city = isset($physical_address) ? $physical_address->city : '';
                        $citylabel = 'physical_city'  ?>
                        <?php require 'cityselector.php' ?>
                    </div>
                    <div class="form-group">
                        <label for="postal_zip">Código Postal</label>
                        <input required value="<?= isset($physical_address) ? $physical_address->zip_code : ''  ?>" 
                        type="text" id="physical_zip" name="physical_zip">
                        <?php $inputName = 'physical_zip';
                        include 'formInputError.php'
                        ?>
                    </div>

                </div>
                <!-- ---------------------------- POSTAL ADDRESS ------------------------------ -->
                <div class="check">
                    <h3>Dirección Postal</h3>
                    
                </div>

                <div class="form-block">
                    <div class="form-group">
                        <label for="aline1">Línea 1</label>
                        <input required value="<?= isset($postal_address) ? $postal_address->aline1 : '' ?>"
                            type="text" id="postal_aline1" name="postal_aline1">
                        <?php $inputName = 'postal_aline_1';
                        require 'formInputError.php'
                        ?>
                    </div>
                    <div class="form-group">
                        <label for="aline1">Línea 2</label>
                        <input value="<?= isset($postal_address) ? $postal_address->aline2 : '' ?>"
                            type="text" id="postal_aline1" name="postal_aline2">
                        <?php $inputName = 'postal_aline_2';
                        require 'formInputError.php'
                        ?>
                    </div>
                    <div class="form-group">

                        <label for="postal_city">Ciudad</label>
                        <?php $city =isset($postal_address) ? $postal_address->city : '';
                        $citylabel = 'postal_city'; ?>
                        <?php include 'cityselector.php' ?>
                    </div>
                    <div class="form-group">
                        <label for="postal_zip">Código Postal</label>
                        <input required value="<?= isset($postal_address) ? $postal_address->zip_code : '' ?>"
                            type="text" id="postal_zip" name="postal_zip">
                        <?php $inputName = 'postal_zip';
                        require 'formInputError.php'
                        ?>
                    </div>

                </div>

            </div>

            <div class="form-actions">
                <p>Se guardará la información una vez pulses siguiente.</p>
                <button type="submit" class="main-action-bright gradiented">Siguiente</button>
            </div>
        </form>
    </div>


    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>