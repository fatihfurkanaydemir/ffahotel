<?php 

include "../dbconnect.php";
include "../validations.php";

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $customerid = $_SESSION["uid"];
        $conn = connectdb();

        $result = $conn->query("
        SELECT m.datetime, m.text, m.status
        FROM message m JOIN customer cus ON m.customerid = cus.id
        WHERE m.customerid = $customerid
        ORDER BY m.datetime DESC
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            $messagecount = $result->num_rows;
            while($row = $result->fetch_assoc()) {
                $datetime = $row["datetime"];
                $text = $row["text"];
                $status = $row["status"];

                $tableContent .= 
                "
                <tr>
                  <td>$datetime</td>
                  <td>$text</td>
                  <td>$status</td>               
                </tr>
                ";
            } 
        }

        closedb($conn);

        echo $tableContent;
    }

    else if(isset($_POST["send"])) {
        $customerid = $_SESSION["uid"];
        $message = test_input($_POST["message"]);

        if(empty($message)) {
            echo "err-notvalid";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("
        INSERT INTO message (customerid, datetime, text, status) VALUES
        ($customerid, NOW(), '$message', 'unread')"); 
        
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