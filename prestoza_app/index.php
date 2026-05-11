<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['user'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DummyJSON API Web Application</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background: #000; /* dark base */
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: linear-gradient(135deg, lime, red, blue, lime);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;

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
            max-width: 500px;
            box-shadow: 0 0 25px lime;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: bold;
            background: linear-gradient(to right, lime, red, blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        p {
            margin-bottom: 30px;
            font-size: 16px;
            color: #ccc;
        }
        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            font-size: 16px;
            font-weight: bold;
            color: #000;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .btn-login {
            background: lime;
            box-shadow: 0 0 15px lime;
        }
        .btn-register {
            background: blue;
            box-shadow: 0 0 15px blue;
            color: #fff;
        }
        .btn-login:hover {
            background: #32cd32;
            box-shadow: 0 0 20px lime;
        }
        .btn-register:hover {
            background: darkblue;
            box-shadow: 0 0 20px blue;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>WELCOME TO CYBERSHOP!</h1>
        <p>
            Shop the Future!
        </p>
        
        <div class="buttons">
            <a href="login.php" class="btn btn-login">Login</a>
            <a href="register.php" class="btn btn-register">Register</a>
        </div>
    </div>
</body>
</html>
