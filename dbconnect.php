<?php
    function connectdb() {
        $dbserverName = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $db = "ffahotel";

        $conn = new mysqli($dbserverName, $dbusername, $dbpassword, $db);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function closedb($conn) {
        $conn->close();
    }
?>