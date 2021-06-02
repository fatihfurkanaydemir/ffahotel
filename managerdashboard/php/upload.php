<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    move_uploaded_file(
        $_FILES['pdf']['tmp_name'], 
        $_SERVER['DOCUMENT_ROOT'] . "/reports/" . $_POST["filename"]
    );
}
?>