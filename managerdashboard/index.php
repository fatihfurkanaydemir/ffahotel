<?php
    include "../dbconnect.php";
    include "../validations.php";

    session_name("manager");
    session_start();
    
    if(isset($_SESSION["logged_in"])) {
        header("Location: dashboard.php");
        die();
    }

    $wrongCredentialsOrNotValidError = "";
    $bootstrapValidation = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $password = test_input($_POST["password"]);
    
        if(empty($email) || empty($password)) {
            $bootstrapValidation = "was-validated";      
        }  
        else {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $bootstrapValidation = "";

                $wrongCredentialsOrNotValidError = "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    Please enter a valid email
                    </div>";
            }
            else {
                $conn = connectdb();
                $sql = "SELECT id, password, fname, lname, phonenumber FROM manager WHERE email = '$email'";
                $result = $conn->query($sql);
                if($result->num_rows == 0) {                        
                    $wrongCredentialsOrNotValidError = "
                    <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                    <i class='fa fa-exclamation-triangle'></i>
                    You are not registered
                    </div>";
                    closedb($conn);
                }
                else {
                    $row = $result->fetch_assoc();
                    $mid = $row["id"];
                    $mpass = $row["password"];
                    closedb($conn);
                    if(password_verify($password, $mpass)) {
                        $_SESSION["logged_in"] = 1;
                        $_SESSION["mid"] = $mid;
                        $_SESSION["mfname"] = $row["fname"];
                        $_SESSION["mlname"] = $row["lname"];
                        $_SESSION["mphonenumber"] = $row["phonenumber"];
                        $_SESSION["memail"] = $email;
                        
                        header("Location: dashboard.php");
                    }
                    else {
                        $wrongCredentialsOrNotValidError = "
                        <div class='text-center text-danger mt-2 font-weight-bold' style='font-size: 1.3em;'>
                        <i class='fa fa-exclamation-triangle'></i>
                        Your email or password is wrong
                        </div>";
                    }
                }
            }
            
        }
    }
    ?>

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

    <link rel="stylesheet" href="../css/main.css">

    <title>Welcome to FFA Hotel</title>
</head>
<body>
    <header class="main-header">
    </header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark sticky-top">
        <a href="../index.php" class="navbar-brand">
            <img src="../img/Logo.png" alt="Logo" width="60">
            <span class="text-info navbar-logo-text">FFAHOTEL</span>
        </a>
    </nav>

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <div class="card login-card shadow-lg">
                <div class="card-body align-items-center flex-column">
                    <img src="../img/loginUserIcon.png" alt="Login Icon" class="card-img-top img-fluid w-25 mx-auto d-block">
                    <?php echo $wrongCredentialsOrNotValidError; ?>
                    <form id="loginform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation <?php echo $bootstrapValidation; ?>" novalidate>
                        <div class="form-group mt-5">
                            <input type="text" name="email" id="email" placeholder="Email" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" id="password" placeholder="Password" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <input type="submit" value="Login" class="btn btn-primary mt-3 shadow" style="width: 100%;">
                    </form>
                </div>
            </div>
        </div>


<?php require "../footers/managerfooter.php"; ?>