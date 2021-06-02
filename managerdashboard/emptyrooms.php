<?php require "../headers/managerheader.php"; ?>

<?php 
include "../dbconnect.php";

$conn = connectdb();

$startdate = "DATE(NOW())";
$enddate = "DATE(NOW())";
$err = "";
$resultCount = 0;

if($_SERVER["REQUEST_METHOD"] == "POST"){
  $startdate = $_POST["startdate"];
  $enddate = $_POST["enddate"];

  if($enddate < $startdate) {
    $err = "<div class='text-danger text-center w-100' style='font-size: 1.2em'>
    <i class='fa fa-exclamation-triangle'></i>
    Please select dates correctly
    </div>";
  }
  
  $startdate = "'$startdate'";
  $enddate = "'$enddate'";
}

$sql = "SELECT ro.doornumber, ro.roomtype, ro.floor, rp.price FROM room ro
      JOIN roomprice rp ON rp.roomtype = ro.roomtype
    WHERE doornumber NOT IN
    (SELECT ro.doornumber 
    FROM reservation res JOIN room ro ON res.doornumber = ro.doornumber
    WHERE res.status = 'active' AND 
    ((res.checkindate BETWEEN $startdate AND $enddate) OR
    (res.checkoutdate BETWEEN $startdate AND $enddate) OR
    (res.checkindate < $startdate AND res.checkoutdate > $enddate)))
    ORDER BY ro.doornumber";

$result = $conn->query($sql);

$tableContent = "";

if($result->num_rows != 0) {
	while($row = $result->fetch_assoc()) {
		$doornumber = $row["doornumber"];
		$roomtype = $row["roomtype"];
		$floor = $row["floor"];
		$price = $row["price"];

		$tableContent .= 
		"
		<tr>
          <td>$doornumber</td>
          <td>$roomtype</td>
          <td>$floor</td>
          <td>$price</td>
        </tr>
		";
	}

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $err = "<div class='text-success text-center w-100' style='font-size: 1.2em'>
      <i class='fa fa-check'></i>
      $result->num_rows results found
      </div>";
  }
}

closedb($conn);
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                    
                    <?php require "roomsheadbuttons.php" ?>
                        
                        <form class="w-100" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                        <?php echo $err; ?>
                        <div class="row w-100 mt-2">
                            <div class="row mb-1">
                                <div class="col">
                                    <span class="text-primary ml-4">Search an empty room for a range of date: </span>
                                </div>
                            </div>
                            <div class="form-row w-100 mx-3">
                                <div class="col-5">
                                    <input type="date" id="startdate" name="startdate" data-relmin="0" class="form-control d-inline-block">
                                </div>
                                <div class="col-5">
                                    <input type="date" id="enddate" name="enddate" data-relmin="0" class="form-control d-inline-block">
                                </div>
                                <div class="col-2">
                                    <input type="submit" id="btn-search" value="Search" class="btn btn-primary btn-block" disabled></input>
                                </div>
                            </div>
                        </div>
                        </form>
                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Door Number</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Floor</th>
                                    <th scope="col">Price</th>
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
            <script>
            $(function () {
                $('input[data-relmin]').each(function () {
                    var oldVal = $(this).prop('value');
                    var relmin = $(this).data('relmin');
                    var min = new Date();
                    min.setFullYear(min.getFullYear() + relmin);
                    $.prop(this, 'min', $(this).prop('valueAsDate', min).val());
                    $.prop(this, 'value', oldVal);
                });
            });

            var startSelected = endSelected = false;

            $(document).on("change", "#startdate", function() {
                startSelected = true;
                if(endSelected) { $("#btn-search").prop("disabled", false); }
            });
            $(document).on("change", "#enddate", function() {
                endSelected = true;
                if(startSelected) { $("#btn-search").prop("disabled", false); }
            });
            </script>
  
<?php require "../footers/managerfooter.php"; ?>