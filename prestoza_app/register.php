<?php
session_start();
require_once 'config.php';

$message = "";

if (isset($_POST['register'])) {
    $fullname = trim($_POST['fullname']);
    $email    = trim($_POST['email']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm'];

    if ($password !== $confirm) {
        $message = "❌ Passwords do not match!";
    } else {
        // Check if email or username already exists
        $check = $conn->prepare("SELECT id FROM users WHERE email=? OR username=? LIMIT 1");
        $check->bind_param("ss", $email, $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            $message = "⚠️ Account already exists!";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            // ✅ Ensure column names match your DB schema (full_name not fullname)
            $stmt = $conn->prepare("INSERT INTO users(full_name,email,username,password) VALUES(?,?,?,?)");
            $stmt->bind_param("ssss", $fullname, $email, $username, $hashed);
            if ($stmt->execute()) {
                $message = "✅ Registration successful. You may now login.";
                // Clear form values after success
                $fullname = $email = $username = "";
            } else {
                $message = "❌ Error: Could not register.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - DummyJSON App</title>
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
            background-image: url('8c2cb3fee518ffc80fee12da19cc88ef.gif');
            background-size: cover;
            background-position: center;
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
        .message {
            margin-bottom: 15px;
            font-weight: bold;
            color: #ff5252;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Create Account</h1>
        <?php if (!empty($message)) { echo "<div class='message'>$message</div>"; } ?>
        <form method="POST">
            <input type="text" name="fullname" placeholder="Full Name" value="<?php echo htmlspecialchars($fullname ?? ''); ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username ?? ''); ?>" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>
</html>
