    <?php require 'headers/header.php'?>

    <?php 
        if(!isset($_SESSION["logged_in"])) {
            header("Location: login.php");
            die();
        }

        include "dbconnect.php";
        include "validations.php";

        $acdactive = "active";
        $psdactive = "";

        $bootstrapValidation = ""; 
        $formValidated = true;
        $notValidError = "";
        $notValidErrorPsd = "";

        $conn = connectdb();

        $uid = $_SESSION["uid"];
        $sql = "SELECT fname, lname, phonenumber, birthdate, email FROM customer WHERE id = $uid";

        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        $fname = $row["fname"];
        $lname = $row["lname"];
        $phoneNumber = $row["phonenumber"];
        $birthdate = $row["birthdate"];
        $email = $row["email"];

        closedb($conn);

        if(isset($_REQUEST["acds"])) {
            $notValidError = "
                    <div class='text-center text-success mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                    <i class='fa fa-check'></i>
                    Account details successfully updated
                    </div>";
        }

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            //Update account details
            if(isset($_REQUEST["acd"])) {
                $acdactive = "active";
                $psdactive = "";

                $newfname = test_input($_POST["fname"]);
                $newlname = test_input($_POST["lname"]);
                $newphoneNumber = test_input($_POST["phonenumber"]);
                $newidNumber = test_input($_POST["idnumber"]);
                $newemail = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
                $newbirthdate = test_input($_POST["birthdate"]);

                if(empty($newfname) || empty($newlname) || empty($newphoneNumber) || empty($newemail) || empty($newidNumber) || empty($newbirthdate)) {
                    $bootstrapValidation = "was-validated"; 
                    $formValidated = false;     
                }  

                if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
                    $bootstrapValidation = "";

                    $formValidated = false; 

                    $notValidError = "
                    <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid email
                    </div>";
                }
                if(!validatePhoneNumber($newphoneNumber)) {
                    $bootstrapValidation = "";
    
                    $formValidated = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid phone number
                    </div>";
                }  

                if(!validateIDNumber($newidNumber)) {
                    $bootstrapValidation = "";
    
                    $formValidated = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid id number
                    </div>";
                }

                if($uid != $newidNumber) {
                    $conn = connectdb();

                    $sql = "SELECT id FROM customer WHERE id=$newidNumber";
                    $result = $conn->query($sql);

                    if($result->num_rows != 0) {
                        $notValidError = "
                        <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        This id number is already used
                        </div>";
                        $formValidated = false;
                    }

                    closedb($conn);
                }

                if($email != $newemail) {
                    $conn = connectdb();

                    $sql = "SELECT email FROM customer WHERE email='$newemail'";
                    $result = $conn->query($sql);
                    
                    if($result->num_rows != 0) {
                        $notValidError = "
                        <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        This email is already used
                        </div>";
                        $formValidated = false;
                    }

                    closedb($conn);
                }

                if($formValidated) {
                    $conn = connectdb();

                    $sql = "UPDATE customer SET
                            fname = '$newfname',
                            lname = '$newlname',
                            email = '$newemail',
                            phonenumber = '$newphoneNumber',
                            id = $newidNumber,
                            birthdate = '$newbirthdate' WHERE id = $uid";

                    $result = $conn->query($sql);

                    if($result == true) {
                        $notValidError = "
                        <div class='text-center text-success mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-check'></i>
                        Account details successfully updated
                        </div>";

                        header("Location: userdashboard.php?acds");
                    } else {
                        $notValidError = "
                        <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        An error occured
                        </div>";
                    }
                    
                    closedb($conn);
                }
            }
            //Update password
            if(isset($_REQUEST["psd"])) {
                $acdactive = "";
                $psdactive = "active";

                $oldpassword = test_input($_POST["oldpassword"]);
                $newpassword = test_input($_POST["newpassword"]);
                $newpasswordagain = test_input($_POST["newpasswordagain"]);

                $conn = connectdb();

                $sql = "SELECT password FROM customer WHERE id = $uid";
                $result = $conn->query($sql);
                $row = $result->fetch_assoc();

                $oldpass = $row["password"];

                closedb($conn);

                if(!password_verify($oldpassword, $oldpass)) {
                    $formValidated = false;
                    $notValidErrorPsd = "
                        <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Your old password is wrong
                        </div>";
                }

                if(strcmp($newpassword, $newpasswordagain) != 0) {
                    $formValidated = false;
                    $notValidErrorPsd = "
                        <div class='text-center text-danger mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Your passwords do not match
                        </div>";
                }

                if($formValidated) {
                    $conn = connectdb();
                    $newEncPassword = password_hash($newpassword, PASSWORD_DEFAULT);

                    $sql = "UPDATE customer SET password = '$newEncPassword' WHERE id = $uid";
                    $result = $conn->query($sql);

                    if($result == true) {
                        $notValidErrorPsd = "
                        <div class='text-center text-success mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-check'></i>
                        Your password successfully updated
                        </div>";
                    } else {
                        $notValidErrorPsd = "
                        <div class='text-center text-success mt-2 font-weight-bold' id='nve' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        An error occured
                        </div>";
                    }

                    closedb($conn);
                }

                
            }
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
            <nav class="col-2 col-md-2 shadow p-0" role="tablist" aria-orientation="vertical">
                <ul class="nav flex-column list-group">
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action <?php echo $acdactive; ?> border-0" role="tab" aria-controls="account-details" 
                        aria-selected="<?php echo isset($_REQUEST["acd"]) ? true : false; ?>"
                            id="account-details-tab" data-toggle="tab" href="#account-details">Account Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action <?php echo $psdactive ?> border-0" id="change-password-tab" role="tab" data-toggle="tab"
                            aria-controls="change-password" aria-selected="<?php echo isset($_REQUEST["psd"]) ? true : false; ?>" href="#change-password">Change
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
            <div class="col-10 mt-3 mt-md-0 col-md-10">
                <div class="tab-content card shadow p-3">
                    <div class="tab-pane fade <?php echo "show " . $acdactive; ?>" id="account-details" role="tabpanel"
                        aria-labelledby="account-details-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Account
                            Details</i></span>
                            <?php echo $notValidError; ?>
                        <div class="align-items-center flex-column">
                            <form id="accountdetailsform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?acd"); ?>" method="POST" class="needs-validation <?php echo $bootstrapValidation; ?>" novalidate>
                                <div class="form-group">
                                    <input type="text" name="fname" id="fname" placeholder="Enter your first name"
                                        class="form-control" value="<?php echo $fname; ?>" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="text" name="lname" id="lname" placeholder="Enter your last name"
                                        class="form-control" value="<?php echo $lname; ?>" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="tel" name="phonenumber" id="phonenumber"
                                        placeholder="Enter your phone number" class="form-control" value="<?php echo $phoneNumber; ?>"
                                        required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="number" name="idnumber" id="idnumber"
                                        placeholder="Enter your id number" class="form-control" value="<?php echo $uid; ?>" min="0"
                                        required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="date" name="birthdate" id="birthdate" class="form-control" data-relmax="-18" value="<?php echo $birthdate; ?>" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" placeholder="Enter your email"
                                        class="form-control" value="<?php echo $email; ?>" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <input type="submit" value="Save" class="btn btn-primary mt-3 shadow"
                                    style="width: 100%;">
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade <?php echo "show " . $psdactive; ?>" id="change-password" role="tabpanel"
                        aria-labelledby="change-password-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Change
                            Password</span>
                            <?php echo $notValidErrorPsd; ?>
                        <div class="align-items-center flex-column">
                            <form id="changepasswordform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?psd"); ?>" method="POST" class="needs-validation" novalidate>
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
                                <input type="submit" value="Save" class="btn btn-primary mt-3 shadow"
                                    style="width: 100%;">
                            </form>
                        </div>

                    </div>
                    <div class="tab-pane fade mb-5" id="reservations" role="tabpanel"
                        aria-labelledby="reservations-tab">
                        <span class="font-weight-bold d-block text-center" style="font-size: 2em;">Reservations</span>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
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

        setTimeout(() => {
            document.getElementById("nve").innerHTML = "";
        }, 4000);
        
    </script>

    <?php require 'footers/footer.php'?>