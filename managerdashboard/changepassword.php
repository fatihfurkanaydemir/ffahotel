<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1">  
                        <div class="card w-50 shadow">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Change Password</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="oldpassword" class="text-primary">Old Password: </label>
                                            <input type="password" name="oldpassword" id="oldpassword" placeholder="Enter old password" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="newpassword" class="text-primary">New Password: </label>
                                            <input type="password" name="newpassword" id="newpassword" placeholder="Enter new password" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col">
                                            <label for="newpasswordagain" class="text-primary">New Password Again: </label>
                                            <input type="password" name="newpasswordagain" id="newpasswordagain" placeholder="Enter new password again" class="form-control" required>
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