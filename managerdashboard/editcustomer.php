<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Edit Customer</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="fname" class="text-primary">First name: </label>
                                            <input type="text" name="fname" id="fname" placeholder="Enter first name" value="Fatih Furkan" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lname" class="text-primary">Last name: </label>
                                            <input type="text" name="lname" id="lname" placeholder="Enter last name" value="Aydemir" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="phonenumber" class="text-primary">Phone number: </label>
                                            <input type="tel" name="phonenumber" id="phonenumber" placeholder="Enter phone number" value="+90555555555" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="phonenumber" class="text-primary">E-mail: </label>
                                            <input type="email" name="email" id="email" placeholder="Enter E-mail" value="furkanaydemir6@gmail.com" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>    

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="statusselect" class="text-primary">Select status: </label>
                                            <select id="statusselect" class="custom-select">
                                                <option name="in" selected>In</option>
                                                <option name="out">Out</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="idnumber" class="text-primary">ID Number: </label>
                                            <input type="number" name="idnumber" id="idnumber" placeholder="Enter id number" class="form-control" value="1111111111" required>
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

<?php require "../footers/managerfooter.php"?>