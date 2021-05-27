<?php 
    include "../dbconnect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $doornumber = $_POST["doornumber"];

        $conn = connectdb();

        $result = $conn->query("DELETE FROM room WHERE doornumber=$doornumber");

        closedb($conn);

        if($result === true){ echo "true"; } 
        else { echo "false"; }
    }
?>