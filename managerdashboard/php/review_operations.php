<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("
        SELECT com.id, com.rate, com.text, com.datetime, cus.fname, cus.lname
        FROM reservation res JOIN comment com ON com.id = res.commentid
        JOIN customer cus ON res.customerid = cus.id
        ");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $rate = $row["rate"];
                $text = $row["text"];
                $datetime = $row["datetime"];
                $fname = $row["fname"];
                $lname = $row["lname"];

                $stars = "";

                for($i = 0; $i < $rate; $i++) {
                    $stars .= "<i class='fa fa-star rating-stars checked'></i>";
                }
                for($i = 0; $i < 5 - $rate; $i++) {
                    $stars .= "<i class='fa fa-star rating-stars'></i>";
                }
            
                $tableContent .= 
                "
                <tr>
                  <td>$stars</td>
                  <td>$datetime</td>
                  <td>$text</td>
                  <td>$fname $lname</td>
                  <td>
                      <button type='button' class='btn-modal btn btn-primary' data-toggle='modal' data-id='$id' data-target='#deleteReviewModal'>
                          <i class='fa fa-trash'></i>
                      </button>
                  </td>
                </tr>
                ";
            }
        }

        closedb($conn);

        echo $tableContent;
    }

    if(isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);

        if(empty($id)) {
            echo "err";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("DELETE FROM comment WHERE id = $id"); 
        
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