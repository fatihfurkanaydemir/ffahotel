<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1">  
                        <div class="card w-50 shadow">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Change Password</span>
                            </div>
                            <div class="card-body">
                                <form id="changepasswordform" class="needs-validation" novalidate>
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
                           
                                    <button type="button" onClick="changePassword()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/change_password.js"></script>

<?php require "../footers/managerfooter.php"; ?>