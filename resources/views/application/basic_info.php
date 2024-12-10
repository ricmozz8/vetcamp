<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="flex-min left-margin">
        <h1 class="">Vetcamp Verano <?php echo date('Y'); ?></h1>
        <a class="main-action-bright" onclick="openModal('confirmExitApplicationModal')" href="#"><i class="las la-home"></i>Inicio</a>
    </div>


    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress one"></div>
        </div>

        <div class="tabs">
            <span class="tab active">Datos básicos</span>
            <span class="tab">Contacto</span>
            <span class="tab">Documentos</span>
            <span class="tab">Confirmar</span>
        </div>

        <?php
        // dd($application);
        ?>

        <form action="" method="POST">
            <div class="form-section">

                <div class="form-block">
                    <div class="form-group">
                        <label for="birthdate">Fecha de nacimiento</label>
                        <input required type="date" id="birthdate" name="birthdate" value="<?= Auth::user()->birthdate  ?? '' ?>">
                    </div>

                    <div class="form-group">
                        <label for="section">Selecciona la sección que deseas participar</label>
                        <select required id="section" name="section">
                            <option value="">Selecciona una</option>
                            <?php foreach ($sessions as $session) { ?>
                                <option <?php echo $application->id_preferred_session ?? '' == $session->session_id ? 'selected' : '' ?> value="<?= $session->session_id ?>"><?= $session->formatted() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <h3>Dirección de Escuela de procedencia</h3>

                <div class="form-block">
                    <div class="form-group">
                        <label for="street">Calle</label>
                        <input value="<?= isset($school_address) ? $school_address->street : '' ?>" required type="text" placeholder="123 Main St" name="school_street">
                    </div>

                    <div class="form-group">
                        <?php $city = isset($school_address) ? $school_address->city : '' ?>
                        <label for="city">Ciudad</label>
                        <?php require_once 'cityselector.php' ?>
                    </div>

                    <div class="form-group">

                        <label for="zipcode">Código Postal</label>
                        <input value="<?=isset($school_address) ? $school_address->zip_code : '' ?>" required type="number" placeholder="0000" name="school_zipcode">
                    </div>

                    <div class="form-group">

                        <label for="schoolType">Tipo de escuela</label>

                        <select required name="schoolType">
                            <option value="">Selecciona una</option>
                            <?php $school_type = isset($school_address) ? ($school_address->school_type) : '';?>
                            <option <?php  echo $school_type  == 'public' ?  'selected' : '' ?> value="public">Pública</option>
                            <option <?php  echo $school_type  == 'private' ?  'selected' : '' ?> value="private">Privada</option>
                            <option <?php  echo $school_type  == 'homeschooled'  ? 'selected' : '' ?> value="homeschooled">Homeschooled</option>
                            <!-- Add more options here -->
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button class="main-action-bright  secondary">Siguiente</button>
            </div>

        </form>
        <?php require_once(__DIR__ . '../../modals/confirmExitApplicationModal.php'); ?>
    </div>


    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>