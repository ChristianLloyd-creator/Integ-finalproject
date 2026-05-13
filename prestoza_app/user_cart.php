<?php
// user_cart.php
session_start();
if (!isset($_SESSION['user'])) { header("Location: login.php"); exit(); }

$userId = $_GET['user_id'];
$response = file_get_contents("https://dummyjson.com/carts");
$carts = json_decode($response, true);

$cart = null;
foreach ($carts['carts'] as $c) {
    if ($c['userId'] == $userId) {
        $cart = $c;
        break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Cart</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000;
            color: #fff;
            min-height: 100vh;
            background-image: url('8c2cb3fee518ffc80fee12da19cc88ef.gif');
            background-size: cover;
            background-position: center;
        }
        .container {
            background: rgba(0,0,0,0.85);
            padding: 30px;
            border-radius: 12px;
            max-width: 900px;
            margin: 40px auto;
            box-shadow: 0 0 25px lime;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(to right, lime, red, blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        nav {
            text-align: center;
            margin-bottom: 20px;
        }
        nav a {
            margin: 0 10px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: bold;
            color: #000;
            background: lime;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 0 15px lime;
            transition: all 0.3s ease;
        }
        nav a.logout {
            background: red;
            color: #fff;
            box-shadow: 0 0 15px red;
        }
        .summary {
            text-align: center;
            margin-bottom: 25px;
            font-size: 16px;
            color: #ccc;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 15px;
            width: 220px;
            text-align: center;
            box-shadow: 0 0 15px rgba(0,255,100,0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 25px lime;
        }
        .card img {
            max-width: 100%;
            border-radius: 6px;
            margin-bottom: 10px;
        }
        .card h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #fff;
        }
        .card p {
            font-size: 14px;
            color: #ccc;
            margin: 5px 0;
        }
        .back-btn {
            display: block;
            margin: 30px auto 0;
            padding: 10px 20px;
            background: lime;
            color: #000;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 0 15px lime;
            transition: all 0.3s ease;
            text-align: center;
            width: fit-content;
        }
        .back-btn:hover {
            background: #32cd32;
            box-shadow: 0 0 25px lime;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>User Cart</h2>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="posts.php">Posts</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>

        <?php if ($cart): ?>
            <div class="summary">
                <p><strong>Cart ID:</strong> <?php echo $cart['id']; ?></p>
                <p><strong>Total Items:</strong> <?php echo $cart['totalProducts']; ?></p>
                <p><strong>Total Amount:</strong> $<?php echo $cart['total']; ?></p>
            </div>

            <div class="grid">
                <?php foreach ($cart['products'] as $p): ?>
                    <div class="card">
                        <img src="<?php echo $p['thumbnail']; ?>" alt="<?php echo $p['title']; ?>">
                        <h3><?php echo $p['title']; ?></h3>
                        <p>Qty: <?php echo $p['quantity']; ?></p>
                        <p>Price: $<?php echo $p['price']; ?></p>
                        <p>Total: $<?php echo $p['total']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <a href="users.php" class="back-btn">← Back to Users</a>
        <?php else: ?>
            <p style="text-align:center; color:red;">No cart found for this user.</p>
            <a href="users.php" class="back-btn">← Back to Users</a>
        <?php endif; ?>
    </div>
</body>
</html>
