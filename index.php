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

        $vipRate = $singleRate = $familyRate = $doubleRate = 0;
        $vipStars = $singleStars = $familyStars = $doubleStars = "";
        $vipReviewCount = $singleReviewCount = $familyReviewCount = $doubleReviewCount = 0;

        $sql = "SELECT ro.roomtype, cast(AVG(com.rate) as decimal(6,1)) as avgrate, COUNT(*) as count 
                FROM comment com JOIN reservation res ON res.commentid = com.id
                JOIN room ro ON res.doornumber = ro.doornumber GROUP BY ro.roomtype";

        $result = $conn->query($sql);

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                switch($row["roomtype"]){
                    case "vip":
                        $vipRate = $row["avgrate"];
                        $vipReviewCount = $row["count"];

                        for($i = 0; $i < (int)floor($vipRate); $i++)
                        {
                            $vipStars .= "<i class='fa fa-star checked'></i>";
                        }
                        
                        for($i = 0; $i < 5 - (int)floor($vipRate); $i++)
                        {
                            $vipStars .= "<i class='fa fa-star'></i>";
                        }

                        break;
                    case "family":
                        $familyRate = $row["avgrate"];
                        $familyReviewCount = $row["count"];

                        for($i = 0; $i < (int)floor($familyRate); $i++)
                        {
                            $familyStars .= "<i class='fa fa-star checked'></i>";
                        }
                        
                        for($i = 0; $i < 5 - (int)floor($familyRate); $i++)
                        {
                            $familyStars .= "<i class='fa fa-star'></i>";
                        }

                        break;
                    case "single":
                        $singleRate = $row["avgrate"];
                        $singleReviewCount = $row["count"];

                        for($i = 0; $i < (int)floor($singleRate); $i++)
                        {
                            $singleStars .= "<i class='fa fa-star checked'></i>";
                        }
                        
                        for($i = 0; $i < 5 - (int)floor($singleRate); $i++)
                        {
                            $singleStars .= "<i class='fa fa-star'></i>";
                        }

                        break;
                    case "double":
                        $doubleRate = $row["avgrate"];
                        $doubleReviewCount = $row["count"];

                        for($i = 0; $i < (int)floor($doubleRate); $i++)
                        {
                            $doubleStars .= "<i class='fa fa-star checked'></i>";
                        }
                        
                        for($i = 0; $i < 5 - (int)floor($doubleRate); $i++)
                        {
                            $doubleStars .= "<i class='fa fa-star'></i>";
                        }

                        break;
                }
            }
        }
        else {
            for($i = 0; $i < 5; $i++)
            {
                $familyStars .= "<i class='fa fa-star'></i>";
                $singleStars .= "<i class='fa fa-star'></i>";
                $vipStars .= "<i class='fa fa-star'></i>";
                $doubleStars .= "<i class='fa fa-star'></i>";
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
                        <a href="rooms.php#vipRoomCard" class="mainpage-room-link bg-primary text-white p-2">VIP Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice"><?php echo $prices["vip"]; ?></strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;"><?php echo $vipRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $vipStars; ?>
                                    </div>
                                    <a href="rooms.php#vipRoomCard" class="text-primary"><?php echo $vipReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/familyRoom.jpg" alt="Family Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.php#familyRoomCard" class="mainpage-room-link bg-primary text-white p-2">Family Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice"><?php echo $prices["family"]; ?></strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;"><?php echo $familyRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $familyStars; ?>
                                    </div>
                                    <a href="rooms.php#familyRoomCard" class="text-primary"><?php echo $familyReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/doubleRoom.jpg" alt="Double Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.php#doubleRoomCard" class="mainpage-room-link bg-primary text-white p-2">Double Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice"><?php echo $prices["double"]; ?></strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;"><?php echo $doubleRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $doubleStars; ?>
                                    </div>
                                    <a href="rooms.php#doubleRoomCard" class="text-primary"><?php echo $doubleReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card flex-row mt-2 shadow">
                    <img src="img/singleRoom.jpg" alt="Single Room" class="img-fluid" width="40%">
                    <div class="card-body p-2">
                        <a href="rooms.php#singleRoomCard" class="mainpage-room-link bg-primary text-white p-2">Single Room</a>
                        <div class="pt-1">
                            <span><strong id="vipRoomPrice"><?php echo $prices["single"]; ?></strong> USD/Day</span>
                            <div class="ratings text-center" style="float: right;">
                                <div> <span style="font-size: 30px;"><?php echo $singleRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $singleStars; ?>
                                    </div>
                                    <a href="rooms.php#singleRoomCard" class="text-primary"><?php echo $singleReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <article class="main-article col-md-7 card shadow">
                <div class="card-body">
                    <form id="booknowform" action="selectroom.php" method="POST" class="mt-3" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-sm-6">
                                <label for="checkinDate" class="mt-4 text-primary font-weight-bold">Check-in Date: </label>
                                <input type="date" id="checkinDate" name="checkindate" class="form-control shadow w-100" data-relmax="0" required>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="checkoutDate" class="mt-4 text-primary font-weight-bold">Check-out Date: </label>
                                <input type="date" id="checkoutDate" name="checkoutdate" class="form-control shadow w-100" data-relmax="0" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="roomTypeSelect" class="text-primary font-weight-bold">Select room type: </label>
                            <select class="custom-control custom-select shadow" id="roomTypeSelect" name="roomtype" disabled>
                                <option value="default" selected>Please select a room type</option>
                                <option value="vip">VIP Room</option>
                                <option value="family">Family Room</option>
                                <option value="double">Double Room</option>
                                <option value="single">Single Room</option>
                            </select>
                        </div>
                    
                        <div class="form-group"></div>
                        <label for="personNumberSelect" class="text-primary font-weight-bold">Select number of persons: </label>
                        <select class="custom-control custom-select shadow" id="personNumberSelect" name="numberofpersons" disabled>
                            <option value="default" selected>Please select number of persons</option>
                            <option value="1">1 Persons</option>
                            <option value="2">2 Persons</option>
                            <option value="3">3 Persons</option>
                            <option value="4">4 Persons</option>
                        </select>
                        
                        <input type="submit" id="submit" value="Book Now" class="btn btn-primary mt-4 shadow" style="width: 100%;" disabled>
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