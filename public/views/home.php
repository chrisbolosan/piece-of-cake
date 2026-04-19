<?php
require_once __DIR__ . '/../includes/config.php';
?>

$view = 'views/home.php';
include 'views/layout.php';

<h1>GP Store Cake Demo Homepage</h1>

<div class="video-container">
    <iframe
        src="https://www.youtube.com/embed/idx3GSL2KWs?si=uQuZ5NY_lMrV6ECD"
        title="YouTube video player"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen>
    </iframe>
</div>

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

