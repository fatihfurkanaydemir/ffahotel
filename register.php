    <?php require 'headers/header.php'?>    

    <section class="main-section container-fluid">
        <div class="row align-items-center flex-column">
            <div class="card login-card shadow-lg">
                <div class="card-body align-items-center flex-column">
                    <img src="img/loginUserIcon.png" alt="Login Icon" class="card-img-top img-fluid w-25 mx-auto d-block">
                    <form id="registerform" action="#" method="POST" class="needs-validation <?php echo $bootstrapValidation ?> " novalidate>
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
                            <label for="birthdate" class="text-primary">Birthdate:</label>
                            <input type="date" name="birthdate" id="birthdate" class="form-control" data-relmax="-18" required>
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
                        <button type="button" id="signUpBtn" onClick="registerUser()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </section>  

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
    <script src="js/register_user.js"></script>

    <?php require 'footers/footer.php'?>