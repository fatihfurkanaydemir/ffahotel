<?php 
session_start();

include "../dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_SESSION["uid"];

    $conn = connectdb();

    $sql = "SELECT * FROM reservation WHERE customerid=$id";
    $result = $conn->query($sql);

    $returnval = array("customerid" => $id);
    $reservations = array();

    if($result->num_rows != 0){
        $index = 0;
        while($row = $result->fetch_assoc()) {
            $checkindate = $row["checkindate"];
            $doornumber = $row["doornumber"];

            $reservation["reservationdate"] = $row["reservationdate"];
            $reservation["checkindate"] = $checkindate;
            $reservation["checkoutdate"] = $row["checkoutdate"];
            $reservation["numberofpersons"] = $row["numberofpersons"];
            $reservation["totalprice"] = $row["totalprice"];
            $reservation["commentid"] = $row["commentid"];
            $reservation["doornumber"] = $doornumber;
            $reservation["status"] = $row["status"];

            array_push($reservations, $reservation);
        }
    }

    $returnval["reservations"] = $reservations;

    closedb($conn);

    echo json_encode($returnval);
}
else {
    header("Location: ../index.php");
}
?>