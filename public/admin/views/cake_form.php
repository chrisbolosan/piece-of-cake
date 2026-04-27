<h2><?= $cake ? "Edit cake" : "Add Cake" ?></h2>

<form method="POST" action="actions/save_cake.php">
	<input type="hidden" name="id" value="<?= $cake['CakeID'] ?? '' ?>" >

	<label>Flavor:</label>
	<input type="text" name="flavor" list="flavor-options" value="<?= htmlspecialchars($cake['Flavor'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
	<datalist id="flavor-options">
		<option value="Chocolate">
		<option value="Vanilla">
		<option value="Red Velvet">
		<option value="Strawberry">
		<option value="Carrot">
	</datalist>
	<br>
	<br>

	<label>Size:</label>
	<br>

	<select name="size" required>
		<option value="" disabled <?= !isset($cake['Size']) ? 'selected' : '' ?>> Select Size </option>
		<?php
		$sizes = ['6-inch', '8-inch', '10-inch', '12-inch'];
		foreach ($sizes as $s) {
			$selected = (isset($cake['Size']) && $cake['Size'] == $s) ? 'selected' : '';
			echo "<option value=\"$s\" $selected>$s</option>";
		}
		?>
	</select>
	<br>
	<br>

	<label>Price:</label>
	<input type="number" name="price" step="0.01" placeholder="0.00" min="0" value="<?= $cake['BasePrice'] ?? ''?>" required>
	<br>
	<br>

	<label>Frosting:</label>
	<input type="text" name="frosting" list="frosting-options" value="<?= $cake['Frosting'] ?? ''?>" required>
	<datalist id="frosting-options">
		<option value="Chocolate Buttercream">
		<option value="Vanilla Buttercream">
		<option value="Cream Cheese">
		<option value="Whipped Cream">
	</datalist>
	<br>
	<br>

	<label>Stock:</label>
	<input type="number" name="stock" min="0" step="1" value="<?= $cake['NumInStock'] ?? 0?>" required>
	<!-- image -->
	<label> Current Image:</label>
	<img src="../<?= $cake['Img'] ?? 'images/comingsoon.png' ?>" alt="cake image" width="100" style="border-radius: 5px; margin-bottom: 10px;"/>
	<input type="hidden" name="img" value="<?= $cake['Img'] ?? 'images/comingsoon.png' ?>">  
	<button type="submit">Save</button>
</form>
