<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("SELECT * FROM roomprice");

        $roomtypes = array();

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $type = array();
                $type["roomtype"] = $row["roomtype"];
                $type["price"] = (float)$row["price"];

                array_push($roomtypes, $type);
            }
        }

        closedb($conn);

        echo json_encode($roomtypes);
    }

    else if(isset($_POST["update"])) {
        $roomtype = test_input($_POST["roomtype"]);
        $price = test_input($_POST["price"]);

        if(empty($roomtype) || empty($price)) {
            echo "err-notvalid";
            die();
        }

        if((float)$price <= 0) {
            echo "err-price";
            die();
        }

        $conn = connectdb();


        $result = $conn->query("UPDATE roomprice SET price = $price WHERE roomtype = '$roomtype'");

        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }

        closedb($conn);
    }
}


?>