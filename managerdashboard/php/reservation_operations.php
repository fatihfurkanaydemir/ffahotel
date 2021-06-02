<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("
        SELECT res.doornumber, ro.roomtype, res.customerid, cus.fname, cus.lname, cus.status AS cusstatus,
        res.reservationdate, res.numberofpersons, res.checkindate, res.checkoutdate, res.status, 
        res.totalprice FROM reservation res 
        JOIN customer cus ON res.customerid = cus.id
        JOIN room ro ON ro.doornumber = res.doornumber
        ORDER BY res.status ASC, res.reservationdate DESC, res.checkindate
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $doornumber = $row["doornumber"];
                $roomtype = $row["roomtype"];
                $customerid = $row["customerid"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $reservationdate = $row["reservationdate"];
                $numberofpersons = $row["numberofpersons"];
                $checkindate = $row["checkindate"];
                $checkoutdate = $row["checkoutdate"];
                $status = $row["status"];
                $cusstatus = $row["cusstatus"];
                $totalprice = $row["totalprice"];

                $buttons = "";

                if($status == "active") {
                    $buttons .= "
                    <button type='button' style='padding: 7px;' class='btn-edit btn btn-primary' data-toggle='modal' data-target='#editReservationModal'
                    data-checkindate='$checkindate' data-checkoutdate='$checkoutdate' data-doornumber='$doornumber'>
                        <i class='fa fa-pencil'></i>
                    </button>
                    ";

                    if($cusstatus == "in" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkout btn btn-primary'
                        data-customerid='$customerid' data-checkindate='$checkindate' data-doornumber='$doornumber'>
                            <i class='fa fa-sign-out'></i>
                        </button>
                        ";
                    }
                    else {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-cancel btn btn-primary'
                        data-checkindate='$checkindate' data-doornumber='$doornumber' data-toggle='modal' data-target='#cancelReservationModal'>
                            <i class='fa fa-times'></i>
                        </button>
                        ";
                    }
                    if($cusstatus == "out" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkin btn btn-primary'
                        data-customerid='$customerid'>
                            <i class='fa fa-sign-in'></i>
                        </button>
                        ";
                    }
                }
            
                $tableContent .= 
                "
                <tr>
                    <td>$doornumber</td>
                    <td>$roomtype</td>
                    <td>$customerid</td>
                    <td>$fname $lname</td>
                    <td>$reservationdate</td>
                    <td>$numberofpersons</td>
                    <td>$checkindate</td>
                    <td>$checkoutdate</td>
                    <td>$status</td>
                    <td>$totalprice</td>
                  <td>
                      $buttons
                  </td>
                </tr>
                ";
            }
        }
        closedb($conn);

        echo $tableContent;
    }
    else if(isset($_POST["checkin"])) {
        $customerid = test_input($_POST["customerid"]);

        $conn = connectdb();

        $sql = "UPDATE customer SET status='in' WHERE id='$customerid'";

        $result = $conn->query($sql);

        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }

        closedb($conn);
    }

    else if(isset($_POST["checkout"])) {
        $customerid = test_input($_POST["customerid"]);
        $checkindate = test_input($_POST["checkindate"]);
        $doornumber = test_input($_POST["doornumber"]);

        $conn = connectdb();

        $sql = "UPDATE customer SET status='out' WHERE id='$customerid'";

        $result = $conn->query($sql);

        closedb($conn);

        if($result !== true) {
            echo "err";
            die();
        }

        $conn = connectdb();

        $sql = "UPDATE reservation SET status='ended' WHERE checkindate='$checkindate' AND doornumber=$doornumber";

        $result = $conn->query($sql);

        closedb($conn);

        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }
    }
    else if(isset($_POST["cancel"])) {
        $checkindate = test_input($_POST["checkindate"]);
        $doornumber = test_input($_POST["doornumber"]);

        $conn = connectdb();

        $sql = "UPDATE reservation SET status='canceled' WHERE checkindate='$checkindate' AND doornumber=$doornumber";

        $result = $conn->query($sql);

        closedb($conn);

        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }
    }
    else if(isset($_POST["checkdoornumber"])) {
        $checkinDate = test_input($_POST["checkindate"]);
        $checkoutDate = test_input($_POST["checkoutdate"]);
        $oldcheckindate = test_input($_POST["oldcheckindate"]);
        $doornumber = test_input($_POST["doornumber"]);

        $conn = connectdb();

        $result = $conn->query("SELECT * FROM room WHERE doornumber=$doornumber");
        
        if($result->num_rows == 0) {
            echo "err-room";
            closedb($conn);
            die();
        }
        
        closedb($conn);

        if(empty($doornumber)) {
            echo "err-notvalid";
            die();
        }

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
            closedb($conn);
            die();
        }
        
        closedb($conn);
        
        echo "true";
    }
    else if(isset($_POST["edit"])) {
        $checkindate = $_POST["checkindate"];
        $checkoutdate = $_POST["checkoutdate"];
        $oldcheckindate = $_POST["oldcheckindate"];
        $doornumber = $_POST["doornumber"];
        $olddoornumber = $_POST["olddoornumber"];

        $conn = connectdb();

        $sql = "SELECT (DATEDIFF('$checkoutdate', '$checkindate') + 1) * 
            (SELECT rp.price FROM room ro JOIN roomprice rp ON ro.roomtype = rp.roomtype
             WHERE ro.doornumber = '$doornumber') AS totalprice";

        $result = $conn->query($sql);
        $totalprice = $result->fetch_assoc()["totalprice"];

        $sql = "UPDATE reservation SET checkindate='$checkindate', checkoutdate='$checkoutdate', totalprice='$totalprice', doornumber=$doornumber
                WHERE checkindate='$oldcheckindate' AND doornumber='$olddoornumber'";

        $result = $conn->query($sql);

        if($result == true) {
            echo "true";
        }
        else {
            echo "err";
        }

        closedb($conn);
        die();
    }
    else if(isset($_POST["add"])) {
        $checkindate = test_input($_POST["checkindate"]);
        $checkoutdate = test_input($_POST["checkoutdate"]);
        $doornumber = test_input($_POST["doornumber"]);
        $customerid = test_input($_POST["customerid"]);
        $numberofpersons = test_input($_POST["numberofpersons"]);

        if(empty($doornumber) || empty($customerid) || empty($checkindate) || empty($checkoutdate) || empty($numberofpersons)) {
            echo "err-notvalid";
            die();
        }

        if($checkoutdate < $checkindate) 
        {
            echo "err-date"; 
            die();
        }

        $conn = connectdb();

        $result = $conn->query("SELECT * FROM room WHERE doornumber=$doornumber");
        
        if($result->num_rows == 0) {
            echo "err-room";
            closedb($conn);
            die();
        }
                
        $result = $conn->query("SELECT * FROM customer WHERE id=$customerid");
        
        if($result->num_rows == 0) {
            echo "err-customer";
            closedb($conn);
            die();
        }
        
        $sql = 
        "
        (SELECT res.checkindate
        FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
        WHERE res.status = 'active' AND res.doornumber = $doornumber AND
        ((res.checkindate BETWEEN '$checkindate' AND '$checkoutdate') OR
        (res.checkoutdate BETWEEN '$checkindate' AND '$checkoutdate') OR
        (res.checkindate < '$checkindate' AND res.checkoutdate > '$checkoutdate')))";

        $conn = connectdb();

        $result = $conn->query($sql);
        
        if($result->num_rows != 0) {
            echo "err-norooms";
            closedb($conn);
            die();
        }

        $sql = "SELECT (DATEDIFF('$checkoutdate', '$checkindate') + 1) * 
            (SELECT rp.price FROM room ro JOIN roomprice rp ON ro.roomtype = rp.roomtype
             WHERE ro.doornumber = '$doornumber') AS totalprice";

        $result = $conn->query($sql);
        $totalprice = $result->fetch_assoc()["totalprice"];

        $sql = "INSERT INTO reservation VALUES
        ('$customerid', DATE(NOW()), '$checkindate', '$checkoutdate', $numberofpersons, $totalprice, NULL, $doornumber, 'active')";
        
        $result = $conn->query($sql);

        closedb($conn);

        if($result === true) {
            echo "true";
        } else {
            echo "err";
        }
    }
    if(isset($_POST["searchname"])) {
        $customername = test_input($_POST["customername"]);

        if(empty($customername)) {
            echo "err-notvalid";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("
        SELECT res.doornumber, ro.roomtype, res.customerid, cus.fname, cus.lname, cus.status AS cusstatus,
        res.reservationdate, res.numberofpersons, res.checkindate, res.checkoutdate, res.status, 
        res.totalprice FROM reservation res 
        JOIN customer cus ON res.customerid = cus.id
        JOIN room ro ON ro.doornumber = res.doornumber
        WHERE CONCAT(cus.fname, ' ', cus.lname) LIKE '%$customername%'
        ORDER BY res.status ASC, res.reservationdate DESC, res.checkindate
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $doornumber = $row["doornumber"];
                $roomtype = $row["roomtype"];
                $customerid = $row["customerid"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $reservationdate = $row["reservationdate"];
                $numberofpersons = $row["numberofpersons"];
                $checkindate = $row["checkindate"];
                $checkoutdate = $row["checkoutdate"];
                $status = $row["status"];
                $cusstatus = $row["cusstatus"];
                $totalprice = $row["totalprice"];

                $buttons = "";

                if($status == "active") {
                    $buttons .= "
                    <button type='button' style='padding: 7px;' class='btn-edit btn btn-primary' data-toggle='modal' data-target='#editReservationModal'
                    data-checkindate='$checkindate' data-checkoutdate='$checkoutdate' data-doornumber='$doornumber'>
                        <i class='fa fa-pencil'></i>
                    </button>
                    ";

                    if($cusstatus == "in" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkout btn btn-primary'
                        data-customerid='$customerid' data-checkindate='$checkindate' data-doornumber='$doornumber'>
                            <i class='fa fa-sign-out'></i>
                        </button>
                        ";
                    }
                    else {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-cancel btn btn-primary'
                        data-checkindate='$checkindate' data-doornumber='$doornumber' data-toggle='modal' data-target='#cancelReservationModal'>
                            <i class='fa fa-times'></i>
                        </button>
                        ";
                    }
                    if($cusstatus == "out" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkin btn btn-primary'
                        data-customerid='$customerid'>
                            <i class='fa fa-sign-in'></i>
                        </button>
                        ";
                    }
                }
            
                $tableContent .= 
                "
                <tr>
                    <td>$doornumber</td>
                    <td>$roomtype</td>
                    <td>$customerid</td>
                    <td>$fname $lname</td>
                    <td>$reservationdate</td>
                    <td>$numberofpersons</td>
                    <td>$checkindate</td>
                    <td>$checkoutdate</td>
                    <td>$status</td>
                    <td>$totalprice</td>
                  <td>
                      $buttons
                  </td>
                </tr>
                ";
            }
        }
        closedb($conn);

        echo $tableContent;
    }
    if(isset($_POST["searchdate"])) {
        $startdate = test_input($_POST["startdate"]);
        $enddate = test_input($_POST["enddate"]);

        if(empty($startdate) || empty($enddate)) {
            echo "err-notvalid";
            die();
        }

        if($enddate < $startdate) {
            echo "err-date";
            die();
        }
        
        $conn = connectdb();

        $result = $conn->query("
        SELECT res.doornumber, ro.roomtype, res.customerid, cus.fname, cus.lname, cus.status AS cusstatus,
        res.reservationdate, res.numberofpersons, res.checkindate, res.checkoutdate, res.status, 
        res.totalprice FROM reservation res 
        JOIN customer cus ON res.customerid = cus.id
        JOIN room ro ON ro.doornumber = res.doornumber
        WHERE res.reservationdate BETWEEN '$startdate' AND '$enddate'
        ORDER BY res.status ASC, res.reservationdate DESC, res.checkindate
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $doornumber = $row["doornumber"];
                $roomtype = $row["roomtype"];
                $customerid = $row["customerid"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $reservationdate = $row["reservationdate"];
                $numberofpersons = $row["numberofpersons"];
                $checkindate = $row["checkindate"];
                $checkoutdate = $row["checkoutdate"];
                $status = $row["status"];
                $cusstatus = $row["cusstatus"];
                $totalprice = $row["totalprice"];

                $buttons = "";

                if($status == "active") {
                    $buttons .= "
                    <button type='button' style='padding: 7px;' class='btn-edit btn btn-primary' data-toggle='modal' data-target='#editReservationModal'
                    data-checkindate='$checkindate' data-checkoutdate='$checkoutdate' data-doornumber='$doornumber'>
                        <i class='fa fa-pencil'></i>
                    </button>
                    ";

                    if($cusstatus == "in" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkout btn btn-primary'
                        data-customerid='$customerid' data-checkindate='$checkindate' data-doornumber='$doornumber'>
                            <i class='fa fa-sign-out'></i>
                        </button>
                        ";
                    }
                    else {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-cancel btn btn-primary'
                        data-checkindate='$checkindate' data-doornumber='$doornumber' data-toggle='modal' data-target='#cancelReservationModal'>
                            <i class='fa fa-times'></i>
                        </button>
                        ";
                    }
                    if($cusstatus == "out" && date("Y-m-d") >= $checkindate &&  date("Y-m-d") <= $checkoutdate) {
                        $buttons .= "
                        <button type='button' style='padding: 7px;' class='btn-checkin btn btn-primary'
                        data-customerid='$customerid'>
                            <i class='fa fa-sign-in'></i>
                        </button>
                        ";
                    }
                }
            
                $tableContent .= 
                "
                <tr>
                    <td>$doornumber</td>
                    <td>$roomtype</td>
                    <td>$customerid</td>
                    <td>$fname $lname</td>
                    <td>$reservationdate</td>
                    <td>$numberofpersons</td>
                    <td>$checkindate</td>
                    <td>$checkoutdate</td>
                    <td>$status</td>
                    <td>$totalprice</td>
                  <td>
                      $buttons
                  </td>
                </tr>
                ";
            }
        }
        closedb($conn);

        echo $tableContent;
    }
}


?>