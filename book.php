    <?php require 'headers/header.php'?>

    <?php
        include "dbconnect.php";

        $fname = $lname = $birthdate = $id = $email = $phonenumber = "";
        $formDisabled = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $checkindate = $_SESSION["reservationinfo"]["checkindate"];
            $checkoutdate = $_SESSION["reservationinfo"]["checkoutdate"];
            $doornumber = $_POST["doornumber"];
            $_SESSION["reservationinfo"]["doornumber"] = $doornumber;

            $sql = "SELECT (DATEDIFF('$checkoutdate', '$checkindate') + 1) * 
            (SELECT rp.price FROM room ro JOIN roomprice rp ON ro.roomtype = rp.roomtype
             WHERE ro.doornumber = '$doornumber') AS totalprice";

            $conn = connectdb();

            $result = $conn->query($sql);
            $totalprice = $result->fetch_assoc()["totalprice"];
            $_SESSION["reservationinfo"]["totalprice"] = $totalprice;

            closedb($conn);

            if(isset($_SESSION["logged_in"])) {
                $id = $_SESSION["uid"];
                $fname = $_SESSION["ufname"];
                $lname = $_SESSION["ulname"];
                $birthdate = $_SESSION["ubirthdate"];
                $phonenumber = $_SESSION["uphonenumber"];
                $email = $_SESSION["uemail"];

                $formDisabled = "disabled";
            }
        }
        else { header("Location: index.php"); }
    ?>

    <section class="main-section container-fluid">
        <div class="card border-0">
            <div class="row card-body">
                <div class="col-md-7">
                    <form id="bookform" action="#" class="needs-validation" novalidate>
                        <div class="row">
                            <div class="card container-fluid shadow">
                                <div class="card-title text-primary font-weight-bold" style="font-size: 1.2em;">Customer
                                    Information
                                </div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="fname" class="text-primary">First Name</label>
                                            <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>"
                                                placeholder="Enter your first name" class="form-control" required
                                                <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="lname" class="text-primary">Last Name</label>
                                            <input type="text" name="lname" id="fname" value="<?php echo $lname; ?>"
                                                placeholder="Enter your last name" class="form-control" required
                                                <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="phonenumber" class="text-primary">Phone Number</label>
                                            <input type="tel" name="phonenumber" id="phonenumber" value="<?php echo $phonenumber; ?>"
                                                placeholder="Enter your phone number" class="form-control" required
                                                <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email" class="text-primary">E-mail</label>
                                            <input type="email" name="email" id="email" value="<?php echo $email; ?>" 
                                            placeholder="Enter your email" class="form-control" required
                                            <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="idnumber" class="text-primary">ID Number:</label>
                                            <input type="number" name="idnumber" id="idnumber" value="<?php echo $id; ?>" 
                                            placeholder="Enter your id number" class="form-control" min="0" required
                                            <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="birthdate" class="text-primary">Birthdate:</label>
                                            <input type="date" name="birthdate" id="birthdate" value="<?php echo $birthdate; ?>" 
                                            class="form-control" data-relmax="-18" required
                                            <?php echo $formDisabled; ?>>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="card container-fluid shadow">
                                <div class="card-title text-primary font-weight-bold" style="font-size: 1.2em;">Credit
                                    Card Information</div>
                                <div class="card-body">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="cardnumber" class="text-primary">Card number</label>
                                            <input type="text" name="cardnumber" id="cardnumber"
                                                placeholder="Enter your card number" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="nameoncard" class="text-primary">Name on the card-body</label>
                                            <input type="text" name="nameoncard" id="nameoncard"
                                                placeholder="Enter the name on the card" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="expirationdate" class="text-primary">Expiration date</label>
                                            <input type="month" name="expirationdate" id="expirationdate" data-relmin="0"
                                                placeholder="Enter expiration date" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="cvc" class="text-primary">CVC</label>
                                            <input type="number" name="cvc" id="cvc" placeholder="Enter the CVC" min="0"
                                                class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="row ml-md-2 h-100">
                        <div class="card mt-5 mt-md-0 container-fluid shadow">
                            <div class="card-title text-primary font-weight-bold" style="font-size: 1.2em;">Reservation
                                Details</div>
                            <div class="card-body">
                                <div class="row mt-3">
                                    <div class="col-6 text-primary">Check-in Date: </div>
                                    <div class="col-6"><?php echo $checkindate; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 text-primary">Check-out Date: </div>
                                    <div class="col-6"><?php echo $checkoutdate; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 text-primary">Room Type: </div>
                                    <div class="col-6"><?php echo $_SESSION["reservationinfo"]["roomtype"]; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 text-primary">Door Number: </div>
                                    <div class="col-6"><?php echo $doornumber; ?></div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-6 text-primary">Price: </div>
                                    <div class="col-6"><?php echo $totalprice; ?> USD</div>
                                </div>
                                <button type="button" onclick="onBookNow()" id="bookNowBtn" class="btn btn-primary w-100 mt-5"
                                    data-toggle="modal" data-target="#paymentmodal">Book Now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal -->
                <div class="modal fade" id="paymentmodal" tabindex="-1" role="dialog"
                aria-labelledby="paymentmodallabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="paymentmodallabel">Payment</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            After this payment will be made. Are you sure to continue?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">No</button>
                            <button type="button"  class="btn btn-primary" onClick="bookNow()" data-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            </div>
        </div>
    </section>

    <script>
        // Disable form submissions if there are invalid fields
        /*(function () {
            'use strict';
            window.addEventListener('load', function () {
                // Get the forms we want to add validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();*/

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

        function onBookNow() {
            var forms = document.getElementsByClassName('needs-validation');

            var validation = Array.prototype.filter.call(forms, function (form) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                });
        }
    </script>
    <script src="js/booknow.js"></script>

    <?php require 'footers/footer.php'?>