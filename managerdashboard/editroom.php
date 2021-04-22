<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Edit Room</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="roomtypeselect" class="text-primary">Select the room type: </label>
                                            <select id="roomtypeselect" class="custom-select">
                                                <option name="viproom">VIP Room</option>
                                                <option name="familyroom">Family Room</option>
                                                <option name="doublerooom">Double Room</option>
                                                <option name="singleroom" selected>Single Room</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="floorselect" class="text-primary">Select the floor: </label>
                                            <select id="floorselect" class="custom-select">
                                                <option name="1">1</option>
                                                <option name="2" selected>2</option>
                                                <option name="3">3</option>
                                                <option name="4">4</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="doornumber" class="text-primary">Room number: </label>
                                            <input type="number" name="doornumber" id="doornumber" placeholder="Enter room number" class="form-control" min="0" value="201" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>                                
                                    <input type="submit" value="Save" class="btn btn-primary mt-3 shadow" style="width: 100%;">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                // Disable form submissions if there are invalid fields
                (function() {
                  'use strict';
                  window.addEventListener('load', function() {
                    // Get the forms we want to add validation styles to
                    var forms = document.getElementsByClassName('needs-validation');
                    // Loop over them and prevent submission
                    var validation = Array.prototype.filter.call(forms, function(form) {
                      form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                          event.preventDefault();
                          event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                      }, false);
                    });
                  }, false);
                })();
            </script>

<?php require "../footers/managerfooter.php"; ?>