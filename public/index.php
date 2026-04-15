<?php
require_once __DIR__ . '/includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GP Store – Cakes and stuff</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            max-width: 1000px;
            margin: auto;
        }
        .card {
            background: #ffffff;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .card h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>

<h1>GP Store Cake Demo Homepage</h1>

<div class="grid">
<?php
try {
    $prepared = $pdo->query("SELECT * FROM Dog");

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

</body>
</html>
