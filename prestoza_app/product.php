<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

$id = $_GET['id'];
$response = file_get_contents("https://dummyjson.com/products/$id");
$product = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $product['title']; ?> - Product Details</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000;
            color: #fff;
            background-image: url('neon-background.gif');
            background-size: cover;
            background-position: center;
        }
        .container {
            background: rgba(0,0,0,0.85);
            padding: 40px;
            border-radius: 12px;
            max-width: 800px;
            margin: 60px auto;
            box-shadow: 0 0 25px lime;
            text-align: center;
        }
        h2 {
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(to right, lime, red, blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        img {
            max-width: 300px;
            border-radius: 10px;
            box-shadow: 0 0 20px lime;
            margin: 20px 0;
        }
        p {
            font-size: 16px;
            color: #ccc;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: lime;
            color: #000;
            font-weight: bold;
            border-radius: 6px;
            text-decoration: none;
            box-shadow: 0 0 15px lime;
        }
        a:hover {
            background: #32cd32;
            box-shadow: 0 0 25px lime;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><?php echo $product['title']; ?></h2>
        <img src="<?php echo $product['thumbnail']; ?>" alt="<?php echo $product['title']; ?>">
        <p><strong>Category:</strong> <?php echo $product['category']; ?></p>
        <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
        <p><strong>Stock:</strong> <?php echo $product['stock']; ?></p>
        <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
        <a href="products.php">← Back to Products</a>
    </div>
</body>
</html>
