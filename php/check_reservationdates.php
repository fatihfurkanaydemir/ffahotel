<?php
    include "../dbconnect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["checkdate"])) {
            $checkinDate = $_POST["checkindate"];
            $checkoutDate = $_POST["checkoutdate"];

            if($checkoutDate < $checkinDate) 
            {
                echo "err-date"; 
                die();
            }

            $sql = 
            "SELECT doornumber FROM room 
              WHERE doornumber NOT IN
            (SELECT ro.doornumber 
            FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
            WHERE res.status = 'active' AND
             ((res.checkindate <= '$checkinDate' AND res.checkoutdate >= '$checkoutDate') OR
             (res.checkindate < '$checkoutDate' AND res.checkoutdate >= '$checkoutDate') OR
             (res.checkindate >= '$checkinDate' AND res.checkindate < '$checkoutDate')))";

             $conn = connectdb();

             $result = $conn->query($sql);

             closedb($conn);

             if($result->num_rows == 0) {
                 echo "err-norooms";
                 die();
             }


            echo "true";
        }
        else if(isset($_POST["checkroom"])) {
            $checkinDate = $_POST["checkindate"];
            $checkoutDate = $_POST["checkoutdate"];
            $roomType = $_POST["roomtype"];

            if($checkoutDate < $checkinDate) 
            {
                echo "err-date"; 
                die();
            }

            $sql = 
            "SELECT doornumber FROM room 
              WHERE roomtype = '$roomType' AND doornumber NOT IN
            (SELECT ro.doornumber 
            FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
            WHERE res.status = 'active' AND 
             ((res.checkindate <= '$checkinDate' AND res.checkoutdate >= '$checkoutDate') OR
             (res.checkindate < '$checkoutDate' AND res.checkoutdate >= '$checkoutDate') OR
             (res.checkindate >= '$checkinDate' AND res.checkindate < '$checkoutDate')))";

             $conn = connectdb();

             $result = $conn->query($sql);

             closedb($conn);

             if($result->num_rows == 0) {
                 echo "err-norooms";
                 die();
             }


            echo "true";
        }
        
    }
?>