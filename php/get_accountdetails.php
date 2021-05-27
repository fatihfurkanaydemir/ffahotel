<?php 
include "../dbconnect.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = connectdb();

    $uid = $_SESSION["uid"];

    $sql = "SELECT fname, lname, phonenumber, birthdate, email FROM customer WHERE id = $uid";

    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    $user = array();

    $user["fname"] = $row["fname"];
    $user["lname"] = $row["lname"];
    $user["phonenumber"] = $row["phonenumber"];
    $user["birthdate"] = $row["birthdate"];
    $user["email"] = $row["email"];
    $user["idnumber"] = $uid;

    closedb($conn);

    echo json_encode($user);
}
?>