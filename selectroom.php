<?php require 'headers/header.php'?>

<?php
    include "dbconnect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $checkindate = $_POST["checkindate"];
        $checkoutdate = $_POST["checkoutdate"];
        $roomtype = $_POST["roomtype"];
        $numberofpersons = $_POST["numberofpersons"];

        $reservationInfo = array();
        $reservationInfo["checkindate"] = $_POST["checkindate"];
        $reservationInfo["checkoutdate"] = $_POST["checkoutdate"];
        $reservationInfo["roomtype"] = $_POST["roomtype"];
        $reservationInfo["numberofpersons"] = $_POST["numberofpersons"];

        $_SESSION["reservationinfo"] = $reservationInfo;

        $sql = 
            "SELECT ro.doornumber, ro.floor, rp.price
               FROM room ro JOIN roomprice rp ON ro.roomtype = rp.roomtype
              WHERE ro.roomtype = '$roomtype' AND ro.doornumber NOT IN
            (SELECT ro.doornumber 
            FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
            WHERE res.status = 'active' AND 
            ((res.checkindate BETWEEN '$checkindate' AND '$checkoutdate') OR
             (res.checkoutdate BETWEEN '$checkindate' AND '$checkoutdate') OR
             (res.checkindate < '$checkindate' AND res.checkoutdate > '$checkoutdate')))";

        $conn = connectdb();

        $result = $conn->query($sql);

        closedb($conn);

        $tableContent = "";

        while($row = $result->fetch_assoc()) {
            $doornumber = $row["doornumber"];
            $floor = $row["floor"];
            $price = $row["price"];

            $tableRow = "<tr>
            <form id='selectRoom-$doornumber' action='book.php' method='POST'>
                <input type='hidden' name='doornumber' value='$doornumber'></input>
            </form>
            <td>$doornumber</td>
            <td>$roomtype</td>
            <td>$floor</td>
            <td>$price</td>
            <td><input type='submit' value='Select' form='selectRoom-$doornumber' class='btn btn-primary w-100'></input></td>
          </tr>";

          $tableContent .= $tableRow;
        }
    }
    else {
        header("Location: index.php");
    }
?>

                        <div class="row mx-3 my-5" style="max-height: 800px; overflow: auto;">
                            <div class="card w-100">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                      <tr>
                                        <th scope="col">Door Number</th>
                                        <th scope="col">Room Type</th>
                                        <th scope="col">Floor</th>
                                        <th scope="col">Price</th>
                                        <th scope="col" class="text-center">Select Room</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tableContent">
                                    <?php echo $tableContent; ?>
                                    </tbody>
                                  </table>
                            </div>
                        </div>

<?php require 'footers/footer.php'?>