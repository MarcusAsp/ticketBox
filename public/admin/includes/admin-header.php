<?php
require_once('../db/config.php');
include_once('src/admin-login.inc.php');
session_start();

if (isset($_POST['logInAdmin'])) {
    $username = filter_input(INPUT_POST, 'adminusername', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'adminpassword', FILTER_SANITIZE_STRING);

    $user = new Admin();
    $user->logIn($username, $password);
}

$head = '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Shop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/normalize.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" media="screen" href="assets/css/style.css">
    <script src="assets/functions/jquery.slim.min.js"></script>
    <script src="assets/functions/bootstrap.min.js"></script>
    <script src="assets/functions/functions.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
';

if(isset($_SESSION['admin'])){
echo($head);
echo('
<body>
    <header>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit-concerts.php">Concerts</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="events.php">Events</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users.php">Users</a>
            </li>
            <li class="nav-item">
                <a href="../logOutAdmin.php" class="nav-link">Log out</a>
            </li>
        </ul>
    </header>
    <main> 
');
}else{
    echo($head);
}
?>