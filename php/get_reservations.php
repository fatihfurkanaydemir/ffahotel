<?php 
session_start();

include "../dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["uid"];

    $conn = connectdb();

    $sql = "SELECT res.checkindate, res.doornumber, res.reservationdate, res.checkoutdate,res.numberofpersons, 
                    res.totalprice, res.status, ro.roomtype, res.commentid, com.datetime, com.text, com.rate,
                    cus.fname, cus.lname FROM reservation res JOIN room ro ON ro.doornumber = res.doornumber
            JOIN customer cus ON res.customerid = cus.id
            LEFT JOIN comment com ON com.id = res.commentid
            WHERE customerid=$id ORDER BY res.reservationdate";

    $result = $conn->query($sql);

    $reservations = "";

    if($result->num_rows != 0){
        while($row = $result->fetch_assoc()) {
            $checkindate = $row["checkindate"];
            $doornumber = $row["doornumber"];
            $reservationdate = $row["reservationdate"];
            $checkoutdate = $row["checkoutdate"];
            $numberofpersons = $row["numberofpersons"];
            $totalprice = $row["totalprice"];
            $status = $row["status"];
            $roomtype = ucfirst($row["roomtype"]);
            $commentid = $row["commentid"];
            $commentdatetime = $row["datetime"];
            $commenttext = $row["text"];
            $commentrate = $row["rate"];
            $fname = $row["fname"];
            $lname = $row["lname"];

            $roomImg = $roomtype . "Room";

            if($row["status"] == "active") {
                $reservations .= 
                "
                <div class='card mt-4 shadow'> 
                    <div class='card-body'> 
                        <div class='row'> 
                            <div class='col-sm-4'> 
                                <img src='img/$roomImg.jpg' alt='Vip Room' 
                                    class='reservation-card-img card-img mx-auto d-block'> 
                            </div> 
                            <div class='col-sm-4 pl-5 pl-sm-0'> 
                                <span class='d-block font-weight-bold mt-4 mt-sm-0' 
                                    style='font-size: 1.2em;'>Reservation Continues</span> 
                                <span class='d-block mt-1'><strong>Room Type:</strong> $roomtype</span> 
                                <span class='d-block mt-1'><strong>Made on:</strong> $reservationdate</span> 
                                <span class='d-block mt-1'><strong>Dates:</strong> $checkindate - $checkoutdate</span> 
                                <span class='d-block mt-1'><strong>Room:</strong> $doornumber</span> 
                                <span class='d-block mt-1'><strong>Person Number:</strong> $numberofpersons Persons</span> 
                                <span class='d-block mt-1'><strong>Total Price:</strong> $totalprice USD</span> 
                            </div> 
                            <div class='m-auto'> 
                                <button class='btn-modal btn btn-primary mt-4 mt-sm-0 mb-4' data-toggle='modal' 
                                    data-target='#extendReservationModal'
                                    data-checkindate='$checkindate' data-doornumber='$doornumber'>Extend</button> 
                                <button class='btn-modal btn btn-primary mt-4 mt-sm-0 mb-4' data-toggle='modal' 
                                    data-target='#cancelReservationModal' 
                                    data-checkindate='$checkindate' data-doornumber='$doornumber'>Cancel</button> 
                            </div> 
                        </div> 
                    </div>
                </div>
                ";
            }
            else if($row["status"] == "canceled") {
                $reservations .= 
                "
                <div class='card mt-4 shadow'> 
                    <div class='card-body'> 
                        <div class='row'> 
                            <div class='col-sm-4'> 
                                <img src='img/$roomImg.jpg' alt='Vip Room' 
                                    class='reservation-card-img card-img mx-auto d-block'> 
                            </div> 
                            <div class='col-sm-4 pl-5 pl-sm-0'> 
                                <span class='d-block font-weight-bold mt-4 mt-sm-0' 
                                    style='font-size: 1.2em;'>Reservation Canceled</span> 
                                <span class='d-block mt-1'><strong>Room Type:</strong> $roomtype</span> 
                                <span class='d-block mt-1'><strong>Made on:</strong> $reservationdate</span> 
                                <span class='d-block mt-1'><strong>Dates:</strong> $checkindate - $checkoutdate</span> 
                                <span class='d-block mt-1'><strong>Room:</strong> $doornumber</span> 
                                <span class='d-block mt-1'><strong>Person Number:</strong> $numberofpersons Persons</span> 
                                <span class='d-block mt-1'><strong>Total Price:</strong> $totalprice USD</span> 
                            </div>  
                        </div> 
                    </div>
                </div>
                ";
            }
            else if($row["status"] == "ended") {
                if(!empty($commentid)) {
                    $stars = "";

                    for($i = 0; $i < (int)$commentrate; $i++)
                    {
                        $stars .= "<i class='fa fa-star checked'></i>";
                    }

                    for($i = 0; $i < 5 - (int)$commentrate; $i++)
                    {
                        $stars .= "<i class='fa fa-star'></i>";
                    }

                    $reservations .=
                    "
                    <div class='card mt-4 shadow'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-4'>
                                    <img src='img/$roomImg.jpg' alt='Single Room'
                                        class='reservation-card-img card-img mx-auto d-block'>
                                </div>
                                <div class='col-sm-4'>
                                    <span class='d-block font-weight-bold mt-4 mt-sm-0'
                                        style='font-size: 1.2em;'>Reservation Ended</span>
                                    <span class='d-block mt-1'><strong>Room Type:</strong> $roomtype</span> 
                                    <span class='d-block mt-1'><strong>Made on:</strong> $reservationdate</span> 
                                    <span class='d-block mt-1'><strong>Dates:</strong> $checkindate - $checkoutdate</span> 
                                    <span class='d-block mt-1'><strong>Room:</strong> $doornumber</span> 
                                    <span class='d-block mt-1'><strong>Person Number:</strong> $numberofpersons Persons</span> 
                                    <span class='d-block mt-1'><strong>Total Price:</strong> $totalprice USD</span> 
                                </div>
                                <div class='m-auto'>
                                </div>
                            </div>
                            <hr>
                            <div class='row'>
                                <div class='media review'>
                                    <img src='img/loginUserIcon.png' class='mr-3 room-reviews-user-icon'
                                        alt='User icon'>
                                    <div class='media-body'>
                                        <h5 class='mt-0'>$fname $lname</h5>
                                        <div class='rating-stars d-inline-block'>
                                            $stars
                                        </div>
                                        <div class='d-inline-block ml-3'>
                                            $commentdatetime
                                        </div>
                                        <div class='d-inline-block ml-5'>
                                            <button class='btn-modalReview btn btn-primary' data-toggle='modal'
                                                data-target='#editReviewModal'
                                                data-checkindate='$checkindate' data-doornumber='$doornumber' 
                                                data-commentid='$commentid' data-commenttext='$commenttext' data-commentrate='$commentrate'>
                                                <i class='fa fa-pencil'></i></button>
                                            <button class='btn-modalReview btn btn-primary' data-toggle='modal'
                                                data-target='#deleteReviewModal'
                                                data-checkindate='$checkindate' data-doornumber='$doornumber' 
                                                data-commentid='$commentid' data-commenttext='$commenttext' data-commentrate='$commentrate'>
                                                <i class='fa fa-trash'></i></button>
                                        </div>
                                        <span class='review-content d-block'>
                                            $commenttext
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                }
                else {
                    $reservations .=
                    "
                    <div class='card mt-4 shadow'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-sm-4'>
                                    <img src='img/$roomImg.jpg' alt='Family Room'
                                        class='reservation-card-img card-img mx-auto d-block'>
                                </div>
                                <div class='col-sm-4 pl-5 pl-sm-0'>
                                    <span class='d-block font-weight-bold mt-4 mt-sm-0'
                                        style='font-size: 1.2em;'>Reservation Ended</span>
                                    <span class='d-block mt-1'><strong>Room Type:</strong> $roomtype</span> 
                                    <span class='d-block mt-1'><strong>Made on:</strong> $reservationdate</span> 
                                    <span class='d-block mt-1'><strong>Dates:</strong> $checkindate - $checkoutdate</span> 
                                    <span class='d-block mt-1'><strong>Room:</strong> $doornumber</span> 
                                    <span class='d-block mt-1'><strong>Person Number:</strong> $numberofpersons Persons</span> 
                                    <span class='d-block mt-1'><strong>Total Price:</strong> $totalprice USD</span> 
                                </div>
                                <div class='m-auto'>
                                    <button class='btn-modal btn btn-primary mt-4 mt-sm-0 mb-4' data-toggle='modal'
                                        data-target='#makeReviewModal' 
                                        data-checkindate='$checkindate' data-doornumber='$doornumber'>Make a review</button>
                                </div>
                            </div>    
                        </div>
                    </div>
                    ";
                }
            }
        }
    } else {
        $reservations = "<div class='text-center w-100 mt-5' style='font-size:1.5em;'>You don't have any reservations yet</div>";
    }

    closedb($conn);
    echo $reservations;
}
else {
    header("Location: index.php");
}
?>