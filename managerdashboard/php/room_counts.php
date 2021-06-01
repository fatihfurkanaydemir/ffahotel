<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    include "../../dbconnect.php";

    $conn = connectdb();

    $totalCount = $conn->query("SELECT COUNT(*) AS count FROM room")->fetch_assoc()["count"];

    $sql = "SELECT COUNT(*) AS bookingcount FROM reservation res 
    JOIN customer cus ON res.customerid = cus.id
    JOIN room ro ON ro.doornumber = res.doornumber
    WHERE res.status = 'active' AND cus.status = 'out'";

    $bookingCount = $conn->query($sql)->fetch_assoc()["bookingcount"];

    $sql = "SELECT COUNT(*) AS bookedcount FROM reservation res 
    JOIN customer cus ON res.customerid = cus.id
    JOIN room ro ON ro.doornumber = res.doornumber
    WHERE res.status = 'active' AND cus.status = 'in' AND
    NOW() BETWEEN res.checkindate AND res.checkoutdate";

    $bookedCount = $conn->query($sql)->fetch_assoc()["bookedcount"];

    $sql = "SELECT COUNT(*) AS emptycount FROM room 
    WHERE doornumber NOT IN
    (SELECT ro.doornumber 
    FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
    WHERE res.status = 'active' AND 
    ((res.checkindate BETWEEN NOW() AND NOW()) OR
    (res.checkoutdate BETWEEN NOW() AND NOW()) OR
    (res.checkindate < NOW() AND res.checkoutdate > NOW())))";

    $emptyCount = $conn->query($sql)->fetch_assoc()["emptycount"];


    closedb($conn);

    $counts = array();

    $counts["totalcount"] = $totalCount;
    $counts["bookingcount"] = $bookingCount;
    $counts["bookedcount"] = $bookedCount;
    $counts["emptycount"] = $emptyCount;

    echo json_encode($counts);
}
?>
