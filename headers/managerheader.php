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

    <link rel="stylesheet" href="../css/main.css">

    <title>Welcome to FFA Hotel</title>
</head>
<body>
    <header class="main-header">
    </header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a href="../index.php" class="navbar-brand">
            <img src="../img/Logo.png" alt="Logo" width="60">
            <span class="text-info navbar-logo-text">FFAHOTEL</span>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="changepassword.php">Change Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <?php 
        $dashboardActive = (str_contains($_SERVER["PHP_SELF"], "dashboard.php") ? " active" : "");
        $roomsActive = (str_contains($_SERVER["PHP_SELF"], "room") ? " active" : "");
        $customersActive = (str_contains($_SERVER["PHP_SELF"], "customer") ? " active" : "");
        $reservationsActive = (str_contains($_SERVER["PHP_SELF"], "reservation") ? " active" : "");
        $reportsActive = (str_contains($_SERVER["PHP_SELF"], "reports") ? " active" : "");
        $reviewsActive = (str_contains($_SERVER["PHP_SELF"], "reviews") ? " active" : "");
    ?>

    <section class="main-section container-fluid">
        <div class="row">
            <div class="col-2 shadow p-0">
                <ul class="nav list-group">
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $dashboardActive; ?>" href="dashboard.php">
                            <i class="fa fa-bar-chart d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $roomsActive; ?>" href="rooms.php">
                            <i class="fa fa-home d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Rooms</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $customersActive; ?>" href="customers.php">
                            <i class="fa fa-user d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Customers</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $reservationsActive; ?>" href="reservations.php">
                            <i class="fa fa-calendar-check-o d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Reservations</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $reportsActive; ?>" href="reports.php">
                            <i class="fa fa-line-chart d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Reports</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-inline-block list-group-item list-group-item-action border-0 <?php echo $reviewsActive; ?>" href="reviews.php">
                            <i class="fa fa-star d-inline float-left" style="font-size: 24px; width: 15%;"></i>
                            <span class="ml-3">Reviews</span>
                        </a>
                    </li>
                </ul>
            </div>
