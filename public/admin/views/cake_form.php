<h2><?= $cake ? "Edit cake" : "Add Cake" ?></h2>

<form method="POST" action="actions/save_cake.php">
	<input type="hidden" name="id" value="<?= $cake['CakeID'] ?? '' ?>" >

	<label>Flavor:</label>
	<input type="text" name="flavor" value="<?= htmlspecialchars($cake['Flavor'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
	<datalist id="flavor-options">
		<option value="Chocolate">
		<option value="Vanilla">
		<option value="Red Velvet">
		<option value="Strawberry">
		<option value="Carrot">
	</datalist>
	<br>

	<label>Size:</label>
	<input type="text" name="size" value="<?= $cake['Size'] ?? ''?>" required>
	<br>

	<label>Price:</label>
	<input type="text" name="price" value="<?= $cake['BasePrice'] ?? ''?>" required>
	<br>

	<label>Frosting:</label>
	<input type="text" name="frosting" value="<?= $cake['Frosting'] ?? ''?>" required>
	<datalist id="frosting-options">
		<option value="Chocolate Buttercream">
		<option value="Vanilla Buttercream">
		<option value="Cream Cheese">
		<option value="Whipped Cream">
	</datalist>
	<br>

	<label>Stock:</label>
	<input type="number" name="stock" min="0" step="1" value="<?= $cake['NumInStock'] ?? 0?>" required>

	<button type="submit">Save</button>
</form>
