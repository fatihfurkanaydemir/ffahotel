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
        <div class="row">
            <nav class="col-md-5">
                <div class="card flex-row shadow">
                    <img src="img/vipRoom.jpg" alt="Vip Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.html#vipRoomCard" class="mainpage-room-link bg-primary text-white p-2">VIP Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice">150</strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;">4.6</span><span>/5</span>
                                    <div style="font-size: 18px; color: #28a745;"> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="rooms.html#vipRoomCard" class="text-primary">15 reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/familyRoom.jpg" alt="Family Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.html#familyRoomCard" class="mainpage-room-link bg-primary text-white p-2">Family Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice">100</strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;">4.9</span><span>/5</span>
                                    <div style="font-size: 18px; color: #28a745;"> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="rooms.html#familyRoomCard" class="text-primary">12 reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/doubleRoom.jpg" alt="Double Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.html#doubleRoomCard" class="mainpage-room-link bg-primary text-white p-2">Double Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice">70</strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;">4.1</span><span>/5</span>
                                    <div style="font-size: 18px; color: #28a745;"> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="rooms.html#doubleRoomCard" class="text-primary">5 reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/singleRoom.jpg" alt="Single Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.html#singleRoomCard" class="mainpage-room-link bg-primary text-white p-2">Single Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice">50</strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;">4.3</span><span>/5</span>
                                    <div style="font-size: 18px; color: #28a745;"> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i> 
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <a href="rooms.html#singleRoomCard" class="text-primary">25 reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <article class="main-article col-md-7 card shadow">
                <div class="card-body">
                    <form action="book.php" class="mt-3">
                        <div class="form-group">
                            <label for="roomTypeSelect" class="text-primary font-weight-bold">Select room type: </label>
                            <select class="custom-control custom-select shadow" id="roomTypeSelect" name="roomType">
                                <option>VIP Room</option>
                                <option>Family Room</option>
                                <option>Double Room</option>
                                <option>Single Room</option>
                            </select>
                        </div>
                    
                        <div class="form-group"></div>
                        <label for="personNumberSelect" class="mt-4 text-primary font-weight-bold">Select number of persons: </label>
                        <select class="custom-control custom-select shadow" id="personNumberSelect" name="personNumber">
                            <option>1 Person</option>
                            <option>2 Person</option>
                            <option>3 Person</option>
                            <option>4 Person</option>
                        </select>
                    
                    
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="checkinDate" class="mt-4 text-primary font-weight-bold">Check-in Date: </label>
                                <input type="date" id="checkinDate" name="checkinDate" class="form-control shadow w-100" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="checkoutDate" class="mt-4 text-primary font-weight-bold">Check-out Date: </label>
                                <input type="date" id="checkoutDate" name="checkoutDate" class="form-control shadow w-100" required>
                            </div>
                        </div>
                        <input type="submit" value="Book Now" class="btn btn-primary mt-4 shadow" style="width: 100%;">
                    </form>
                </div>
            </article>
        </div>
    </section>  

    <?php require 'footers/footer.php'?>
</body>
</html>