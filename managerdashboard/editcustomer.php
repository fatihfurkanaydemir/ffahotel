<?php require "../headers/managerheader.php"; ?>

<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        include "../dbconnect.php";

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
    }
    else {
        header("Location: customers.php");
    }
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Edit Customer</span>
                            </div>
                            <div class="card-body">
                                <form id="edituserform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="fname" class="text-primary">First name: </label>
                                            <input type="text" name="fname" id="fname" placeholder="Enter first name" value="<?php echo $user["fname"]; ?>" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="lname" class="text-primary">Last name: </label>
                                            <input type="text" name="lname" id="lname" placeholder="Enter last name" value="<?php echo $user["lname"]; ?>" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="phonenumber" class="text-primary">Phone number: </label>
                                            <input type="tel" name="phonenumber" id="phonenumber" placeholder="Enter phone number" value="<?php echo $user["phonenumber"]; ?>" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="email" class="text-primary">E-mail: </label>
                                            <input type="email" name="email" id="email" placeholder="Enter E-mail" value="<?php echo $user["email"]; ?>" class="form-control" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>    

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="birthdate" class="text-primary">Birthdate:</label>
                                            <input type="date" name="birthdate" id="birthdate" data-relmax="-18" class="form-control" value="<?php echo $user["birthdate"]; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="id" class="text-primary">ID Number: </label>
                                            <input type="number" name="id" id="id" placeholder="Enter id number" class="form-control" value="<?php echo $user["id"]; ?>" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>        
                                    <input type="hidden" name="oldid" value="<?php echo $user["id"]; ?>">                       
                                    <input type="hidden" name="oldemail" value="<?php echo $user["email"]; ?>">                       
                                    <button type="button" id="btn-edituser" onClick="editUser()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="js/customer_operations.js"></script>
            <script>
            $(function () {
                $('input[data-relmax]').each(function () {
                    var oldVal = $(this).prop('value');
                    var relmax = $(this).data('relmax');
                    var max = new Date();
                    max.setFullYear(max.getFullYear() + relmax);
                    $.prop(this, 'max', $(this).prop('valueAsDate', max).val());
                    $.prop(this, 'value', oldVal);
                });
            });
            </script>


<?php require "../footers/managerfooter.php"?>