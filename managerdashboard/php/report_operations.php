<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["getreports"])) {
        $conn = connectdb();

        $result = $conn->query("SELECT * FROM report");

        $data = array();

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $reportdate = $row["reportdate"];
                $startdate = $row["startdate"];
                $enddate = $row["enddate"];
                $revenue = $row["revenue"];
                $expense = $row["expense"];
                $totalcustomers = $row["totalcustomers"];
            
                $tableContent .= 
                "
                <tr>
                  <td>$id</td>
                  <td>$reportdate</td>
                  <td>$startdate</td>
                  <td>$enddate</td>
                  <td>$revenue</td>
                  <td>$expense</td>
                  <td>$totalcustomers</td>
                  <td>
                        <a class='btn btn-primary' href='reports/report-$id.pdf'>
                            <i class='fa fa-download'></i>
                        </a>
                        <button type='button' class='btn-delete btn btn-primary' data-toggle='modal' data-id='$id' data-target='#deleteReportModal'>
                            <i class='fa fa-trash'></i>
                        </button>
                  </td>
                </tr>
                ";
            }
        }

        closedb($conn);

        $data["tablecontent"] = $tableContent;
        $data["count"] = $result->num_rows;

        echo json_encode($data);
    }

    else if(isset($_POST["get"])) {
        $startdate = test_input($_POST["startdate"]);
        $enddate = test_input($_POST["enddate"]);

        if(empty($startdate) || empty($enddate)) {
            echo "err-notvalid";
            die();
        }

        if($enddate < $startdate) {
            echo "err-date";
            die();
        }

        $conn = connectdb();

        $days = array();

        $result = $conn->query("
        SELECT reservationdate, totalprice
        FROM reservation 
        WHERE reservationdate BETWEEN '$startdate' AND '$enddate'
        "); 

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc())
            {
                $reservationdate = $row["reservationdate"];
                $totalprice = $row["totalprice"];

                $day = array();

                $day["date"] = $reservationdate;
                $day["revenue"] = (int)$totalprice;
                $day["expense"] = 0;
                $day["customercount"] = 1;

                array_push($days, $day);
            }
        }

        $result = $conn->query("
        SELECT amount, date
        FROM expense 
        WHERE date BETWEEN '$startdate' AND '$enddate'
        "); 

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc())
            {
                $amount = $row["amount"];
                $date = $row["date"];

                $day = array();

                $day["date"] = $date;
                $day["revenue"] = 0;
                $day["expense"] = (int)$amount;
                $day["customercount"] = 0;

                array_push($days, $day);
            }
        }

        echo json_encode($days);

        closedb($conn);
    }

    else if(isset($_POST["delete"])) {
        $id = test_input($_POST["id"]);

        if(empty($id)) {
            echo "err";
            die();
        }

        $conn = connectdb();

        $result = $conn->query("DELETE FROM report WHERE id = $id"); 

        unlink("../reports/report-$id.pdf");
        
        if($result === true) {
            echo "true";
        }
        else {
            echo "err";
        }

        closedb($conn);
    }

    else if(isset($_POST["add"])) {
        $startdate = test_input($_POST["startdate"]);
        $enddate = test_input($_POST["enddate"]);

        $conn = connectdb();

        $result = $conn->query("
        SELECT COUNT(*) AS totalcustomers, COALESCE(SUM(totalprice), 0) AS revenue
        FROM reservation 
        WHERE reservationdate BETWEEN '$startdate' AND '$enddate'
        "); 

        $row = $result->fetch_assoc();
        $totalcustomers = $row["totalcustomers"];
        $revenue = $row["revenue"];

        $expense = $conn->query("
        SELECT COALESCE(SUM(amount), 0) AS expense
        FROM expense 
        WHERE date BETWEEN '$startdate' AND '$enddate'
        ")->fetch_assoc()["expense"]; 

        $result = $conn->query("
        INSERT INTO report (reportdate, startdate, enddate, revenue, expense, totalcustomers) 
        VALUES (DATE(NOW()), '$startdate', '$enddate', $revenue, $expense, $totalcustomers)
        "); 
        
        echo $conn->error;
        if($result === true) {
            echo $conn->insert_id;
        }
        else {
            echo "err";
        }

        closedb($conn);
    }
    else if(isset($_POST["upload"])) {
        move_uploaded_file(
            $_FILES['pdf']['tmp_name'], 
            $_SERVER['DOCUMENT_ROOT'] . "/ffahotel/managerdashboard/reports/" . test_input($_POST["filename"])
        );
    }
}


?>