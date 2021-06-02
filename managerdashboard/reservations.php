<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";

    $conn = connectdb();

    $totalcount = $conn->query("SELECT COUNT(*) AS totalcount FROM reservation")->fetch_assoc()["totalcount"];

    closedb($conn);
?>
                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-calendar-check-o d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reservations</span>
                                    <span class="d-block" style="font-size: 2em;"> <?php echo $totalcount; ?> </span>
                                </button>
                            </div>
                        </div>
                        <div class="form-row w-100 mx-2 mt-4">
                            <div class="col-2">
                                <a href="addreservation.php" class="btn btn-primary w-100">
                                    <i class="fa fa-plus"></i>
                                    Add new reservation
                                </a>
                            </div>
                            
                            <div class="col-1">
                                <ul class="nav nav-pills">
                                  <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle active" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Search</a>
                                    <div class="dropdown-menu">
                                      <a class="dropdown-item" href="#nav-cusname" data-toggle="tab" role="tab" aria-controls="nav-cusname" aria-selected="true">By Customer Name</a>
                                      <a class="dropdown-item" href="#nav-resdate" data-toggle="tab" role="tab" aria-controls="nav-resdate" aria-selected="true">By Reservation Date</a>
                                    </div>
                                  </li>
                                </ul>
                            </div>
                            <div class="col-9">
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-cusname" role="tabpanel" aria-labelledby="nav-cusname-tab">
                                      <form id="searchnameform">
                                          <div class="form-row">
                                            <div class="form-group col-8">
                                                <input type="text" name="customername" id="customername" placeholder="Enter customer name" class="form-control" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group col-4">
                                                <button type="button" onClick="searchByName()" class="btn btn-primary w-100">Search</button>
                                            </div>
                                          </div>
                                      </form>
                                    </div>
                                    <div class="tab-pane fade" id="nav-resdate" role="tabpanel" aria-labelledby="nav-resdate-tab">
                                      <form id="searchdatesform"> 
                                          <div class="form-row">
                                            <div class="form-group col-4">
                                                <input type="date" name="startdate" id="startdate" class="form-control" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group col-4">
                                                <input type="date" name="enddate" id="enddate" class="form-control" required>
                                                <div class="valid-feedback">Valid.</div>
                                                <div class="invalid-feedback">Please fill out this field.</div>
                                            </div>
                                            <div class="form-group col-4">
                                                <button type="button" onClick="searchByDates()" class="btn btn-primary w-100">Search</button>
                                            </div>
                                          </div>
                                      </form>
                                    </div>
                                </div>
                            </div>  
                        </div>
                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Doornumber</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Customer ID</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Reservation Date</th>
                                    <th scope="col">Person Number</th>
                                    <th scope="col">Check-in Date</th>
                                    <th scope="col">Check-out Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Operations</th>
                                  </tr>
                                </thead>
                                    <tbody id="tablecontent">
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- MODALS -->
            <div class="modal fade" id="editReservationModal" tabindex="-1" role="dialog"
                aria-labelledby="editReservationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editReservationModalLabel">Edit Reservation</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="newdoornumber" class="text-primary">Select new doornumber:</label>
                                <input type="number" class="form-control" name="newdoornumber" id="newdoornumber" min="0">
                            </div>
                            <div class="form-group">
                                <label for="newcheckindate" class="text-primary">Select new checkin date:</label>
                                <input type="date" class="form-control" name="newcheckindate" data-relmin="0" id="newcheckindate">
                            </div>
                            <div class="form-group">
                                <label for="newcheckoutdate" class="text-primary">Select new checkout date:</label>
                                <input type="date" class="form-control" name="newcheckoutdate" data-relmin="0" id="newcheckoutdate">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="editReservation()" id="btn-extendReservation" disabled>Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="cancelReservationModal" tabindex="-1" role="dialog"
                aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cancelReservationModalLabel">Cancel
                                Reservation</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to cancel this reservation ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">Close</button>
                            <button type="button" id="btn-cancelReservation" onClick="cancelReservation()" class="btn btn-primary" data-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- MODALS -->

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
            </script>

<script src="js/reservation_operations.js"></script>
<?php require "../footers/managerfooter.php"?>