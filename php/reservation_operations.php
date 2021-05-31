<?php 
session_start();

include "../dbconnect.php";
include "../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $checkindate = $_POST["checkindate"];
    $doornumber = $_POST["doornumber"];
    
    if(isset($_POST["cancel"])) {
        $conn = connectdb();

        $sql = "UPDATE reservation SET status='canceled'
                WHERE checkindate='$checkindate' AND doornumber='$doornumber'";

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
    else if(isset($_POST["extend"])) {

    }
    else if(isset($_POST["makereview"])) {
        $commenttext = test_input($_POST["commenttext"]);
        $commentrate = $_POST["commentrate"];

        $conn = connectdb();

        $sql = "INSERT INTO comment (datetime, text, rate) 
        VALUES (NOW(), '$commenttext', '$commentrate')";

        $result = $conn->query($sql);

        if($result != true) {
            echo "err";
            closedb($conn);
            die();
        }

        $lastId = $conn->insert_id;

        $sql = "UPDATE reservation SET commentid='$lastId'
        WHERE checkindate='$checkindate' AND doornumber='$doornumber'";

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
    else if(isset($_POST["deletereview"])) {
        $commentid = $_POST["commentid"];

        $conn = connectdb();

        $sql = "DELETE FROM comment
                WHERE id='$commentid'";

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
    else if(isset($_POST["editreview"])) {
        $commenttext = test_input($_POST["commenttext"]);
        $commentrate = $_POST["commentrate"];
        $commentid = $_POST["commentid"];

        $conn = connectdb();

        $sql = "UPDATE comment SET text='$commenttext', rate='$commentrate' WHERE id='$commentid'";

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

}else {
    header("Location: ../index.php");
}

?>