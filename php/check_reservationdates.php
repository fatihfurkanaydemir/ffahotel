<?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $checkinDate = $_POST["checkindate"];
        $checkoutDate = $_POST["checkoutdate"];

        echo "true";
    }
?>