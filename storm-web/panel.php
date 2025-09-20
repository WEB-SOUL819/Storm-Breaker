<?php
session_start();
include "./assets/components/login-arc.php";

if (isset($_COOKIE['logindata']) && $_COOKIE['logindata'] == $key['token'] && $key['expired'] == "no") {
    if (!isset($_SESSION['IAm-logined'])) {
        $_SESSION['IAm-logined'] = 'yes';
    }
} elseif (isset($_SESSION['IAm-logined'])) {
    $client_token = generate_token();
    setcookie("logindata", $client_token, time() + (86400 * 30), "/"); // 86400 = 1 day
    change_token($client_token);
} else {
    header('location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aosmic Device X3</title>
    <link href="./assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="./assets/css/light-theme.min.css" rel="stylesheet">
    <link href="./assets/css/sweetalert2.min.css" rel="stylesheet">
    <link href="./assets/css/growl-notification.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Inter', sans-serif;
        }
        .main-container {
            max-width: 900px;
            margin: 50px auto;
        }
        .card-custom {
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        textarea {
            resize: none;
            font-family: monospace;
        }
        .btn {
            border-radius: 0.75rem;
            font-weight: 500;
            padding: 0.75rem 1.5rem;
        }
        .btn i {
            margin-right: 6px;
        }
    </style>
</head>

<body id="ourbody" onload="check_new_version()">

<div class="main-container">
    <div class="card card-custom p-4">
        <h3 class="text-center mb-4">📡 Aosmic Device X3</h3>

        <div class="mb-3">
            <textarea class="form-control" placeholder="Logs will appear here..." id="result" rows="15"></textarea>
        </div>

        <div class="d-flex flex-wrap justify-content-center gap-3">
            <button class="btn btn-danger" id="btn-listen-toggle">
                <i class="bi bi-broadcast-pin"></i> Listener Running / Stop
            </button>
            <button class="btn btn-success" onclick="saveTextAsFile(result.value,'log.txt')">
                <i class="bi bi-download"></i> Download Logs
            </button>
            <button class="btn btn-warning" id="btn-clear">
                <i class="bi bi-trash"></i> Clear Logs
            </button>
        </div>
    </div>
</div>

<script src="./assets/js/jquery.min.js"></script>
<script src="./assets/js/script.js"></script>
<script src="./assets/js/sweetalert2.min.js"></script>
<script src="./assets/js/growl-notification.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>
</html>