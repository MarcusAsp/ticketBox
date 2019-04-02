<?php
require_once('../db/config.php');
include_once('../public/src/login.inc.php');
session_start();

if(isset($_POST['logIn'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $password = hash("sha256", $password);

    $user = new User();
    $user->logIn($username, $password);
}

if(isset($_POST['logOut'])){
    unset($_SESSION['user']);
    session_destroy();
    header("Location: index.php");
}

if(isset($_POST['signUpform'])){
    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'createPassword', FILTER_SANITIZE_STRING);
    $password = hash("sha256", $password);

    $userInfo = [$firstname, $lastname, $email, $password];

    $user = new User();
    $user->createAccount($userInfo);
}


?>
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
<body>
    <main>
    <?php 
                        if(isset($_SESSION['user'])){
                           echo('
                           <form method="POST">
                            <input type="submit" name="logOut" class="btn btn-secondary" data-dismiss="modal" value="Log out">
                           </form>
                           ');
                        }else{
                           
                        }
                    ?>
        <!-- HEADER -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="../public/index.php"><img src="../public/assets/images/logos/sitelogo.png"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../public/index.php">Home<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Concerts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Upcoming events</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                    
                    </span>
                </div>
            </nav>
        </header> 