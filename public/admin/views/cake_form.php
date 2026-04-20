<h2><?= $cake ? "Edit cake" : "Add Cake" ?></h2>

<form method="POST" action="actions/save_cake.php">
	<input type="hidden" name="id" value="<?= $cake['CakeID'] ?? '' ?>">

	<label>Flavor:</label>
	<input type="text" name="flavor" value="<?= $cake['Flavor'] ?? ''?>">
	<br>

	<label>Size:</label>
	<input type="text" name="size" value="<?= $cake['Size'] ?? ''?>">
	<br>

	<label>Price:</label>
	<input type="text" name="price" value="<?= $cake['BasePrice'] ?? ''?>">
	<br>

	<label>Frosting:</label>
	<input type="" name="frosting" value="<?= $cake['Frosting'] ?? ''?>">
	<br>

	<label>Stock:</label>
	<input type="number" name="stock" min="0" step="1" value="<?= $cake['NumInStock'] ?? 0?>">

	<button type="submit">Save</button>
</form>
