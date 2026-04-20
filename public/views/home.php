<h1>GP Store Cake Demo Homepage</h1>

<div class="grid">
<?php
try {
    $prepared = $pdo->query("SELECT * FROM CAKE");

    while ($row = $prepared->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='card'>";
        foreach ($row as $key => $value) {
            echo "<p><strong>" . htmlspecialchars(ucfirst($key)) . ":</strong> "
               . htmlspecialchars($value) . "</p>";
        }
        echo "</div>";
    }
} catch (PDOException $e) {
    echo "<p>error fetching data: " . htmlspecialchars($e->getMessage()) . "</p>";
}
?>
</div>

