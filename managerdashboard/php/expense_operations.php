<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("SELECT * FROM expense ORDER BY date DESC");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $date = $row["date"];
                $amount = $row["amount"];
                $description = $row["description"];
            
                $tableContent .= 
                "
                <tr>
                  <td>$date</td>
                  <td>$amount USD</td>
                  <td>$description</td>
                  <td>
                      <button type='button' class='btn-modal btn btn-primary' data-toggle='modal' data-id='$id' data-target='#deleteExpenseModal'>
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
    if(isset($_POST["add"])) {
        $date = $_POST["date"];
        $amount = test_input($_POST["amount"]);
        $description = test_input($_POST["description"]);

        if(empty($date) || empty($amount) || empty($description)) {
            if($amount == 0) {
                echo "err-amount";
                die();
            }
            echo "err-notvalid";
            die();
        }

        if($amount <= 0) {
            echo "err-amount";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("INSERT INTO expense (date, amount, description) VALUES('$date', $amount, '$description')"); 
        
        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }

        closedb($conn);
    }

    if(isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);

        if(empty($id)) {
            echo "err";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("DELETE FROM expense WHERE id = $id"); 
        
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