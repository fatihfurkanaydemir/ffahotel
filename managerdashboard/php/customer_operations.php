<?php 

include "../../dbconnect.php";
include "../../validations.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["get"])) {
        $conn = connectdb();

        $result = $conn->query("SELECT * FROM customer");

        $tableContent = "";

        if($result->num_rows != 0) {
            while($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $fname = $row["fname"];
                $lname = $row["lname"];
                $birthdate = $row["birthdate"];
                $phonenumber = $row["phonenumber"];
                $email = $row["email"];
                $registered = $row["password"] != "" ? "registered" : "unregistered";
                $status = $row["status"];
            
                $tableContent .= 
                "
                <tr>
                  <td>$id</td>
                  <td>$fname $lname</td>
                  <td>$birthdate</td>
                  <td>$phonenumber</td>
                  <td>$email</td>
                  <td>$registered</td>
                  <td>$status</td>
                  <td>
                    <form id='form-$id' action='editcustomer.php' method='POST'>
                      <input type='hidden' name='id' value='$id'></input>
                      <button type='button' onClick='submitForm(\"form-$id\")' class='btn btn-primary'><i class='fa fa-pencil'></i></button>
                    </form>
                  </td>
                </tr>
                ";
            }
        }

        closedb($conn);

        echo $tableContent;
    }
    else if(isset($_POST["edit"])) {
        $id = test_input($_POST["oldid"]);
        $email = filter_var(test_input($_POST["oldemail"]), FILTER_SANITIZE_EMAIL);

        $newfname = test_input($_POST["fname"]);
        $newlname = test_input($_POST["lname"]);
        $newphoneNumber = test_input($_POST["phonenumber"]);
        $newidNumber = test_input($_POST["id"]);
        $newemail = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $newbirthdate = test_input($_POST["birthdate"]);

        if(empty($newfname) || empty($newlname) || empty($newphoneNumber) || empty($newemail) || empty($newidNumber) || empty($newbirthdate) || empty($id) || empty($email)) {
            echo "err-notvalid";
            die();
        }  
        if(!filter_var($newemail, FILTER_VALIDATE_EMAIL)) {
            echo "err-email";
            die();
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "err-email";
            die();
        }
        if(!validatePhoneNumber($newphoneNumber)) {
            echo "err-phonenumber";
            die();
        }  
    
        if(!validateIDNumber($newidNumber)) {
            echo "err-idnumber";
            die();
        }
    
        if($id != $newidNumber) {
            $conn = connectdb();
    
            $sql = "SELECT id FROM customer WHERE id=$newidNumber";
            $result = $conn->query($sql);
    
            if($result->num_rows != 0) {
                echo "err-duplicateid";
                die();
            }
            closedb($conn);
        }
    
        if($email != $newemail) {
            $conn = connectdb();
    
            $sql = "SELECT email FROM customer WHERE email='$newemail'";
            $result = $conn->query($sql);
            
            if($result->num_rows != 0) {
                echo "err-duplicateemail";
                die();
            }
    
            closedb($conn);
        }

        $conn = connectdb();

        $sql = "UPDATE customer SET
                fname = '$newfname',
                lname = '$newlname',
                email = '$newemail',
                phonenumber = '$newphoneNumber',
                id = $newidNumber,
                birthdate = '$newbirthdate' WHERE id = $id";

        $result = $conn->query($sql);

        closedb($conn);

        if($result == true) {
            echo "true";
            die();

        } else {
            echo "err";
            die();
        }
    }
    else if(isset($_POST["add"])) {
        $fname = test_input($_POST["fname"]);
        $lname = test_input($_POST["lname"]);
        $phoneNumber = test_input($_POST["phonenumber"]);
        $idNumber = test_input($_POST["id"]);
        $email = filter_var(test_input($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $birthdate = test_input($_POST["birthdate"]);

        if(empty($fname) || empty($lname) || empty($phoneNumber) || empty($email) || empty($idNumber) || empty($birthdate)) {
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
    
        $conn = connectdb();

        $sql = "SELECT id FROM customer WHERE id=$idNumber";
        $result = $conn->query($sql);

        if($result->num_rows != 0) {
            echo "err-duplicateid";
            closedb($conn);
            die();
        }    
        
        $sql = "SELECT email FROM customer WHERE email='$email'";
        $result = $conn->query($sql);
        
        if($result->num_rows != 0) {
            echo "err-duplicateemail";
            closedb($conn);
            die();
        }
        
        $sql = "INSERT INTO customer VALUES ($idNumber, '$fname', '$lname', '$birthdate', '$phoneNumber', '$email', NULL, 'out')";

        $result = $conn->query($sql);

        closedb($conn);

        if($result == true) {
            echo "true";
            die();

        } else {
            echo "err";
            die();
        }
    }
    else if(isset($_POST["getuser"])) {
        $id = $_POST["id"];

        $conn = connectdb();

        $result = $conn->query("SELECT * FROM customer WHERE id=$id");


        $user = array();

        if($result->num_rows != 0) {
            $row = $result->fetch_assoc();
            
            $user["fname"] = $row["fname"];
            $user["lname"] = $row["lname"];
            $user["phonenumber"] = $row["phonenumber"];
            $user["birthdate"] = $row["birthdate"];
            $user["email"] = $row["email"];
            $user["id"] = $id;
        }


        closedb($conn);

        echo json_encode($user);
    }
}


?>