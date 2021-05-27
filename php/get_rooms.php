<?php 
    include "../dbconnect.php";

    $conn = connectdb();
    $sql = "SELECT r.doornumber, r.roomtype, r.floor, rp.price, r.status
              FROM room r JOIN roomprice rp ON r.roomtype = rp.roomtype";

    $result = $conn->query($sql);

    $tableContent = "";

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $doornumber = $row["doornumber"];
            $roomtype = $row["roomtype"];
            $floor = $row["floor"];
            $price = $row["price"];
            $status = $row["status"];


            $tableRow = "<tr>
            <td>$doornumber</td>
            <td>$roomtype</td>
            <td>$floor</td>
            <td>$price</td>
            <td>$status</td>
            <td>
                <form id='editRoom-$doornumber' action='editroom.php' method='POST'>
                <input type='hidden' name='doornumber' value='$doornumber'></input>
                <button type='submit' class='btn btn-primary'>
                    <i class='fa fa-pencil'></i>
                </button>
                <button type='button' class='btn btn-primary' onClick='selectRoomToDelete($doornumber);' data-toggle='modal' data-target='#deleteRoomModal'>
                    <i class='fa fa-trash'></i>
                </button>
                </form>
            </td>
          </tr>";

          $tableContent .= $tableRow;
        }
    }

    echo $tableContent;

    closedb($conn);
?>