<div class="hero">
    <h1> Piece of Cake</h1>?
</div>

<div class="grid">
<?php
try {
	$prepared = $pdo->query("SELECT * FROM CAKE");

	while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {

		$name    = htmlspecialchars($row['Flavor'] . " Cake");
		$price   = number_format((float)$row['BasePrice'], 2);
		$img     = htmlspecialchars($row['Img']); 
		$size    = htmlspecialchars($row['Size']);
		$stock   = (int)$row['NumInStock'];
		$id      = (int)$row['CakeID'];

		        echo "<div class='card'>";

            //Image
            echo "<img src='admin/images/$img' alt='$name' style='width:100%; height:200px; object-fit:cover;'>";

            //Name
            echo "<h3>$name</h3>";

            //Price
            echo "<p><strong>Price: $$price</strong></p>";

            //Stock Count
            echo "<p style='color;green';>In Stock: $stock</p>";

            //Highlight if out of stock
            if ($stock <= 0) {
                echo "<p style='color:red;'><strong>Out of Stock</strong></p>";
            }

            //Link
            echo "<a href='index.php?page=product&id=$id'>View Details</a>";

        echo "</div>";
	}
} catch (PDOException $e) {
	echo "<p>Error: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
</div>
