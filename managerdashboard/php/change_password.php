<?php 
include "../../dbconnect.php";
include "../../validations.php";

session_name("manager");
session_start();

//Update password
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $oldpassword = test_input($_POST["oldpassword"]);
    $newpassword = test_input($_POST["newpassword"]);
    $newpasswordagain = test_input($_POST["newpasswordagain"]);

    if(empty($oldpassword) || empty($newpassword) || empty($newpasswordagain)) {
        echo "err-notvalid";
        die();
    } 

    $mid = $_SESSION["mid"];
    $conn = connectdb();

    $sql = "SELECT password FROM manager WHERE id = $mid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $oldpass = $row["password"];

    closedb($conn);

    if(!password_verify($oldpassword, $oldpass)) {
        echo "err-oldpswdwrong";
        die();
    }

    if(strcmp($newpassword, $newpasswordagain) != 0) {
        echo "err-pswdnomatch";
        die();
    }

    $conn = connectdb();
    $newEncPassword = password_hash($newpassword, PASSWORD_DEFAULT);

    $sql = "UPDATE manager SET password = '$newEncPassword' WHERE id = $mid";
    $result = $conn->query($sql);

    closedb($conn);

    if($result == true) {
        echo "true";
        die();
    } else {
        echo "err";
        die();
    }  
}
?>