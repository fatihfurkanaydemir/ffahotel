<?php 
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
     }

     function validatePhoneNumber($phoneNumber)
     {
         $phoneNumber = filter_var($phoneNumber, FILTER_SANITIZE_NUMBER_INT);

         if (strlen($phoneNumber) < 10 || strlen($phoneNumber) > 13) {
             return false;
         } else {
            return true;
         }
     }

     function validateIDNumber($idNumber)
     {
         $idNumber = filter_var($idNumber, FILTER_SANITIZE_NUMBER_INT);
         return strlen($idNumber) == 11;
     }
?>