<?php
session_start();
include "config.php";
include "./assets/components/login-arc.php";

// Auto login with cookie
if (isset($_COOKIE['logindata']) && $_COOKIE['logindata'] == $key['token'] && $key['expired'] == "no") {
    $_SESSION['IAm-logined'] = 'yes';
    header("Location: panel.php");
    exit;
}

// Already logged in
elseif (isset($_SESSION['IAm-logined'])) {
    header("Location: panel.php");
    exit;
}

$errorMessage = "";

// Handle login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        if (isset($CONFIG[$username]) && $CONFIG[$username]['password'] == $password) {
            $_SESSION['IAm-logined'] = $username;
            header("Location: panel.php");
            exit;
        } else {
            $errorMessage = "⚠️ Username or password is incorrect!";
        }
    } else {
        $errorMessage = "⚠️ Please enter both fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Login</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #1f1c2c, #928DAB);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.6s ease-in-out;
        }
        .login-card h2 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        .form-control {
            border-radius: 12px;
            margin-bottom: 1rem;
        }
        .btn-primary {
            border-radius: 12px;
            padding: 0.6rem;
            font-weight: 500;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="login-card">
        <h2>🔒 Login</h2>
        <form method="POST">
            <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
            <input type="password" class="form-control" name="password" placeholder="Password" required>
            <button class="btn btn-primary w-100" type="submit">Login</button>
        </form>

        <?php if ($errorMessage): ?>
            <div class="alert alert-danger text-center mt-3" role="alert">
                <?= htmlspecialchars($errorMessage) ?>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>


	<?php
}

?>