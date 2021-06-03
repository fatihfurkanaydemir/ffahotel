<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("
        SELECT m.id, cus.fname, cus.lname, m.customerid, m.datetime, m.text, m.status
        FROM message m JOIN customer cus ON m.customerid = cus.id
        ORDER BY m.datetime DESC
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            $messagecount = $result->num_rows;
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $customerid = $row["customerid"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $datetime = $row["datetime"];
                $text = $row["text"];
                $status = $row["status"];

                if($status == "unread") {
                    $tableContent .= 
                    "
                    <tr>
                      <td>$customerid</td>
                      <td>$fname $lname</td>
                      <td>$datetime</td>
                      <td>$text</td>
                      <td>$status</td>
                      <td>
                        <button type='button' class='btn-markread btn btn-primary py-0' data-id='$id'>
                              <i class='fa fa-check'></i>
                        </button>
                      </td>
                    </tr>
                    ";
                }
                else {
                    $tableContent .= 
                    "
                    <tr>
                      <td>$customerid</td>
                      <td>$fname $lname</td>
                      <td>$datetime</td>
                      <td>$text</td>
                      <td>$status</td>               
                    </tr>
                    ";
                }  
            }
        }

    
        closedb($conn);

        echo $tableContent;
    }

    else if(isset($_POST["markread"])) {
        $id = test_input($_POST["id"]);

        if(empty($id)) {
            echo "err";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("UPDATE message SET status='read' WHERE id=$id"); 
        
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