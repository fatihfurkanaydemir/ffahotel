<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../../dbconnect.php";

    $conn = connectdb();

    $roomcount = $conn->query("SELECT COUNT(*) AS roomcount FROM room")->fetch_assoc()["roomcount"];

    $customercount = $conn->query("SELECT COUNT(*) AS customercount FROM customer")->fetch_assoc()["customercount"];

    $avgrate = $conn->query("SELECT cast(AVG(rate) as decimal(6,1)) AS avgrate FROM comment")->fetch_assoc()["avgrate"];

    $revenuethismonth = $conn->query("SELECT SUM(totalprice) AS revenuethismonth FROM reservation
                                    WHERE status != 'canceled' AND reservationdate BETWEEN
                                    (SELECT DATE_SUB(DATE(NOW()),INTERVAL DAYOFMONTH(DATE(NOW()))-1 DAY)) AND
                                    (SELECT LAST_DAY(DATE(NOW())))")->fetch_assoc()["revenuethismonth"]; 

    $expensethismonth = $conn->query("SELECT SUM(amount) AS expensethismonth FROM expense
                                    WHERE date BETWEEN
                                    (SELECT DATE_SUB(DATE(NOW()),INTERVAL DAYOFMONTH(DATE(NOW()))-1 DAY)) AND
                                    (SELECT LAST_DAY(DATE(NOW())))")->fetch_assoc()["expensethismonth"]; 
                                    


    $counts = array();

    $counts["roomcount"] = $roomcount;
    $counts["customercount"] = $customercount;
    $counts["avgrate"] = $avgrate;
    $counts["revenuethismonth"] = $revenuethismonth;
    $counts["expensethismonth"] = $expensethismonth;


    // Chart data
    $days = array();

    $result = $conn->query("
    SELECT reservationdate, totalprice
    FROM reservation 
    WHERE reservationdate BETWEEN 
    (SELECT DATE_SUB(DATE(NOW()),INTERVAL DAYOFMONTH(DATE(NOW()))-1 DAY)) AND
    (SELECT LAST_DAY(DATE(NOW())))
    "); 

    if($result->num_rows != 0) {
        while($row = $result->fetch_assoc())
        {
            $reservationdate = $row["reservationdate"];
            $totalprice = $row["totalprice"];
            $day = array();
            $day["date"] = $reservationdate;
            //$day["revenue"] = (int)$totalprice;
            //$day["expense"] = 0;
            $day["customercount"] = 1;
            array_push($days, $day);
        }
    }

    //Expense data
    /*$result = $conn->query("
    SELECT amount, date
    FROM expense 
    WHERE date BETWEEN '$startdate' AND '$enddate'
    "); 

    if($result->num_rows != 0) {
        while($row = $result->fetch_assoc())
        {
            $amount = $row["amount"];
            $date = $row["date"];

            $day = array();

            $day["date"] = $date;
            $day["revenue"] = 0;
            $day["expense"] = (int)$amount;
            $day["customercount"] = 0;
            array_push($days, $day);
        }
    }*/

    $counts["days"] = $days;

    closedb($conn);

    echo json_encode($counts);
}
?>
