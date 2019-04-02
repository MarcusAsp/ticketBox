<?php
require_once('../db/config.php');
session_start();

if(isset($_POST['logIn'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $password = hash("sha256", $password);

    $user = new User();
    $user->logIn($username, $password);
}

if(isset($_POST['signUp'])){
    $firstname = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $lastname = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $password = hash("sha256", $password);

    $userInfo = [$email, $firstname, $lastname, $password];

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

                    <?php 
                        if(isset($_SESSION['user'])){
                           echo('<input type="submit" name="logOut" class="btn btn-secondary" data-dismiss="modal" value="Log out">');
                        }else{
                           echo('
                            <button type="button" class="btn btn-outline-secondary text-dark" data-toggle="modal" data-target="#exampleModal" id="logIn">Log in</button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Log In</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="POST">
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="exampleInputPassword1">Password</label>
                                                        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-secondary" data-dismiss="modal" value="Sign Up">
                                                <input type="submit" name="logIn" class="btn btn-secondary" data-dismiss="modal" value="Log In">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        ');
                        }
                    ?>
                    </span>
                </div>
            </nav>
        </header> 