<h1>GP Store Cake Demo Homepage</h1>

<div class="grid">
<?php
try {
	$prepared = $pdo->query("SELECT * FROM CAKE");

	while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
		echo "<div class='card'>";
		foreach ($row as $key => $value) {
			if (strtolower($key) === 'img') { 
				echo "<p><strong>Image:</strong><br>";
				echo "<img src='uploads/" . htmlspecialchars($value) . "' alt='Coming soon' style='width:100%; border-radius:5px;'>";
				echo "</p>";
			} else {
				echo "<p><strong>" . htmlspecialchars(ucfirst($key)) . ":</strong> "
				. htmlspecialchars($value) . "</p>";
			}
		}
			echo "</div>";
	}
} catch (PDOException $e) {
	echo "<p>error fetching data: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
</div>

