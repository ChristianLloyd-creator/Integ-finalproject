<?php
// user_cart.php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$userId = $_GET['user_id'];
$response = file_get_contents("https://dummyjson.com/carts");
$carts = json_decode($response, true);

foreach ($carts['carts'] as $c) {
    if ($c['userId'] == $userId) {
        echo "<h2>Cart ID: {$c['id']}</h2>";
        echo "Total Items: {$c['totalProducts']}<br>";
        echo "Total Amount: \${$c['total']}<br><br>";

        foreach ($c['products'] as $p) {
            echo "- {$p['title']} | Qty: {$p['quantity']} | Price: \${$p['price']} | Total: \${$p['total']}<br>";
        }
    }
}
?>
