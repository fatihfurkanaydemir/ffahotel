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
                die();
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
                            aria-controls="change-password" aria-selected="false" href="#change-password">Change
                            Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action border-0" id="reservations-tab" role="tab" data-toggle="tab"
                            aria-controls="reservations" aria-selected="false" href="#reservations">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link list-group-item list-group-item-action border-0" id="logout" 
                            aria-controls="reservations" aria-selected="false" 
                            href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?logout=1"); ?>">Logout</a>
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
                    </div>
                </div>
            </div>
        </div>
        <!------------------- MODALS ------------------->
        <?php include "reservation_modals.php"; ?>
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

        var selectedReservation = undefined;

        $(document).on("click", ".btn-modal", function() {
            var data_checkindate = $(this).data("checkindate");
            var data_doornumber = $(this).data("doornumber");

            selectedReservation = {checkindate: data_checkindate, doornumber: data_doornumber};
        });
        $(document).on("click", ".btn-modalReview", function() {
            var data_checkindate = $(this).data("checkindate");
            var data_doornumber = $(this).data("doornumber");
            var data_commentid = $(this).data("commentid");
            var data_commenttext = $(this).data("commenttext");
            var data_commentrate = $(this).data("commentrate");

            selectedReservation = {checkindate: data_checkindate, doornumber: data_doornumber, commentid: data_commentid};
            
            switch(data_commentrate) {
                case 1:
                    $("#editrate1").prop("checked", true);
                    break;
                case 2:
                    $("#editrate2").prop("checked", true);
                    break;
                case 3:
                    $("#editrate3").prop("checked", true);
                    break;
                case 4:
                    $("#editrate4").prop("checked", true);
                    break;
                case 5:
                    $("#editrate5").prop("checked", true);
                    break;
            }

            $("#editreview-commenttext").val(data_commenttext);
        });

        $(document).on("click", ".btn-modalExtend", function() {
            var data_checkindate = $(this).data("checkindate");
            var data_checkoutdate = $(this).data("checkoutdate");
            var data_doornumber = $(this).data("doornumber");

            selectedReservation = {checkindate: data_checkindate, doornumber: data_doornumber, checkoutdate: data_checkoutdate};

            $("#newcheckindate").prop("value", data_checkindate);
            $("#newcheckoutdate").prop("value", data_checkoutdate);

            if((new Date()) > (new Date(data_checkindate))) {
                $("#newcheckindate").prop("disabled", true);
            }

        });



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
    <script type="text/javascript">
        $(function() {
            openTabHash(); // for the initial page load
            window.addEventListener("hashchange", openTabHash, false); // for later changes to url
        });


        function openTabHash()
        {
            // Javascript to enable link to tab
            var url = document.location.toString();
            console.log(url);
            if (url.match('#')) {
                $('.nav a[href="#'+url.split('#')[1]+'"]').tab('show') ;
            } 

            // With HTML5 history API, we can easily prevent scrolling!
            $('.nav a').on('shown.bs.tab', function (e) {
                if(history.pushState) {
                    history.pushState(null, null, e.target.hash); 
                } else {
                    window.location.hash = e.target.hash; //Polyfill for old browsers
                }
            })
        }
    </script>
    <script src="js/update_accountdetails.js"></script>
    <script src="js/update_password.js"></script>
    <script src="js/reservation_operations.js"></script>
    <script src="js/extend_reservation.js"></script>

    <?php require 'footers/footer.php'?>