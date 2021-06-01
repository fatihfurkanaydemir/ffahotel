<?php
    include "../../dbconnect.php";

    $doornumber = $_GET["doornumber"];

    $conn = connectdb();

    $result = $conn->query("SELECT * FROM room WHERE doornumber=$doornumber");

    $row = $result->fetch_assoc();
    $room = array();

    $room["doornumber"] = (int)$doornumber;
    $room["roomtype"] = $row["roomtype"];
    $room["floor"] = (int)$row["floor"];

    echo json_encode($room);

    closedb($conn);
?>