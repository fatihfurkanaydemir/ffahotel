<?php
//session_name("user");
session_start();

include "../dbconnect.php";
include "../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_SESSION["logged_in"])) {
        $id = $_SESSION["uid"];
        $checkindate = $_SESSION["reservationinfo"]["checkindate"];
        $checkoutdate = $_SESSION["reservationinfo"]["checkoutdate"];
        $numberofpersons = $_SESSION["reservationinfo"]["numberofpersons"];
        $totalprice = $_SESSION["reservationinfo"]["totalprice"];
        $doornumber =  $_SESSION["reservationinfo"]["doornumber"];
        $cardnumber = test_input($_POST["cardnumber"]);
        $nameoncard = test_input($_POST["nameoncard"]);
        $expirationdate = test_input($_POST["expirationdate"]);
        $cvc = test_input($_POST["cvc"]);

        if(empty($cardnumber) || empty($nameoncard) || empty($expirationdate) || empty($cvc)) {
            echo "err-notvalid";
            die();
        }

        if(strlen($cvc) < 3 || ((int)$cvc < 0)) {
            echo "err-cvc";
            die();
        }

        if(strlen($cardnumber) != 16 || ((int)$cardnumber) < 0) {
            echo "err-cardnumber";
            die();
        }

        if($expirationdate < date("Y-m")) {
            echo "err-expirationdate";
            die();
        }

        $conn = connectdb();
        
        $sql = "INSERT INTO reservation (customerid, reservationdate, checkindate, checkoutdate, numberofpersons, totalprice, commentid, doornumber, status) VALUES 
                ('$id', DATE(NOW()), '$checkindate', '$checkoutdate', $numberofpersons, $totalprice, NULL, $doornumber, 'active')";

        $result = $conn->query($sql);
        
        if($result == true) {
            echo "true";
            unset($_SESSION["reservationinfo"]);
        }else {
            echo "err";
            echo $conn->error;
        }

        closedb($conn);
    }
    else {
        $id = test_input($_POST["idnumber"]);
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $phonenumber = test_input($_POST["phonenumber"]);
        $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $birthdate = test_input($_POST["birthdate"]);

        if(empty($id) || empty($fname) || empty($lname) || empty($phonenumber) || empty($email) || empty($birthdate)) {
            echo "err-notvalid";
            die();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "err-email";
            die();
        }
        if(!validatePhoneNumber($phonenumber)) {
            echo "err-phonenumber";
            die();
        }  
        if(!validateIDNumber($id)) {
            echo "err-idnumber";
            die();
        }

        switch(checkRegistration($id, $email)) {
            case "newcus":
                $conn = connectdb();
                $sql = "INSERT INTO customer VALUES($id, '$fname', '$lname', '$birthdate', '$phonenumber', '$email', NULL, 'out')";
                if ($conn->query($sql) !== TRUE) {
                    echo "err";
                    closedb($conn);
                    die();
                }
                break;
            case "cusexists": break;
            case "err-emailused": echo "err-emailused"; die(); break;
            case "err-idused": echo "err-idused"; die(); break;
            case "err-accountexistsid": echo "err-accountexistsid"; die(); break;
            case "err-accountexistsemail": echo "err-accountexistsemail"; die(); break;
            default: echo "err"; die(); break;
        }

        $checkindate = $_SESSION["reservationinfo"]["checkindate"];
        $checkoutdate = $_SESSION["reservationinfo"]["checkoutdate"];
        $numberofpersons = $_SESSION["reservationinfo"]["numberofpersons"];
        $totalprice = $_SESSION["reservationinfo"]["totalprice"];
        $doornumber =  $_SESSION["reservationinfo"]["doornumber"];
        $cardnumber = test_input($_POST["cardnumber"]);
        $nameoncard = test_input($_POST["nameoncard"]);
        $expirationdate = test_input($_POST["expirationdate"]);
        $cvc = test_input($_POST["cvc"]);

        if(empty($cardnumber) || empty($nameoncard) || empty($expirationdate) || empty($cvc)) {
            echo "err-notvalid";
            die();
        }

        if(strlen($cvc) < 3 || ((int)$cvc < 0)) {
            echo "err-cvc";
            die();
        }

        if(strlen($cardnumber) != 16 || ((int)$cardnumber) < 0) {
            echo "err-cardnumber";
            die();
        }

        if($expirationdate < date("Y-m")) {
            echo "err-expirationdate";
            die();
        }

        $conn = connectdb();
        
        $sql = "INSERT INTO reservation VALUES
                ('$id', DATE(NOW()), '$checkindate', '$checkoutdate', $numberofpersons, $totalprice, NULL, $doornumber, 'active')";

        $result = $conn->query($sql);
        
        if($result == true) {
            echo "true";
            unset($_SESSION["reservationinfo"]);
        }else {
            echo "err";
            echo $conn->error;
        }

        closedb($conn);
    }
} else {
    header("Location: ../index.php");
}

function checkRegistration($id, $email) {
    $conn = connectdb();

    $sql = "SELECT id, email, password FROM customer WHERE id = $id";
    $result = $conn->query($sql);

    $q1id = $q1email = "";
    $q2id = $q2email = "";

    if($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        if($row["password"] != "") {    
            closedb($conn);
            return "err-accountexistsid";
        }
        $q1id = $row["id"];
        $q1email = $row["email"];
    }

    $sql = "SELECT id, email, password FROM customer WHERE email = '$email'";
    $result = $conn->query($sql);

    if($result->num_rows != 0) {
        $row = $result->fetch_assoc();
        if($row["password"] != "") {
            closedb($conn);
            return "err-accountexistsemail";
        }
        $q2id = $row["id"];
        $q2email = $row["email"];
    }

    closedb($conn);

    if($q1id == "" && $q2id == "") {
        return "newcus";
    }
    else if($q1email == $q2email && $q1id == $q2id) {
        return "cusexists";
    }
    else if($q2email != "") {
        return "err-emailused";
    }
    else if($q1id != "") {
        return "err-idused";
    }
}
?>