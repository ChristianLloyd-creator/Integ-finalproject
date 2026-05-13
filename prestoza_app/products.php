<?php
session_start();
if (!isset($_SESSION['user'])) { 
    header("Location: login.php"); 
    exit(); 
}

$response = file_get_contents("https://dummyjson.com/products");
$data = json_decode($response, true);

$search = isset($_GET['search']) ? strtolower($_GET['search']) : '';
$filtered = array_filter($data['products'], function($p) use ($search) {
    return empty($search) || strpos(strtolower($p['title']), $search) !== false || strpos(strtolower($p['category']), $search) !== false;
});
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products - DummyJSON App</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000;
            color: #fff;
            min-height: 100vh;
            background-image: url('8c2cb3fee518ffc80fee12da19cc88ef.gif');
            background-size: contain;
            background-position: center;
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
        nav a.logout {
            background: red;
            color: #fff;
            box-shadow: 0 0 15px red;
        }
        .search-bar {
            text-align: center;
            margin-bottom: 25px;
        }
        .search-bar input[type="text"] {
            width: 60%;
            padding: 10px;
            border-radius: 6px;
            border: none;
            outline: none;
            font-size: 16px;
            box-shadow: 0 0 15px lime;
        }
        .search-bar button {
            padding: 10px 20px;
            margin-left: 10px;
            background: lime;
            color: #000;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 0 15px lime;
            transition: all 0.3s ease;
        }
        .search-bar button:hover {
            background: #32cd32;
            box-shadow: 0 0 25px lime;
        }
        .grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .card-link {
            text-decoration: none;
            color: inherit;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Products</h2>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="users.php">Users</a>
            <a href="posts.php">Posts</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>

        <div class="search-bar">
            <form method="GET" action="">
                <input type="text" name="search" placeholder="Search products or categories..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">Search</button>
            </form>
        </div>

        <div class="grid">
            <?php foreach ($filtered as $p): ?>
                <a href="product.php?id=<?php echo $p['id']; ?>" class="card-link">
                    <div class="card">
                        <img src="<?php echo $p['thumbnail']; ?>" alt="<?php echo $p['title']; ?>">
                        <h3><?php echo $p['title']; ?></h3>
                        <p>Category: <?php echo $p['category']; ?></p>
                        <p>Price: $<?php echo $p['price']; ?></p>
                        <p>Stock: <?php echo $p['stock']; ?></p>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
