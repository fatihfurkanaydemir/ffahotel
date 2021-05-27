    <?php require 'headers/header.php'?>

    <!-- Form Control -->
    <?php
        include "dbconnect.php";
        include "validations.php";

        $notValidError = "";
        $bootstrapValidation = "";
        $formValidated = true;

        $successMsg = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = test_input($_POST["fname"]);
            $lname = test_input($_POST["lname"]);
            $phoneNumber = test_input($_POST["phonenumber"]);
            $idNumber = test_input($_POST["idnumber"]);
            $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = test_input($_POST["password"]);
            $passwordAgain = test_input($_POST["passwordagain"]);
            $birthdate = test_input($_POST["birthdate"]);
        
            if(empty($fname) || empty($lname) || empty($phoneNumber) || empty($email) || empty($password) || empty($passwordAgain) || empty($idNumber) || empty($birthdate)) {
                $bootstrapValidation = "was-validated"; 
                $formValidated = false;     
            }  
            else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $bootstrapValidation = "";

                    $formValidated = false; 

                    $notValidError = "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid email
                    </div>";
                }
                if(!validatePhoneNumber($phoneNumber)) {
                    $bootstrapValidation = "";
    
                    $formValidated = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid phone number
                    </div>";
                }  

                if(!validateIDNumber($idNumber)) {
                    $bootstrapValidation = "";
    
                    $formValidated = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid id number
                    </div>";
                } 

                if(strcmp($password, $passwordAgain) != 0) {
                    $bootstrapValidation = "";
    
                    $formValidated = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Your passwords does not match
                    </div>";
                }  
                            
            }

            if($formValidated) {

                $checkMsg = checkRegistration($idNumber, $email);

                if($checkMsg !== true) {
                    $successMsg = "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.5em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    $checkMsg
                    </div>";

                } else {
                    if(registerUser($fname, $lname, $phoneNumber, $idNumber, $email, $password, $birthdate))
                    {
                        $successMsg = "
                        <div class='text-center text-success mt-2 font-weight-bold' style='font-size: 1.5em;'>
                        <i class='fa fa-tick'></i>
                        You are successfully registered
                        </div>";

                    }
                    else {
                        $successMsg = "
                        <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.5em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Registration failed
                        </div>";

                    }
                }       
            }
        }

        function checkRegistration($id, $email) {
            $conn = connectdb();

            $sql = "SELECT id FROM customer WHERE id = $id";
            $result = $conn->query($sql);

            if($result->num_rows != 0) {
                closedb($conn);
                return "This id is already registered";
            }

            $sql = "SELECT email FROM customer WHERE email = '$email'";
            $result = $conn->query($sql);

            if($result->num_rows != 0) {
                closedb($conn);
                return "This email is already used";
            }

            closedb($conn);

            return true;
        }

        function registerUser($fname, $lname, $phoneNumber, $id, $email, $password, $birthdate) {
            
            $conn = connectdb();

            $encPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO customer VALUES($id, '$fname', '$lname', '$birthdate', '$phoneNumber', '$email', '$encPassword', 'out')";
        
            if ($conn->query($sql) !== TRUE) {
                return false;
            }
              
            closedb($conn);
            
            return true;
        }
    
        
    ?>

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <div class="card login-card shadow-lg">
                <div class="card-body align-items-center flex-column">
                    <img src="img/loginUserIcon.png" alt="Login Icon" class="card-img-top img-fluid w-25 mx-auto d-block">
                    <?php echo $notValidError; ?>
                    <?php echo $successMsg; ?>
                    <form id="registerform" action="#" method="POST" class="needs-validation <?php echo $bootstrapValidation ?> " novalidate>
                        <div class="form-group mt-5">
                            <label for="fname" class="text-primary">First Name:</label>
                            <input type="text" name="fname" id="fname" placeholder="Enter your first name" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="lname" class="text-primary">Last Name:</label>
                            <input type="text" name="lname" id="lname" placeholder="Enter your last name" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="phonenumber" class="text-primary">Phone Number:</label>
                            <input type="tel" name="phonenumber" id="phonenumber" placeholder="Enter your phone number" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="idnumber" class="text-primary">ID Number:</label>
                            <input type="number" name="idnumber" id="idnumber" placeholder="Enter your id number" class="form-control" min="0" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="birthdate" class="text-primary">Birthdate:</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" data-relmax="-18" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-primary">Email:</label>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-primary">Password:</label>
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <label for="passwordagain" class="text-primary">Password Again:</label>
                            <input type="password" name="passwordagain" id="passwordagain" placeholder="Enter your password again" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <input type="submit" value="Sign Up" class="btn btn-primary mt-3 shadow" style="width: 100%;">
                    </form>
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
    </script>

    <?php require 'footers/footer.php'?>