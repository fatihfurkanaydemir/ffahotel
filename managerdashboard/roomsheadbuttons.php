                        
<?php 
    $totalRoomsActive = (strcmp($_SERVER["PHP_SELF"], "/ffahotel/managerdashboard/rooms.php") == 0 ? " active" : "");
    $bookingRoomsActive = (str_contains($_SERVER["PHP_SELF"], "bookingrooms.php") ? " active" : "");
    $bookedRoomsActive = (str_contains($_SERVER["PHP_SELF"], "bookedrooms.php") ? " active" : "");
    $emptyRoomsActive = (str_contains($_SERVER["PHP_SELF"], "emptyrooms.php") ? " active" : "");
?>
                        
<div class="row w-100 d-flex flex-row justify-content-around align-items-center p-3">
    <div class="col-3">
        <a href="rooms.php" class="btn btn-secondary w-100 py-4 <?php echo $totalRoomsActive; ?>">
            <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
            <span style="font-size: 1.2em;">Total Rooms</span>
            <span class="d-block" style="font-size: 2em;"> 250 </span>
        </a>
    </div>
    <div class="col-3">
        <a href="bookingrooms.php" class="btn btn-secondary w-100 py-4 <?php echo $bookingRoomsActive; ?>">
            <i class="fa fa-calendar d-inline" style="font-size: 24px;"></i>
            <span style="font-size: 1.2em;">Booking Rooms</span>
            <span class="d-block" style="font-size: 2em;"> 50 </span>
        </a>
    </div>
    <div class="col-3">
        <a href="bookedrooms.php" class="btn btn-secondary w-100 py-4 <?php echo $bookedRoomsActive; ?>">
            <i class="fa fa-bed d-inline" style="font-size: 24px;"></i>
            <span style="font-size: 1.2em;">Booked Rooms (Stays)</span>
            <span class="d-block" style="font-size: 2em;"> 150 </span>
        </a>
    </div>
    <div class="col-3">
        <a href="emptyrooms.php" class="btn btn-secondary w-100 py-4 <?php echo $emptyRoomsActive; ?>">
            <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
            <span style="font-size: 1.2em;">Empty Rooms</span>
            <span class="d-block" style="font-size: 2em;"> 50 </span>
        </a>
    </div>
</div>