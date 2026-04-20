<h1>Piece of Cake</h1>

<div class="grid">
<?php
try {
	$prepared = $pdo->query("SELECT * FROM CAKE");

	while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
		$name    = htmlspecialchars($row['Flavor'] . " Cake");
		$price   = htmlspecialchars($row['BasePrice']);
		$img     = htmlspecialchars($row['Img']); 
		$size    = htmlspecialchars($row['Size']);
		$stock   = (int)$row['NumInStock'];
		$id      = htmlspecialchars($row['CakeID']);

		echo "<div class='card'>";
			echo "<div class='card-img-container'>";
				echo "<img src='images/$img' alt='$name' style='width:100%; border-radius:5px;'>";
			echo "</div>";

			echo "<h3>$name</h3>";
			echo "<p class='price'><strong>$$price</strong> <small>($size)</small></p>";

			if ($stock > 0) {
				echo "<p style='color: green;'>In Stock ($stock left)</p>";
			} else {
				echo "<p style='color: red;'>Out of Stock</p>";
			}

			echo "<a href='index.php?page=product&id=$id' class='button'>View Details</a>";
		echo "</div>";
	}
} catch (PDOException $e) {
	echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
</div>
