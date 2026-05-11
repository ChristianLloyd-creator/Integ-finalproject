<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}

$response = file_get_contents("https://dummyjson.com/users");
$users = json_decode($response, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - DummyJSON App</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000;
            color: #fff;
            min-height: 100vh;
            background-image: linear-gradient(135deg, lime, red, blue, lime);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;

            background-image: url('8c2cb3fee518ffc80fee12da19cc88ef.gif');
            background-size: contain;
            background-position: center;
        }
        @keyframes gradientShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        .container {
            background: rgba(0,0,0,0.85);
            padding: 30px;
            border-radius: 12px;
            max-width: 1000px;
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
        nav a:hover {
            background: #32cd32;
            box-shadow: 0 0 20px lime;
        }
        nav a.logout {
            background: red;
            color: #fff;
            box-shadow: 0 0 15px red;
        }
        nav a.logout:hover {
            background: darkred;
            box-shadow: 0 0 20px red;
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
            max-width: 80px;
            border-radius: 50%;
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
        .btn-cart {
            display: inline-block;
            margin-top: 10px;
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
        .btn-cart:hover {
            background: #32cd32;
            box-shadow: 0 0 20px lime;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Users</h2>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="products.php">Products</a>
            <a href="posts.php">Posts</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
        <div class="grid">
            <?php foreach ($users['users'] as $u): ?>
                <div class="card">
                    <img src="<?php echo $u['image']; ?>" alt="<?php echo $u['firstName']; ?>">
                    <h3><?php echo $u['firstName'] . " " . $u['lastName']; ?></h3>
                    <p>Email: <?php echo $u['email']; ?></p>
                    <p>Age: <?php echo $u['age']; ?></p>
                    <p>Phone: <?php echo $u['phone']; ?></p>
                    <a href="user_cart.php?user_id=<?php echo $u['id']; ?>" class="btn-cart">View Cart</a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
