<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Main Dashboard - DummyJSON App</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(135deg, lime, red, blue, lime);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;

             /* Replace with your GIF file */
            background-image: url('8c2cb3fee518ffc80fee12da19cc88ef.gif');
            background-size: cover;
            background-position: center;
        }
        @keyframes gradientShift {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        .container {
            background: rgba(0,0,0,0.85);
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            max-width: 800px;
            width: 100%;
            box-shadow: 0 0 25px lime;
        }
        h2 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(to right, lime, red, blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        nav {
            margin: 20px 0;
        }
        nav a {
            margin: 0 10px;
            padding: 10px 20px;
            font-size: 16px;
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
        .cards {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            margin-top: 30px;
        }
        .card {
            background: rgba(255,255,255,0.1);
            border-radius: 10px;
            padding: 20px;
            margin: 10px;
            width: 200px;
            box-shadow: 0 0 15px rgba(0,255,100,0.6);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0 25px lime;
        }
        .card a {
            display: block;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Add your image here -->
        
        <h2>Welcome, <?php echo $_SESSION['user']; ?></h2>
        <nav>
            <a href="products.php">Products</a>
            <a href="users.php">Users</a>
            <a href="posts.php">Posts</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
        <div class="cards">
            <div class="card">
                <h3>Products</h3>
                <p>Browse items from DummyJSON API.</p>
                <a href="products.php">View Products →</a>
            </div>
            <div class="card">
                <h3>Users</h3>
                <p>See user profiles and carts.</p>
                <a href="users.php">View Users →</a>
            </div>
            <div class="card">
                <h3>Posts</h3>
                <p>Read posts and reactions.</p>
                <a href="posts.php">View Posts →</a>
            </div>
        </div>
    </div>
</body>
</html>
