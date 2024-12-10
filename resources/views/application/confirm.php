<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="section-head">
        <h1>Vetcamp Verano <?php echo date('Y'); ?></h1>
        <a href="/apply/application/documents" class="main-action-bright"><i class="las la-arrow-left"></i>Atrás</a>
    </div>



    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress four"></div>
        </div>

        <div class="tabs">
            <span class="tab">Datos básicos</span>
            <span class="tab ">Contacto</span>
            <span class="tab ">Documentos</span>
            <span class="tab active">Confirmar</span>
        </div>


        <form action="" method="POST">
            <!-- Confirmation info -->

            <div class="desk-grid">

                <div class="grid-group">
                    <h3>Contacto</h3>
                    <div class="form-group">
                        <label for="first_name">Nombre</label>
                        <p><?= Auth::user()->first_name ?? '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Apellido</label>
                        <p><?= Auth::user()->last_name ?? '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo</label>
                        <p><?= Auth::user()->email ?? '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <p><?= format_phone(Auth::user()->phone_number) ?? '' ?></p>
                    </div>
                </div>


                <div class="grid-group">
                    <h3>Direcciones</h3>
                    <div class="form-group">
                        <label for="postal">Dirección de la escuela</label>
                        <?php
                        if (Auth::user()->school_address()) {
                            $fullPostal = Auth::user()->school_address()->build();
                        }
                        ?>
                        <p><?= $fullPostal ?? '' ?></p>
                    </div>
                    <div class="form-group">
                        <label for="postal">Dirección postal</label>
                        <?php
                        if (Auth::user()->postal_address()) {
                            $fullPostal = Auth::user()->postal_address()->build();
                        }
                        ?>
                        <p><?= $fullPostal ?? '' ?></p>
                    </div>

                    <div class="form-group">
                        <label for="postal">Dirección física</label>
                        <?php
                        if (Auth::user()->physical_address()) {
                            $fullPostal = Auth::user()->physical_address()->build();
                        }
                        ?>
                        <p><?= $fullPostal ?? '' ?></p>
                    </div>
                </div>
                <div class="grid-group">
                <h3>Campamento</h3>
                <div class="form-group">
                    <label for="postal">Sesión preferida</label>
                    <p><?= Auth::user()->application()->preferred_session(true) ?? '' ?>
                   
                </p>
                </div>
              




            </div>

            <div class="form-actions">
                <input type="hidden" name="stage" value="confirm">
                
                <button class="main-action-bright ">
                <i class="las la-arrow-right"></i>    
                Someter</button>
            </div>
        </form>
    </div>




    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>