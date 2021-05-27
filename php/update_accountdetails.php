<?php

include "../dbconnect.php";
include "../validations.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Update account details
    $conn = connectdb();

    $uid = $_SESSION["uid"];
    $sql = "SELECT fname, lname, phonenumber, birthdate, email FROM customer WHERE id = $uid";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $email = $row["email"];

    closedb($conn);

    $newfname = test_input($_POST["fname"]);
    $newlname = test_input($_POST["lname"]);
    $newphoneNumber = test_input($_POST["phonenumber"]);
    $newidNumber = test_input($_POST["idnumber"]);
    $newemail = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $newbirthdate = test_input($_POST["birthdate"]);

    if(empty($newfname) || empty($newlname) || empty($newphoneNumber) || empty($newemail) || empty($newidNumber) || empty($newbirthdate)) {
        echo "err-notvalid";
        die();
    }  

    if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {

        echo "err-email";
        die();
    }
    if(!validatePhoneNumber($newphoneNumber)) {
        echo "err-phonenumber";
        die();
    }  

    if(!validateIDNumber($newidNumber)) {
        echo "err-idnumber";
        die();
    }

    if($uid != $newidNumber) {
        $conn = connectdb();

        $sql = "SELECT id FROM customer WHERE id=$newidNumber";
        $result = $conn->query($sql);

        if($result->num_rows != 0) {
            echo "err-duplicateid";
            die();
        }
        closedb($conn);
    }

    if($email != $newemail) {
        $conn = connectdb();

        $sql = "SELECT email FROM customer WHERE email='$newemail'";
        $result = $conn->query($sql);
        
        if($result->num_rows != 0) {
            echo "err-duplicateemail";
            die();
        }

        closedb($conn);
    }

    $conn = connectdb();

    $sql = "UPDATE customer SET
            fname = '$newfname',
            lname = '$newlname',
            email = '$newemail',
            phonenumber = '$newphoneNumber',
            id = $newidNumber,
            birthdate = '$newbirthdate' WHERE id = $uid";

    $result = $conn->query($sql);

    if($result == true) {
        echo "true";
        die();

    } else {
        echo "err";
        die();
    }
    
    closedb($conn);
    
}
?>