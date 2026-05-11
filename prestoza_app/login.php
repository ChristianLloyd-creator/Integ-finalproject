<?php
session_start();
require_once 'config.php';

if (isset($_POST['login'])) {
    $loginInput = $_POST['login_input'];
    $password   = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? OR username=?");
    $stmt->bind_param("ss", $loginInput, $loginInput);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "User not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            max-width: 400px;
            width: 100%;
            box-shadow: 0 0 25px lime;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: bold;
            background: linear-gradient(to right, lime, red, blue);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        input {
            margin: 8px 0;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            margin-top: 15px;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            color: #000;
            background: lime;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 0 15px lime;
            transition: all 0.3s ease;
        }
        button:hover {
            background: #32cd32;
            box-shadow: 0 0 20px lime;
        }
        p {
            margin-top: 15px;
            color: #ccc;
        }
        a {
            color: #00c853;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
      <div class="container">
        <h1>Login Account</h1>
<form method="POST">
  <input type="text" name="login_input" placeholder="Email or Username" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit" name="login">Login</button>
</form>
<p>Dont'n have an account yet? <a href="register.php">Register</a></p>
      </div>

</body>
</html>
