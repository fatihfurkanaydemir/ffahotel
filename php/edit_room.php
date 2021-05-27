<?php
include "../dbconnect.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $doornumber = $_POST["doornumber"];
    $newdoornumber = $_POST["newdoornumber"];
    $roomtype = $_POST["roomtype"];
    $floor = $_POST["floor"];

    if(empty($newdoornumber)) {
        echo "err-notvalid";
        die();
    }

    $conn = connectdb();
        
    $sql = "UPDATE room SET doornumber=$newdoornumber, roomtype='$roomtype', floor=$floor WHERE doornumber=$doornumber";
    $result = $conn->query($sql);

    closedb($conn);


    if($result === true) {
        echo "true";
        die();
    } else {
        echo "err-roomexists";
        die();
    }
} 
?>