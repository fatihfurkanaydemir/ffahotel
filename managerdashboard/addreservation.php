<?php require "../headers/managerheader.php"; ?>
                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Add Reservation</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="customerid" class="text-primary">Customer Id: </label>
                                            <input type="number" name="customerid" id="customerid" placeholder="Enter customer id" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="roomnumber" class="text-primary">Room Number: </label>
                                            <input type="number" name="roomnumber" id="roomnumber" placeholder="Enter room number" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="checkindate" class="text-primary">Check-in Date: </label>
                                            <input type="date" name="checkindate" id="checkindate" placeholder="Check-in Date" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="checkoutdate" class="text-primary">Check-out Date: </label>
                                            <input type="date" name="checkoutdate" id="checkoutdate" placeholder="Check-out Date" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>                              
                                    <input type="submit" value="Save" class="btn btn-primary mt-3 shadow" style="width: 100%;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Disable form submissions if there are invalid fields
                (function() {
                  'use strict';
                  window.addEventListener('load', function() {
                    // Get the forms we want to add validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                      form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                          event.preventDefault();
                          event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                      }, false);
                    });
                  }, false);
                })();
            </script>

<?php require "../footers/managerfooter.php"; ?>