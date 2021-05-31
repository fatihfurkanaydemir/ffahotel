    <?php require 'headers/header.php'?>

    <?php 
        include "dbconnect.php";        
        $conn = connectdb();

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

        $familyComments = $singleComments = $vipComments = $doubleComments = "";

        $sql = "SELECT cus.fname, cus.lname, ro.roomtype, com.datetime, com.text, com.rate
                FROM comment com JOIN reservation res ON res.commentid = com.id
                JOIN room ro ON ro.doornumber = res.doornumber
                JOIN customer cus ON cus.id = res.customerid";

        $result = $conn->query($sql);

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $fname = $row["fname"];
                $lname = $row["lname"];
                $datetime = $row["datetime"];
                $text = $row["text"];
                $rate = $row["rate"];

                $stars = "";
                for($i = 0; $i < (int)$rate; $i++)
                {
                    $stars .= "<i class='fa fa-star checked'></i>";
                }
                for($i = 0; $i < 5 - (int)$rate; $i++)
                {
                    $stars .= "<i class='fa fa-star'></i>";
                }
                

                switch($row["roomtype"]) {
                    case "vip":
                        $vipComments .=
                        "
                        <div class='media review'>
                            <img src='img/loginUserIcon.png' class='mr-3 room-reviews-user-icon' alt='User icon'>
                            <div class='media-body'>
                                <h5 class='mt-0 d-inline'>$fname $lname</h5>
                                <span class='ml-2'>$datetime</span>
                                <div class='rating-stars'>
                                    $stars
                                </div>
                                $text
                            </div>
                        </div>
                        ";

                        break;
                    case "family":
                        $familyComments .=
                        "
                        <div class='media review'>
                            <img src='img/loginUserIcon.png' class='mr-3 room-reviews-user-icon' alt='User icon'>
                            <div class='media-body'>
                                <h5 class='mt-0 d-inline'>$fname $lname</h5>
                                <span class='ml-2'>$datetime</span>
                                <div class='rating-stars'>
                                    $stars
                                </div>
                                $text
                            </div>
                        </div>
                        ";

                        break;
                    case "single":
                        $singleComments .=
                        "
                        <div class='media review'>
                            <img src='img/loginUserIcon.png' class='mr-3 room-reviews-user-icon' alt='User icon'>
                            <div class='media-body'>
                                <h5 class='mt-0 d-inline'>$fname $lname</h5>
                                <span class='ml-2'>$datetime</span>
                                <div class='rating-stars'>
                                    $stars
                                </div>
                                $text
                            </div>
                        </div>
                        ";

                        break;
                    case "double":
                        $doubleComments .=
                        "
                        <div class='media review'>
                            <img src='img/loginUserIcon.png' class='mr-3 room-reviews-user-icon' alt='User icon'>
                            <div class='media-body'>
                                <h5 class='mt-0 d-inline'>$fname $lname</h5>
                                <span class='ml-2'>$datetime</span>
                                <div class='rating-stars'>
                                    $stars
                                </div>
                                $text
                            </div>
                        </div>
                        ";

                        break;
                }
            }
        }

        closedb($conn);


    ?>

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <div class="room-card card shadow mt-5" id="vipRoomCard">
                <div class="card-title text-center shadow-sm mb-0 gallery-carousel-title">
                    VIP Rooms
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/vipRoom.jpg" alt="Vip Room" class="card-img">
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0 pl-5 pl-md-4">
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBalconySwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBalconySwitch">Balcony</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomShowerSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomShowerSwitch">Shower</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBathroomSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBathroomSwitch">Bathroom</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomRoomServiceSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomRoomServiceSwitch">Room Service</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomWifiSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomWifiSwitch">Wifi</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTvSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTvSwitch">Television</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTelephoneSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTelephoneSwitch">Telephone</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomMiniBarSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomMiniBarSwitch">Mini Bar</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTerraceSwitch" disabled>
                                    <label class="custom-control-label" for="roomTerraceSwitch">Terrace</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomSeaViewSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomSeaViewSwitch">Sea View</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0">
                            <div class="row p-2 p-md-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <hr>
                            <div class="row text-center flex-row align-items-center justify-content-center">
                                <div> <span style="font-size: 30px;"><?php echo $vipRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $vipStars; ?>
                                    </div>
                                    <a href="rooms.php#vipRoomCard" class="text-primary"><?php echo $vipReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="room-reviews-row row">
                        <?php echo $vipComments; ?>
                    </div>
                </div>
                
            </div>
            <div class="room-card card shadow mt-5" id="familyRoomCard">
                <div class="card-title text-center shadow-sm mb-0 gallery-carousel-title">
                    Family Rooms
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/familyRoom.jpg" alt="Vip Room" class="card-img">
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0 pl-5 pl-md-4">
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBalconySwitch" disabled>
                                    <label class="custom-control-label" for="roomBalconySwitch">Balcony</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomShowerSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomShowerSwitch">Shower</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBathroomSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBathroomSwitch">Bathroom</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomRoomServiceSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomRoomServiceSwitch">Room Service</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomWifiSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomWifiSwitch">Wifi</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTvSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTvSwitch">Television</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTelephoneSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTelephoneSwitch">Telephone</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomMiniBarSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomMiniBarSwitch">Mini Bar</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTerraceSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTerraceSwitch">Terrace</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomSeaViewSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomSeaViewSwitch">Sea View</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0">
                            <div class="row p-2 p-md-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <hr>
                            <div class="row text-center flex-row align-items-center justify-content-center">
                                <div> <span style="font-size: 30px;"><?php echo $familyRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $familyStars; ?>
                                    </div>
                                    <a href="rooms.php#familyRoomCard" class="text-primary"><?php echo $familyReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="room-reviews-row row">
                        <?php echo $familyComments; ?>
                    </div>
                </div>
                
            </div>
            <div class="room-card card shadow mt-5" id="doubleRoomCard">
                <div class="card-title text-center shadow-sm mb-0 gallery-carousel-title">
                    Double Rooms
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/doubleRoom.jpg" alt="Vip Room" class="card-img">
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0 pl-5 pl-md-4">
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBalconySwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBalconySwitch">Balcony</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomShowerSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomShowerSwitch">Shower</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBathroomSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBathroomSwitch">Bathroom</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomRoomServiceSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomRoomServiceSwitch">Room Service</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomWifiSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomWifiSwitch">Wifi</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTvSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTvSwitch">Television</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTelephoneSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTelephoneSwitch">Telephone</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomMiniBarSwitch" disabled>
                                    <label class="custom-control-label" for="roomMiniBarSwitch">Mini Bar</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTerraceSwitch" disabled>
                                    <label class="custom-control-label" for="roomTerraceSwitch">Terrace</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomSeaViewSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomSeaViewSwitch">Sea View</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0">
                            <div class="row p-2 p-md-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <hr>
                            <div class="row text-center flex-row align-items-center justify-content-center">
                                <div> <span style="font-size: 30px;"><?php echo $doubleRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $doubleStars; ?>
                                    </div>
                                    <a href="rooms.php#doubleRoomCard" class="text-primary"><?php echo $doubleReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="room-reviews-row row">
                        <?php echo $doubleComments; ?>
                    </div>
                </div>
                
            </div>
            <div class="room-card card shadow mt-5" id="singleRoomCard">
                <div class="card-title text-center shadow-sm mb-0 gallery-carousel-title">
                    Single Rooms
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="img/singleRoom.jpg" alt="Vip Room" class="card-img">
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0 pl-5 pl-md-4">
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBalconySwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBalconySwitch">Balcony</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomShowerSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomShowerSwitch">Shower</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomBathroomSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomBathroomSwitch">Bathroom</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomRoomServiceSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomRoomServiceSwitch">Room Service</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomWifiSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomWifiSwitch">Wifi</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTvSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTvSwitch">Television</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTelephoneSwitch" checked disabled>
                                    <label class="custom-control-label" for="roomTelephoneSwitch">Telephone</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomMiniBarSwitch" disabled>
                                    <label class="custom-control-label" for="roomMiniBarSwitch">Mini Bar</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomTerraceSwitch" disabled>
                                    <label class="custom-control-label" for="roomTerraceSwitch">Terrace</label>
                                </div>
                                <div class="col-6 custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="roomSeaViewSwitch" disabled>
                                    <label class="custom-control-label" for="roomSeaViewSwitch">Sea View</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mt-5 mt-md-0">
                            <div class="row p-2 p-md-0">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                                esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </div>
                            <hr>
                            <div class="row text-center flex-row align-items-center justify-content-center">
                                <div> <span style="font-size: 30px;"><?php echo $singleRate; ?></span><span>/5</span>
                                    <div class="rating-stars"> 
                                        <?php echo $singleStars; ?>
                                    </div>
                                    <a href="rooms.php#singleRoomCard" class="text-primary"><?php echo $singleReviewCount; ?> reviews</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="room-reviews-row row">
                        <?php echo $singleComments; ?>
                    </div>
                </div>
                
            </div>
        </div>
    </section>  

    <?php require 'footers/footer.php'?>