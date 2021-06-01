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
<section class="main-section container-fluid">
    <div class="row align-items-center flex-column">
        <div class="card login-card shadow-lg">
            <div class="card-body align-items-center flex-column">
                <img src="../img/loginUserIcon.png" alt="Login Icon" class="card-img-top img-fluid w-25 mx-auto d-block">
                <form id="registerform" action="#" method="POST" class="needs-validation" novalidate>
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
                    <button type="button" id="signUpBtn" onClick="createManager()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Create Account</button>
                </form>
            </div>
        </div>
    </div>
    <script src="js/create_manager.js"></script>

<?php require "../footers/managerfooter.php"; ?>