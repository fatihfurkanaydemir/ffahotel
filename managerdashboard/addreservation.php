<?php require "../headers/managerheader.php"; ?>
                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Add Reservation</span>
                            </div>
                            <div class="card-body">
                                <form id="addreservationform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="customerid" class="text-primary">Customer Id: </label>
                                            <input type="number" name="customerid" id="customerid" placeholder="Enter customer id" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="doornumber" class="text-primary">Door Number: </label>
                                            <input type="number" name="doornumber" id="doornumber" placeholder="Enter door number" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="checkindate" class="text-primary">Check-in Date: </label>
                                            <input type="date" name="checkindate" id="checkindate" placeholder="Check-in Date" data-relmin="0" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="checkoutdate" class="text-primary">Check-out Date: </label>
                                            <input type="date" name="checkoutdate" id="checkoutdate" placeholder="Check-out Date" data-relmin="0" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>   
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="numberofpersons" class="text-primary">Person Number: </label>
                                            <input type="number" name="numberofpersons" id="numberofpersons" placeholder="Enter person number" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <button type="button" onClick="addReservation()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Add</button>
                                </form>
                            </div>
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
            </script>
            <script src="js/add_reservation.js"></script>

<?php require "../footers/managerfooter.php"; ?>