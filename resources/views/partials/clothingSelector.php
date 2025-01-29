<select required id="shirtsize" name="shirtsize">
    <option value="">Selecciona una</option>
    <option <?php if ($shirt_size === "XXS") {
                echo 'selected';
            } ?> value="XXS">XXS</option>
    <option <?php if ($shirt_size === "XS") {
                echo 'selected';
            } ?> value="XS">XS</option>
    <option <?php if ($shirt_size === "S") {
                echo 'selected';
            } ?> value="S">S</option>
    <option <?php if ($shirt_size === "M") {
                echo 'selected';
            } ?> value="M">M</option>
    <option <?php if ($shirt_size === "L") {
                echo 'selected';
            } ?> value="L">L</option>
    <option <?php if ($shirt_size === "XL") {
                echo 'selected';
            } ?> value="XL">XL</option>
    <option <?php if ($shirt_size === "XXL") {
                echo 'selected';
            } ?> value="XXL">XXL</option>
    <option <?php if ($shirt_size === "XXXL") {
                echo 'selected';
            } ?> value="XXXL">XXXL</option>
</select>