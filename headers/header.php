<?php

    $indexActive = (str_contains($_SERVER["PHP_SELF"], "index.php") ? " active" : "");
    $galleryActive = (str_contains($_SERVER["PHP_SELF"], "gallery.php") ? " active" : "");
    $roomsActive = (str_contains($_SERVER["PHP_SELF"], "rooms.php") ? " active" : "");
    $contactActive = (str_contains($_SERVER["PHP_SELF"], "contact.php") ? " active" : "");
    $loginActive = (str_contains($_SERVER["PHP_SELF"], "login.php") || str_contains($_SERVER["PHP_SELF"], "userdashboard.php")? " active" : "");

    $header = '
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
                    <a href="index.php" class="nav-link' . $indexActive . '"> Home </a>
                </li>
                <li class="nav-item">
                    <a href="gallery.php" class="nav-link ' . $galleryActive . '"> Gallery </a>
                </li>
                <li class="nav-item">
                    <a href="rooms.php" class="nav-link ' . $roomsActive . '"> Rooms </a>
                </li>
                <li class="nav-item">
                    <a href="contact.php" class="nav-link ' . $contactActive . '"> Contact </a>
                </li>
                <li class="nav-item">
                    <a href="login.php" class="nav-link ' . $loginActive . '">
                        <img src="img/profileIcon.png" alt="Logo" width="30">
                        Login/Signup
                    </a>
                </li>
            </ul>
        </div>
    </nav>';

    echo $header;
?>