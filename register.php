<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/main.css">

    <title>Welcome to FFA Hotel</title>
</head>
<body>
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
            $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = test_input($_POST["password"]);
        
            if(empty($fname) || empty($lname) || empty($phoneNumber) || empty($email) || empty($password)) {
                $bootstrapValidation = "was-validated"; 
                $success = false;     
            }  
            else {
                if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $bootstrapValidation = "";
                    $success = false; 
                    $notValidError = "<div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Please enter a valid email
                        </div>";
                }
                if(!validatePhoneNumber($phoneNumber)) {
                    $bootstrapValidation = "";
    
                    $notValidError .= "<div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Please enter a valid phone number
                        </div>";
                        $success = false; 
                }  
                            
            }

            if($success) {
                $successMsg = "<div class='text-center text-success mt-2 font-weight-bold' style='font-size: 1.5em;'>
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
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" required>
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
</body>
</html>