<?php 
    include "../../dbconnect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomtype = $_POST["roomtype"];
        $floor = $_POST["floor"];
        $doornumber = $_POST["doornumber"];

        if(empty($roomtype) || empty($floor) || empty($doornumber)) {
            echo "err-notvalid";
            die();
        }

        $conn = connectdb();

        $sql = "INSERT INTO room VALUES($doornumber, '$roomtype', $floor)";
        $result = $conn->query($sql);

        closedb($conn);

        if($result == true) {
            echo "true";
            die();
        } else {
            echo "err-roomexists";
            die();
        }
    }
?>