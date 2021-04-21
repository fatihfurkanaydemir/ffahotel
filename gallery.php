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
    <?php require 'headers/header.php'?>

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <h1 class="p-2 gallery-carousel-title">Our Hotel</h1>
            <div id="ourHotelCarousel" class="carousel slide gallery-carousel shadow-lg" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#ourHotelCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#ourHotelCarousel" data-slide-to="1"></li>
                    <li data-target="#ourHotelCarousel" data-slide-to="2"></li>
                </ol>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/hotelCarousel.jpg" alt="Our Hotel">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/hotelCarousel.jpg" alt="Our Hotel">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/hotelCarousel.jpg" alt="Our Hotel">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#ourHotelCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#ourHotelCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="row align-items-center flex-column mt-5">
            <h1 class="p-2 gallery-carousel-title">VIP Rooms</h1>
            <div id="vipRoomsCarousel" class="carousel slide gallery-carousel shadow-lg" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#vipRoomsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#vipRoomsCarousel" data-slide-to="1"></li>
                    <li data-target="#vipRoomsCarousel" data-slide-to="2"></li>
                </ol>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/vipRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/vipRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/vipRoom.jpg" alt="Vip Room">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#vipRoomsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#vipRoomsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="row align-items-center flex-column mt-5">
            <h1 class="p-2 gallery-carousel-title">Family Rooms</h1>
            <div id="familyRoomsCarousel" class="carousel slide gallery-carousel shadow-lg" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#familyRoomsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#familyRoomsCarousel" data-slide-to="1"></li>
                    <li data-target="#familyRoomsCarousel" data-slide-to="2"></li>
                </ol>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/familyRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/familyRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/familyRoom.jpg" alt="Vip Room">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#familyRoomsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#familyRoomsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="row align-items-center flex-column mt-5">
            <h1 class="p-2 gallery-carousel-title">Double Rooms</h1>
            <div id="doubleRoomsCarousel" class="carousel slide gallery-carousel shadow-lg" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#doubleRoomsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#doubleRoomsCarousel" data-slide-to="1"></li>
                    <li data-target="#doubleRoomsCarousel" data-slide-to="2"></li>
                </ol>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/doubleRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/doubleRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/doubleRoom.jpg" alt="Vip Room">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#doubleRoomsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#doubleRoomsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="row align-items-center flex-column mt-5">
            <h1 class="p-2 gallery-carousel-title">Single Rooms</h1>
            <div id="singleRoomsCarousel" class="carousel slide gallery-carousel shadow-lg" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#singleRoomsCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#singleRoomsCarousel" data-slide-to="1"></li>
                    <li data-target="#singleRoomsCarousel" data-slide-to="2"></li>
                </ol>
                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="img/singleRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/singleRoom.jpg" alt="Vip Room">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="img/singleRoom.jpg" alt="Vip Room">
                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#singleRoomsCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#singleRoomsCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </section>  
    <?php require 'footers/footer.php'?>
</body>
</html>