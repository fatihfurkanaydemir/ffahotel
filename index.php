    <?php require 'headers/header.php'?>

    <?php 
        include "dbconnect.php";
        $booknowBtnState = "disabled";
        
        $conn = connectdb();

        $sql = "SELECT * FROM roomprice";
        $result = $conn->query($sql);

        $prices = array();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $prices[$row["roomtype"]] = $row["price"];
            }
        } 

        closedb($conn);


    ?>

    <section class="main-section container-fluid">
        <div class="row">
            <nav class="col-md-5">
                <div class="card flex-row shadow">
                    <img src="img/vipRoom.jpg" alt="Vip Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.html#vipRoomCard" class="mainpage-room-link bg-primary text-white p-2">VIP Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice"><?php echo $prices["vip"]; ?></strong> USD/Day</span>
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
                            <span><strong id="vipRoomPrice"><?php echo $prices["family"]; ?></strong> USD/Day</span>
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
                            <span><strong id="vipRoomPrice"><?php echo $prices["double"]; ?></strong> USD/Day</span>
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
                            <span><strong id="vipRoomPrice"><?php echo $prices["single"]; ?></strong> USD/Day</span>
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
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="checkinDate" class="mt-4 text-primary font-weight-bold">Check-in Date: </label>
                                <input type="date" id="checkinDate" name="checkinDate" class="form-control shadow w-100" data-relmax="0" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="checkoutDate" class="mt-4 text-primary font-weight-bold">Check-out Date: </label>
                                <input type="date" id="checkoutDate" name="checkoutDate" class="form-control shadow w-100" data-relmax="0" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="roomTypeSelect" class="text-primary font-weight-bold">Select room type: </label>
                            <select class="custom-control custom-select shadow" id="roomTypeSelect" name="roomType" disabled>
                                <option>VIP Room</option>
                                <option>Family Room</option>
                                <option>Double Room</option>
                                <option>Single Room</option>
                            </select>
                        </div>
                    
                        <div class="form-group"></div>
                        <label for="personNumberSelect" class="text-primary font-weight-bold">Select number of persons: </label>
                        <select class="custom-control custom-select shadow" id="personNumberSelect" name="personNumber" disabled>
                            <option>1 Person</option>
                            <option>2 Person</option>
                            <option>3 Person</option>
                            <option>4 Person</option>
                        </select>
                    
                    
                        
                        <input type="submit" value="Book Now" class="btn btn-primary mt-4 shadow" style="width: 100%;" disabled>
                    </form>
                </div>
            </article>
        </div>
    </section>  

    <script src="js/index_book.js"></script>
    <script>
        $(function () {
            $('input[data-relmax]').each(function () {
                var oldVal = $(this).prop('value');
                var relmax = $(this).data('relmax');
                var min = new Date();
                min.setFullYear(min.getFullYear() + relmax);
                $.prop(this, 'min', $(this).prop('valueAsDate', min).val());
                $.prop(this, 'value', oldVal);
            });
        });
    </script>

    <?php require 'footers/footer.php'?>