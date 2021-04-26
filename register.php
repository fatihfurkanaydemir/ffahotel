    <?php require 'headers/header.php'?>

    <!-- Form Control -->
    <?php
        $notValidError = "";
        $bootstrapValidation = "";
        $success = true;

        $successMsg = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = test_input($_POST["fname"]);
            $lname = test_input($_POST["lname"]);
            $phoneNumber = test_input($_POST["phonenumber"]);
            $idnumber = test_input($_POST["idnumber"]);
            $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = test_input($_POST["password"]);
            $passwordAgain = test_input($_POST["passwordagain"]);
        
            if(empty($fname) || empty($lname) || empty($phoneNumber) || empty($email) || empty($password) || empty($passwordAgain) || empty($idnumber)) {
                $bootstrapValidation = "was-validated"; 
                $success = false;     
            }  
            else {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $bootstrapValidation = "";

                    $success = false; 

                    $notValidError = "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid email
                    </div>";
                }
                if(!validatePhoneNumber($phoneNumber)) {
                    $bootstrapValidation = "";
    
                    $success = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid phone number
                    </div>";
                }  

                if(strcmp($password, $passwordAgain) != 0) {
                    $bootstrapValidation = "";
    
                    $success = false; 

                    $notValidError .= "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Your passwords does not match
                    </div>";
                }  
                            
            }

            if($success) {
                $successMsg = "
                <div class='text-center text-success mt-2 font-weight-bold' style='font-size: 1.5em;'>
                <i class='fa fa-tick'></i>
                You are successfully registered
                </div>";
            }
        }
    
        function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
        }

        function validatePhoneNumber($phonenumber)
        {
            $phonenumber = filter_var($phonenumber, FILTER_SANITIZE_NUMBER_INT);

            if (strlen($phonenumber) < 10 || strlen($phonenumber) > 13) {
                return false;
            } else {
               return true;
            }
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
                            <input type="text" name="fname" id="fname" placeholder="Enter your first name" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="text" name="lname" id="lname" placeholder="Enter your last name" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="tel" name="phonenumber" id="phonenumber" placeholder="Enter your phone number" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="number" name="idnumber" id="idnumber" placeholder="Enter your id number" class="form-control" min="0" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
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

    <?php require 'footers/footer.php'?>