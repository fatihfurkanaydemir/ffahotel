    <?php require 'headers/header.php'?>

    <?php 
        if(!isset($_SESSION["logged_in"])) {
            header("Location: login.php");
            die();
        }

    
        if(isset($_REQUEST["logout"])) {
            $logout = $_REQUEST["logout"];
            
            if($logout == "1") {
                session_unset();
                session_destroy();

                header("Location: index.php");
            }
        }
    ?>

    <section class="main-section container-fluid">
        <div class="row">
            <nav class="col-md-2 shadow p-0 mx-3 mx-md-0" role="tablist" aria-orientation="vertical">
                <ul class="nav flex-column list-group">
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action active border-0" role="tab" aria-controls="account-details" 
                        aria-selected="true"
                            id="account-details-tab" data-toggle="tab" href="#account-details">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action border-0" id="change-password-tab" role="tab" data-toggle="tab"
                            aria-controls="change-password" aria-selected="" href="#change-password">Change
                            Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action border-0" id="reservations-tab" role="tab" data-toggle="tab"
                            aria-controls="reservations" aria-selected="false" href="#reservations">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action border-0" id="logout" 
                            aria-controls="reservations" aria-selected="false" 
                            href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?logout=1") ?>">Logout</a>
                    </li>
                </ul>
            </nav>
            <div class="col-md-10 mt-3 mt-md-0">
                <div class="tab-content card shadow p-3">
                    <div class="tab-pane fade show active" id="account-details" role="tabpanel"
                        aria-labelledby="account-details-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Account Details</i></span>
                        <div class="align-items-center flex-column">
                        <!-- Account Details Form -->
                            <form id="accountdetailsform" action="#" method="POST" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                                        class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                                        class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phonenumber" id="phonenumber"
                                        placeholder="Enter your phone number" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="idnumber" id="idnumber"
                                        placeholder="Enter your id number" class="form-control"  min="0"
                                        required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control" data-relmax="-18" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control"  required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <button type="button" onClick="accountDetailsForm()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Save</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="change-password" role="tabpanel"
                        aria-labelledby="change-password-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Change Password</span>
                        <div class="align-items-center flex-column">
                        <!-- Password Form -->
                            <form id="changepasswordform" action="#" method="POST" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <input type="password" name="oldpassword" id="oldpassword"
                                        placeholder="Enter your old password" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpassword" id="newpassword"
                                        placeholder="Enter your new password" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="newpasswordagain" id="newpasswordagain"
                                        placeholder="Enter your new password again" class="form-control" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <button type="button" onClick="changePasswordForm()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Save</button>
                            </form>
                        </div>
                    </div>
                    <!-- Reservations -->
                    <div class="tab-pane fade mb-5" id="reservations" role="tabpanel"
                        aria-labelledby="reservations-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Reservations</span>
                        <!-- Reservation Continues -->
                        <div class="card mt-4 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="img/vipRoom.jpg" alt="Vip Room"
                                            class="reservation-card-img card-img mx-auto d-block">
                                    </div>
                                    <div class="col-sm-4 pl-5 pl-sm-0">
                                        <span class="d-block font-weight-bold mt-4 mt-sm-0"
                                            style="font-size: 1.2em;">Reservation Continues</span>
                                        <span class="d-block mt-1">VIP Room</span>
                                        <span class="d-block mt-1">01.03.2021 - 05.03.2021</span>
                                        <span class="d-block mt-1">2 days left</span>
                                        <span class="d-block mt-1">150 USD/day</span>
                                    </div>
                                    <div class="m-auto">
                                        <button class="btn btn-primary mt-4 mt-sm-0 mb-4" data-toggle="modal"
                                            data-target="#extendReservationModal">Extend</button>
                                        <button class="btn btn-primary mt-4 mt-sm-0 mb-4" data-toggle="modal"
                                            data-target="#cancelReservationModal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mt-4 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="img/familyRoom.jpg" alt="Family Room"
                                            class="reservation-card-img card-img mx-auto d-block">
                                    </div>
                                    <div class="col-sm-4 pl-5 pl-sm-0">
                                        <span class="d-block font-weight-bold mt-4 mt-sm-0"
                                            style="font-size: 1.2em;">Reservation Ended</span>
                                        <span class="d-block mt-1">Family Room</span>
                                        <span class="d-block mt-1">05.02.2021 - 10.02.2021</span>
                                        <span class="d-block mt-1">100 USD/day</span>
                                    </div>
                                    <div class="m-auto">
                                        <button class="btn btn-primary mt-4 mt-sm-0 mb-4" data-toggle="modal"
                                            data-target="#makeReviewModal">Make a review</button>
                                    </div>
                                </div>    
                            </div>
                        </div>
                        <div class="card mt-4 shadow">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <img src="img/singleRoom.jpg" alt="Single Room"
                                            class="reservation-card-img card-img mx-auto d-block">
                                    </div>
                                    <div class="col-sm-4">
                                        <span class="d-block font-weight-bold mt-4 mt-sm-0"
                                            style="font-size: 1.2em;">Reservation Ended</span>
                                        <span class="d-block mt-1">Single Room</span>
                                        <span class="d-block mt-1">10.01.2021 - 17.01.2021</span>
                                        <span class="d-block mt-1">50 USD/day</span>
                                    </div>
                                    <div class="m-auto">
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="media review">
                                        <img src="img/loginUserIcon.png" class="mr-3 room-reviews-user-icon"
                                            alt="User icon">
                                        <div class="media-body">
                                            <h5 class="mt-0">Fatih Furkan Aydemir</h5>
                                            <div class="rating-stars d-inline-block">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="d-inline-block ml-5">
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#editReviewModal"><i class="fa fa-pencil"></i></button>
                                                <button class="btn btn-primary" data-toggle="modal"
                                                    data-target="#deleteReviewModal"><i
                                                        class="fa fa-trash"></i></button>
                                            </div>

                                            <span class="review-content d-block">
                                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque
                                                ante sollicitudin. Cras purus odio,
                                                vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
                                                nunc ac nisi vulputate fringilla. Donec
                                                lacinia congue felis in faucibus.
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!------------------- MODALS ------------------->
        <div class="modal fade" id="extendReservationModal" tabindex="-1" role="dialog"
            aria-labelledby="extendReservationModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="extendReservationModalLabel">Extend
                            Reservation</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="newCheckOutDate">Select new checkout date</label>
                            <input type="date" class="form-control" name="newCheckOutDate">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
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
                        <button type="button" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog"
            aria-labelledby="deleteReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteReviewModalLabel">Delete Review</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete your review ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog"
            aria-labelledby="editReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-stars d-inline-block">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <textarea class="form-control" rows="10">
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio,
                        vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec
                        lacinia congue felis in faucibus.
                    </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="makeReviewModal" tabindex="-1" role="dialog"
            aria-labelledby="makeReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="makeReviewModalLabel">Make Review</h5>
                        <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="rating-stars d-inline-block">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </div>
                        <textarea class="form-control" rows="10">
                        </textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </div>
        <!------------------- MODALS ------------------->
    </section>
    
    <script src="js/get_reservations.js"></script>
    <script>
        $(function () {
            $('input[data-relmax]').each(function () {
                var oldVal = $(this).prop('value');
                var relmax = $(this).data('relmax');
                var max = new Date();
                max.setFullYear(max.getFullYear() + relmax);
                $.prop(this, 'max', $(this).prop('valueAsDate', max).val());
                $.prop(this, 'value', oldVal);
            });
        });

        getAccountDetails();
        getReservations();

        function getAccountDetails() {
            $.ajax({
            type: "post",
            url: "php/get_accountdetails.php",
            data: "",
            success: function(data, status) {  
                var user = JSON.parse(data);

                $("#fname").prop("value", user.fname);
                $("#lname").prop("value", user.lname);
                $("#phonenumber").prop("value", user.phonenumber);
                $("#idnumber").prop("value", user.idnumber);
                $("#birthdate").prop("value", user.birthdate);
                $("#email").prop("value", user.email);
            },
            error: function(xhr, desc, err) {
                console.log(desc);
            }
            });
        }
        
    </script>
    <script src="js/update_accountdetails.js"></script>
    <script src="js/update_password.js"></script>

    <?php require 'footers/footer.php'?>