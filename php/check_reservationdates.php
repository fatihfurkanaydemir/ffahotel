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
            ((res.checkindate BETWEEN '$checkinDate' AND '$checkoutDate') OR
             (res.checkoutdate BETWEEN '$checkinDate' AND '$checkoutDate') OR
             (res.checkindate < '$checkinDate' AND res.checkoutdate > '$checkoutDate')))";

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
             ((res.checkindate BETWEEN '$checkinDate' AND '$checkoutDate') OR
             (res.checkoutdate BETWEEN '$checkinDate' AND '$checkoutDate') OR
             (res.checkindate < '$checkinDate' AND res.checkoutdate > '$checkoutDate')))";


             $conn = connectdb();

             $result = $conn->query($sql);

             closedb($conn);

             if($result->num_rows == 0) {
                 echo "err-norooms";
                 die();
             }


            echo "true";
        }
        else if(isset($_POST["checkdoornumber"])) {
            $checkinDate = $_POST["checkindate"];
            $checkoutDate = $_POST["checkoutdate"];
            $oldcheckindate = $_POST["oldcheckindate"];
            $oldcheckoutdate = $_POST["oldcheckoutdate"];
            $doornumber = $_POST["doornumber"];

            if($checkoutDate < $checkinDate) 
            {
                echo "err-date"; 
                die();
            }

            $sql = 
            "
            (SELECT res.checkindate
            FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
            WHERE res.status = 'active' AND res.checkindate != '$oldcheckindate' AND res.doornumber = $doornumber AND
            ((res.checkindate BETWEEN '$checkinDate' AND '$checkoutDate') OR
            (res.checkoutdate BETWEEN '$checkinDate' AND '$checkoutDate') OR
            (res.checkindate < '$checkinDate' AND res.checkoutdate > '$checkoutDate')))";

            $conn = connectdb();

            $result = $conn->query($sql);
            
            if($result->num_rows != 0) {
                echo "err-norooms";
                die();
            }
            
            closedb($conn);
            
            echo "true";
        }
        
    }
?>