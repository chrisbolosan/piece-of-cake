<html>
<div class="product-container">

    <div class="product-image">
        <img src="<?=htmlspecialchars($cake['Img'])?>" alt="<?=htmlspecialchars($cake['Flavor'])?>">
    </div>

    <div class="product-details">
        <h2><?=htmlspecialchars($cake['Flavor'])?> Cake</h2>
        <p><strong>Size:</strong> <?=htmlspecialchars($cake['Size'])?></p>

        <h3>$<?=number_format((float)$cake['BasePrice'],2)?></h3>
		<p><strong>In Stock:</strong> <?= $cake['NumInStock'] ?></p>

	<?php if ($cake['NumInStock'] > 0): ?>
	<form method="post" action="index.php?page=cart&action=add">
		<input type="hidden" name="product_id" value="<?= $cake['CakeID'] ?>">

		<label>Quantity:</label><br>
		<input type="number" name="quantity" value="1" min="1", max="<?= $cake['NumInStock'] ?>"><br><br>

		<button type="submit">Add to Cart</button>
	</form>
	<?php else: ?>
		<div>
			Sorry, this cake is currently unavailable.
		</div>
	<?php endif; ?>

    </div>
</div>
</html>
