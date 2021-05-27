<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";

    

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $roomtype = $_POST["roomtype"];
        $floor = $_POST["floor"];
        $doornumber = $_POST["doornumber"];

        $toastmsg = "";

        $conn = connectdb();

        $sql = "INSERT INTO room VALUES($doornumber, '$roomtype', $floor, 'empty')";
        $result = $conn->query($sql);

        if($result == true) {
            $toastmsg = "<i class='fa fa-check text-success rounded mr-2'></i> Room added successfully";
        } else {
            $toastmsg = "<i class='fa fa-times text-danger rounded mr-2'></i> Room already exists";
        }

        closedb($conn);
        
        $toast = "<div class='position-fixed p-3' style='z-index: 5; right: 0; bottom: 0;'>
                      <div id='liveToast' class='toast hide' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000'>
                        <div class='toast-header' style='font-size: 1.3em;'>
                          <strong class='mr-auto'>System</strong>
                          <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>

                        <div class='toast-body m-2' style='font-size: 1.3em;'>
                          $toastmsg
                        </div>
                      </div>
                    </div>";

        echo $toast;
    }
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Add Room</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="roomtype" class="text-primary">Select the room type: </label>
                                            <select id="roomtype" class="custom-select" name="roomtype">
                                                <option value="vip">VIP Room</option>
                                                <option value="family">Family Room</option>
                                                <option value="double">Double Room</option>
                                                <option value="single">Single Room</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="floor" class="text-primary">Select the floor: </label>
                                            <select id="floor" class="custom-select" name="floor">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="doornumber" class="text-primary">Door number: </label>
                                            <input type="number" name="doornumber" id="doornumber" placeholder="Enter door number" class="form-control" min="0" maxlength="3" required>
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
                (function() {
                  'use strict';
                  window.addEventListener('load', function() {
                    var forms = document.getElementsByClassName('needs-validation');
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

                $('.toast').toast('show');
                
            </script>


<?php require "../footers/managerfooter.php"; ?>