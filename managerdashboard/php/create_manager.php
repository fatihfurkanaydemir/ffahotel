<?php
        include "../../dbconnect.php";
        include "../../validations.php";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $fname = test_input($_POST["fname"]);
            $lname = test_input($_POST["lname"]);
            $phoneNumber = test_input($_POST["phonenumber"]);
            $idNumber = test_input($_POST["idnumber"]);
            $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
            $password = test_input($_POST["password"]);
            $passwordAgain = test_input($_POST["passwordagain"]);
        
            if(empty($fname) || empty($lname) || empty($phoneNumber) || empty($email) || empty($password) || empty($passwordAgain) || empty($idNumber)) {
                echo "err-notvalid";
                die();   
            }  
            
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "err-email";
                die(); 
            }
            if(!validatePhoneNumber($phoneNumber)) {
                echo "err-phonenumber";
                die(); 
            }  
            if(!validateIDNumber($idNumber)) {
                echo "err-idnumber";
                die(); 
            } 
            if(strcmp($password, $passwordAgain) != 0) {
                echo "err-password";
                die(); 
            }  


            if(checkRegistration($idNumber, $email) === true ) {
                registerUser($fname, $lname, $phoneNumber, $idNumber, $email, $password);
                echo "true";
                die();
            }
            else {
                echo "err-accountexists";
                die();
            }
            
        }

        function checkRegistration($id, $email) {
            $conn = connectdb();
        
            $sql = "SELECT id, email, password FROM manager WHERE id = $id";
            $result = $conn->query($sql);
        
            if($result->num_rows != 0) {
                return "err-accountexists";
            }
        
            $sql = "SELECT id, email, password FROM manager WHERE email = '$email'";
            $result = $conn->query($sql);
        
            if($result->num_rows != 0) {
                return "err-accountexists";
            }

            return true;
        
            closedb($conn);
        }

        function registerUser($fname, $lname, $phoneNumber, $id, $email, $password) {
            
            $conn = connectdb();

            $encPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO manager VALUES($id, '$fname', '$lname', '$phoneNumber', '$email', '$encPassword')";
        
            if ($conn->query($sql) !== TRUE) {
                return false;
            }
              
            closedb($conn);
            
            return true;
        }    
?>