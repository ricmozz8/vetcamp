<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class=" section-head">
    <h1 class="">Vetcamp Verano <?php echo date('Y'); ?></h1>
    <form action="" method="POST">
        <input type="hidden" name="stage" value="1">
        <button class="main-action-bright"><i class="las la-arrow-left"></i></button>
    </form>
    </div>
    


    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress two"></div>
        </div>

        <div class="tabs">
            <span class="tab">Datos básicos</span>
            <span class="tab active">Contacto</span>
            <span class="tab">Documentos</span>
            <span class="tab">Confirmar</span>
        </div>


        <form action="" method="POST">
            <div class="form-section">
                    <h3>Dirección Física</h3>
                    <div class="form-block">
                        <div class="form-group">
                            <label for="aline1">Línea 1</label>
                            <input type="text" id="postal_aline1" name="postal_address_line_1">
                        </div>
                        <div class="form-group">
                            <label for="aline1">Línea 2</label>
                            <input type="text" id="postal_aline1" name="postal_address_line_1">
                        </div>
                        <div class="form-group">
                            <label for="postal_city">Ciudad</label>
                            <select name="postal_city" id="postal_city">
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
                            <label for="postal_zip">Código Postal</label>
                            <input type="text" id="postal_zip" name="postal_zip">
                        </div>

                    </div>

                    <div class="flex">
                    <h3>Dirección Postal</h3>
                    <div class="check">
                        
                        <input type="checkbox" name="same_as_physical" id="same_as_physical">
                        <label for="same_as_physical">Igual a Dirección Física</label>
                    </div>
                        
                    </div>
                    
                    <div class="form-block">
                        <div class="form-group">
                            <label for="aline1">Línea 1</label>
                            <input type="text" id="physical_aline1" name="physical_address_line_1">
                        </div>
                        <div class="form-group">
                            <label for="aline1">Línea 2</label>
                            <input type="text" id="physical_aline1" name="physical_address_line_1">
                        </div>
                        <div class="form-group">
                            <label for="physical_city">Ciudad</label>
                            <select name="physical_city" id="physical_city">
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
                            <label for="postal_zip">Código Postal</label>
                            <input type="text" id="physical_zip" name="physical_zip">
                        </div>

                    </div>
                    

                   
            </div>

            <div class="form-actions">
                <input type="hidden" name="stage" value="3">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button class="main-action-bright  secondary">Siguiente</button>
            </div>
        </form>
    </div>


    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>