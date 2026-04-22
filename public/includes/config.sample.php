<?php
// Need to rename this file to config.php and fill in your credentials to allow testing locally to your machine. Otherwise the production and development stores are using automated configuration from the GitHub pipeline.
// In order for this to work locally or your own Turing/Hopper you would need to ".scp" the entire codebase repository into your OWN server and SOURCE manually all SQL files

$DB_HOST = "courses";
$DB_NAME = "databasename";
$DB_USER = "your_username";
$DB_PASS = "your_password";

try {
    $pdo = new PDO(
        "mysql:host=$DB_HOST;dbname=$DB_NAME",
        $DB_USER,
        $DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
