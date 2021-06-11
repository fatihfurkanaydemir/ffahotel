<?php
        include "../dbconnect.php";
        include "../validations.php";

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

            switch(checkRegistration($idNumber, $email)) {
                case "newcus":
                    if(registerUser($fname, $lname, $phoneNumber, $idNumber, $email, $password, $birthdate)) { echo "true"; die(); }
                    else { echo "err"; die();}
                    break;
                case "cusexists": 
                    if(updateUser($fname, $lname, $phoneNumber, $idNumber, $email, $password, $birthdate)) { echo "true"; die(); }
                    else { echo "err"; die();}
                    break;
                case "err-emailused": echo "err-emailused"; die(); break;
                case "err-idused": echo "err-idused"; die(); break;
                case "err-accountexistsid": echo "err-accountexistsid"; die(); break;
                case "err-accountexistsemail": echo "err-accountexistsemail"; die(); break;
            }      
            
        }

        function checkRegistration($id, $email) {
            $conn = connectdb();
        
            $sql = "SELECT id, email, password FROM customer WHERE id = $id";
            $result = $conn->query($sql);
        
            $q1id = $q1email = "";
            $q2id = $q2email = "";
        
            if($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                if($row["password"] != "") {    
                    closedb($conn);
                    return "err-accountexistsid";
                }
                $q1id = $row["id"];
                $q1email = $row["email"];
            }
        
            $sql = "SELECT id, email, password FROM customer WHERE email = '$email'";
            $result = $conn->query($sql);
        
            if($result->num_rows != 0) {
                $row = $result->fetch_assoc();
                if($row["password"] != "") {
                    closedb($conn);
                    return "err-accountexistsemail";
                }
                $q2id = $row["id"];
                $q2email = $row["email"];
            }
        
            closedb($conn);
        
            if($q1id == "" && $q2id == "") {
                return "newcus";
            }
            else if($q1email == $q2email && $q1id == $q2id) {
                return "cusexists";
            }
            else if($q1email != $q2email) {
                return "err-emailused";
            }
            else if($q1id == $q2id) {
                return "err-idused";
            }
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
    
        function updateUser($fname, $lname, $phoneNumber, $id, $email, $password, $birthdate) {
            
            $conn = connectdb();

            $encPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "UPDATE customer SET 
            fname='$fname', lname='$lname', birthdate='$birthdate', phonenumber='$phoneNumber', password='$encPassword'
            WHERE id='$id' AND email='$email'";
        
            if ($conn->query($sql) !== TRUE) {
                return false;
            }
              
            closedb($conn);
            
            return true;
        }
        
?>