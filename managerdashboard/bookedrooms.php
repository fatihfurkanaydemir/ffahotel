<?php require "../headers/managerheader.php"; ?>

<?php 
include "../dbconnect.php";

$conn = connectdb();

$sql = "SELECT res.doornumber, ro.roomtype, res.customerid, cus.fname, cus.lname,
res.reservationdate, res.checkindate, res.checkoutdate, res.totalprice FROM reservation res 
JOIN customer cus ON res.customerid = cus.id
JOIN room ro ON ro.doornumber = res.doornumber
WHERE res.status = 'active' AND cus.status = 'in' AND
DATE(NOW()) BETWEEN res.checkindate AND res.checkoutdate";

$result = $conn->query($sql);

$tableContent = "";

if($result->num_rows != 0) {
	while($row = $result->fetch_assoc()) {
		$doornumber = $row["doornumber"];
		$roomtype = $row["roomtype"];
		$customerid = $row["customerid"];
		$fname = $row["fname"];
		$lname = $row["lname"];
		$reservationdate = $row["reservationdate"];
		$checkindate = $row["checkindate"];
		$checkoutdate = $row["checkoutdate"];
		$totalprice = $row["totalprice"];


		$tableContent .= 
		"
		<tr>
          <td>$doornumber</td>
          <td>$roomtype</td>
          <td>$customerid</td>
          <td>$fname</td>
          <td>$lname</td>
          <td>$reservationdate</td>
          <td>$checkindate</td>
          <td>$checkoutdate</td>
          <td>$totalprice</td>
        </tr>
		";
	}
}

closedb($conn);
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                    
                      <?php require "roomsheadbuttons.php" ?>

                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Doornumber</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Customer First Name</th>
                                    <th scope="col">Customer Last Name</th>
                                    <th scope="col">Reservation Date</th>
                                    <th scope="col">Check-in Date</th>
                                    <th scope="col">Check-out Date</th>
                                    <th scope="col">Total Price</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php echo $tableContent; ?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

<?php require "../footers/managerfooter.php"; ?>