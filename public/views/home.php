<div class="grid">

<?php if (!empty($error)): ?>
	<p>Error: <?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<?php foreach ($cakes as $row): ?>
	<?php
		$name  = htmlspecialchars($row['Flavor'] . " Cake");
		$price = number_format((float)$row['BasePrice'], 2);
		$img   = htmlspecialchars($row['Img']);
		$size  = htmlspecialchars($row['Size']);
		$stock = (int)$row['NumInStock'];
		$id    = (int)$row['CakeID'];
	?>

	<div class="card">

		<img src="<?= $img ?>" alt="<?= $name ?>" style="width:100%; height:200px; object-fit:cover;">

		<h3><?= $name ?></h3>

		<p> <strong>Price: $<?= $price ?></strong></p>
		<small>(<?= $size ?>)</small>

		<?php if ($stock <= 0): ?>
			<p style="color:red;"><strong>Out of Stock</strong></p>
		<?php else: ?>
			<p style="color:green;">In Stock (<?= $stock ?> left)</p>
		<?php endif; ?>

		<a href="index.php?page=product&id=<?= $id ?>">View Details</a>

	</div>

<?php endforeach; ?>

</div>
