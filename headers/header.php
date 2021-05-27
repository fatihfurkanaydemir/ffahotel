<?php 
    session_start();

    $loginText = "Login/Signup";
    $loginLink = "login.php";

    if(isset($_SESSION["logged_in"])) {
        $logged_in = $_SESSION["logged_in"];
        $ufname = $_SESSION["ufname"];
        $loginText = "Welcome $ufname";
        $loginLink = "userdashboard.php";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/main.css">

    <title>Welcome to FFA Hotel</title>
</head>
<body>

<?php

    $indexActive = (str_contains($_SERVER["PHP_SELF"], "index.php") ? " active" : "");
    $galleryActive = (str_contains($_SERVER["PHP_SELF"], "gallery.php") ? " active" : "");
    $roomsActive = (str_contains($_SERVER["PHP_SELF"], "rooms.php") ? " active" : "");
    $contactActive = (str_contains($_SERVER["PHP_SELF"], "contact.php") ? " active" : "");
    $loginActive = (str_contains($_SERVER["PHP_SELF"], "login.php") || 
                    str_contains($_SERVER["PHP_SELF"], "userdashboard.php") || 
                    str_contains($_SERVER["PHP_SELF"], "register.php") ? " active" : "");
?>

<header class="main-header">
    <img src="img/headerHotel.png" alt="Hotel Image" class="img-fluid" style="width: 100%;">
    </header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a href="index.php" class="navbar-brand">
            <img src="img/Logo.png" alt="Logo" width="60">
            <span class="text-info navbar-logo-text">FFAHOTEL</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="index.php" class="nav-link <?php echo $indexActive; ?>"> Home </a>
                </li>
                <li class="nav-item">
                    <a href="gallery.php" class="nav-link <?php echo $galleryActive; ?>"> Gallery </a>
                </li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link <?php echo $roomsActive; ?>"> Rooms </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link <?php echo $contactActive; ?>"> Contact </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo $loginLink; ?>" class="nav-link <?php echo $loginActive; ?>">
                        <img src="img/profileIcon.png" alt="Logo" width="30">
                        <?php echo $loginText; ?>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

