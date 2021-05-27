<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";

    $doornumber = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $doornumber = $_POST["doornumber"];

        if(isset($_POST["ed"])) {
            $newdoornumber = $_POST["newdoornumber"];
            $roomtype = $_POST["roomtype"];
            $floor = $_POST["floor"];

            $conn = connectdb();
            
            $sql = "UPDATE room SET doornumber=$newdoornumber, roomtype='$roomtype', floor=$floor WHERE doornumber=$doornumber";
            $result = $conn->query($sql);

            $toastMsg = "";

            if($result === true) {
                $toastMsg = "<i class='fa fa-check text-success rounded mr-2'></i> Room updated successfully";
                $doornumber = $newdoornumber;
            } else {
                $toastMsg = "<i class='fa fa-times text-danger rounded mr-2'></i> Update failed";
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
                          $toastMsg
                        </div>
                      </div>
                    </div>";

            echo $toast;
        }
    } 
    else { header("Location: rooms.php"); }

?>
                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Edit Room</span>
                            </div>
                            <div class="card-body">
                                <form id="editroomform" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="needs-validation" novalidate>
                                    <input type="hidden" name="ed" value="1"></input>
                                    <input type="hidden" name="doornumber" value="<?php echo $doornumber; ?>"></input>

                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="roomtype" class="text-primary">Select the room type: </label>
                                            <select id="roomtype" name="roomtype" class="custom-select">
                                                <option value="vip">VIP Room</option>
                                                <option value="family">Family Room</option>
                                                <option value="double">Double Room</option>
                                                <option value="single">Single Room</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="floor" class="text-primary">Select the floor: </label>
                                            <select id="floor" name="floor" class="custom-select">
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
                                            <label for="newdoornumber" class="text-primary">Room number: </label>
                                            <input type="number" name="newdoornumber" id="newdoornumber" placeholder="Enter room number" class="form-control" min="0" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>                                
                                    <input type="submit" value="Save" onClick="getRoom()" class="btn btn-primary mt-3 shadow" style="width: 100%;">
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


                $(".toast").toast("show");

                getRoom();
                
                function getRoom() {
                    var xhttp = new XMLHttpRequest();
                    var params = "doornumber=" + "<?php echo $doornumber; ?>";

                    console.log(params);

                    xhttp.open("POST", "../php/get_room.php?" + params, true);

                    xhttp.onreadystatechange = function() {
                      if (this.readyState == 4 && this.status == 200) {
                        var room = JSON.parse(xhttp.responseText);

                        var typeIndex = null;
                        if(room.roomtype == "vip") typeIndex = 0;
                        else if(room.roomtype == "family") typeIndex = 1;
                        else if(room.roomtype == "double") typeIndex = 2;
                        else if(room.roomtype == "single") typeIndex = 3;

                        $("#newdoornumber").attr("value", room.doornumber);
                        $("#floor").prop('selectedIndex',room.floor - 1);
                        $("#roomtype").prop('selectedIndex', typeIndex);
                      }
                    };

                    xhttp.send(params);
                }
            </script>

<?php require "../footers/managerfooter.php"; ?>