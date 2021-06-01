<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../../dbconnect.php";

    $conn = connectdb();

    $roomcount = $conn->query("SELECT COUNT(*) AS roomcount FROM room")->fetch_assoc()["roomcount"];

    $customercount = $conn->query("SELECT COUNT(*) AS customercount FROM customer")->fetch_assoc()["customercount"];

    $avgrate = $conn->query("SELECT cast(AVG(rate) as decimal(6,1)) AS avgrate FROM comment")->fetch_assoc()["avgrate"];

    $revenuethismonth = $conn->query("SELECT SUM(totalprice) AS revenuethismonth FROM reservation
                                    WHERE status != 'canceled' AND reservationdate BETWEEN
                                    (SELECT DATE_SUB('2021-05-10',INTERVAL DAYOFMONTH('2021-05-10')-1 DAY)) AND
                                    (SELECT LAST_DAY('2021-08-10'))")->fetch_assoc()["revenuethismonth"]; 

    $expensethismonth = $conn->query("SELECT SUM(amount) AS expensethismonth FROM expense
                                    WHERE date BETWEEN
                                    (SELECT DATE_SUB('2021-05-10',INTERVAL DAYOFMONTH('2021-05-10')-1 DAY)) AND
                                    (SELECT LAST_DAY('2021-08-10'))")->fetch_assoc()["expensethismonth"]; 
                                    


    closedb($conn);

    $counts = array();

    $counts["roomcount"] = $roomcount;
    $counts["customercount"] = $customercount;
    $counts["avgrate"] = $avgrate;
    $counts["revenuethismonth"] = $revenuethismonth;
    $counts["expensethismonth"] = $expensethismonth;

    echo json_encode($counts);
}
?>
