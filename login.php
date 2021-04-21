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
        $wrongCredentialsOrNotValidError = "";
        $bootstrapValidation = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = test_input($_POST["password"]);
        
            if(empty($email) || empty($password)) {
                $bootstrapValidation = "was-validated";      
            }  
            else {
                if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                    $bootstrapValidation = "";
    
                    $wrongCredentialsOrNotValidError = "<div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Please enter a valid email
                        </div>";
                }
                else {
                    if($email == "furkanaydemir6@gmail.com" && $password == "12345") {
                        header("Location: userdashboard.php");
                    }
                    else {
                        $wrongCredentialsOrNotValidError = "<div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Your email or password is wrong
                        </div>";
                    }
                }
                
            }
        }
    
        function test_input($data) {
           $data = trim($data);
           $data = stripslashes($data);
           $data = htmlspecialchars($data);
           return $data;
         }
    ?>
                    <!-- Form Control -->

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <div class="card login-card shadow-lg">
                <div class="card-body align-items-center flex-column">
                    <img src="img/loginUserIcon.png" alt="Login Icon" class="card-img-top img-fluid w-25 mx-auto d-block">
                    <?php echo $wrongCredentialsOrNotValidError; ?>
                    <form id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="needs-validation <?php echo $bootstrapValidation ?> " novalidate>
                        <div class="form-group mt-5">
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <input type="submit" value="Login" class="btn btn-primary mt-3 shadow" style="width: 100%;">
                    </form>
                </div>
                <div class="card-footer text-center">
                    <span>Don't have an account?</span>
                    <a href="register.php" class="btn btn-info form-control mt-3 shadow"> Sign Up Now</a>
                </div>
            </div>
        </div>
    </section>  
    <?php require 'footers/footer.php'?> 
</body>
</html>