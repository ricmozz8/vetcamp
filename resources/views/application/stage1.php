<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <h1 class="section-head">Vetcamp Verano <?php echo date('Y'); ?></h1>


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


        <form action="" method="POST">
            <div class="form-section">

                    <div class="form-block">
                        <div class="form-group">
                            <label for="birthdate">Fecha de nacimiento</label>
                            <input type="date" id="birthdate" name="birthdate">
                        </div>

                        <div class="form-group">
                            <label for="section">Selecciona la sección que deseas participar</label>
                            <select id="section" name="section">
                                <option value="">Seleccione una</option>
                                <!-- Add more options here -->
                            </select>
                        </div>
                    </div>

                    <h3>Dirección de Escuela de procedencia</h3>

                    <div class="form-block">
                        <div class="form-group">
                            <label for="street">Calle</label>
                            <input type="text" placeholder="123 Main St" name="school_street">
                        </div>

                        <div class="form-group">
                            <label for="city">Ciudad</label>
                            <select name="city" id="school_city">
                                <option value="">Seleccione una ciudad</option>
                                <option value="Adjuntas">Adjuntas</option>
                                <option value="Aguada">Aguada</option>
                                <option value="Aguadilla">Aguadilla</option>
                                <option value="Aguas Buenas">Aguas Buenas</option>
                                <option value="Aibonito">Aibonito</option>
                                <option value="Añasco">Añasco</option>
                                <option value="Arecibo">Arecibo</option>
                                <option value="Arroyo">Arroyo</option>
                                <option value="Barceloneta">Barceloneta</option>
                                <option value="Barranquitas">Barranquitas</option>
                                <option value="Bayamón">Bayamón</option>
                                <option value="Cabo Rojo">Cabo Rojo</option>
                                <option value="Caguas">Caguas</option>
                                <option value="Camuy">Camuy</option>
                                <option value="Canóvanas">Canóvanas</option>
                                <option value="Carolina">Carolina</option>
                                <option value="Cataño">Cataño</option>
                                <option value="Cayey">Cayey</option>
                                <option value="Ceiba">Ceiba</option>
                                <option value="Ciales">Ciales</option>
                                <option value="Cidra">Cidra</option>
                                <option value="Coamo">Coamo</option>
                                <option value="Comerío">Comerío</option>
                                <option value="Corozal">Corozal</option>
                                <option value="Culebra">Culebra</option>
                                <option value="Dorado">Dorado</option>
                                <option value="Fajardo">Fajardo</option>
                                <option value="Florida">Florida</option>
                                <option value="Guánica">Guánica</option>
                                <option value="Guayama">Guayama</option>
                                <option value="Guayanilla">Guayanilla</option>
                                <option value="Guaynabo">Guaynabo</option>
                                <option value="Gurabo">Gurabo</option>
                                <option value="Hatillo">Hatillo</option>
                                <option value="Hormigueros">Hormigueros</option>
                                <option value="Humacao">Humacao</option>
                                <option value="Isabela">Isabela</option>
                                <option value="Jayuya">Jayuya</option>
                                <option value="Juana Díaz">Juana Díaz</option>
                                <option value="Juncos">Juncos</option>
                                <option value="Lajas">Lajas</option>
                                <option value="Lares">Lares</option>
                                <option value="Las Marías">Las Marías</option>
                                <option value="Las Piedras">Las Piedras</option>
                                <option value="Loíza">Loíza</option>
                                <option value="Luquillo">Luquillo</option>
                                <option value="Manatí">Manatí</option>
                                <option value="Maricao">Maricao</option>
                                <option value="Maunabo">Maunabo</option>
                                <option value="Mayagüez">Mayagüez</option>
                                <option value="Moca">Moca</option>
                                <option value="Morovis">Morovis</option>
                                <option value="Naguabo">Naguabo</option>
                                <option value="Naranjito">Naranjito</option>
                                <option value="Orocovis">Orocovis</option>
                                <option value="Patillas">Patillas</option>
                                <option value="Peñuelas">Peñuelas</option>
                                <option value="Ponce">Ponce</option>
                                <option value="Quebradillas">Quebradillas</option>
                                <option value="Rincón">Rincón</option>
                                <option value="Río Grande">Río Grande</option>
                                <option value="Sabana Grande">Sabana Grande</option>
                                <option value="Salinas">Salinas</option>
                                <option value="San Germán">San Germán</option>
                                <option value="San Juan">San Juan</option>
                                <option value="San Lorenzo">San Lorenzo</option>
                                <option value="San Sebastián">San Sebastián</option>
                                <option value="Santa Isabel">Santa Isabel</option>
                                <option value="Toa Alta">Toa Alta</option>
                                <option value="Toa Baja">Toa Baja</option>
                                <option value="Trujillo Alto">Trujillo Alto</option>
                                <option value="Utuado">Utuado</option>
                                <option value="Vega Alta">Vega Alta</option>
                                <option value="Vega Baja">Vega Baja</option>
                                <option value="Vieques">Vieques</option>
                                <option value="Villalba">Villalba</option>
                                <option value="Yabucoa">Yabucoa</option>
                                <option value="Yauco">Yauco</option>
                            </select>
                        </div>

                        <div class="form-group">

                            <label for="zipcode">Código Postal</label>
                            <input type="text" placeholder="0000" name="school_zipcode">
                        </div>

                        <div class="form-group">

                            <label for="schoolType">Tipo de escuela</label>

                            <select name="schoolType">
                                <option value="">Selecciona una</option>
                                <option value="public">Publica</option>
                                <option value="private">Privada</option>
                                <option value="homeschooled">Homeschooled</option>
                                <!-- Add more options here -->
                            </select>
                        </div>
                    </div>
            </div>

            <div class="form-actions">
                <input type="hidden" name="stage" value="2">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button class="main-action-bright  secondary">Siguiente</button>
            </div>
        </form>
    </div>


    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>