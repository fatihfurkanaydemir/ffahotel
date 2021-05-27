<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        
                    <?php require "roomsheadbuttons.php" ?>

                        <!-- Delete Room Modal -->
                        <div class="modal fade" id="deleteRoomModal" tabindex="-1" role="dialog" aria-labelledby="deleteRoomModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteRoomModalLabel">Delete Room</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the room ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary" onClick='deleteRoom();' data-dismiss="modal">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Room Modal -->
                        <div class="row w-100 mx-2 mt-4">
                            <a href="addroom.php" class="btn btn-primary float-right mb-1" style="width: 30%;">
                                <i class="fa fa-plus"></i>
                                Add Room
                            </a>
                        </div>
                        <div class="row w-100 mx-2" style="max-height: 500px; overflow: auto;">
                            
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Door Number</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Floor</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit/Delete</th>
                                  </tr>
                                </thead>
                                <tbody id="tableContent">
                                    <?php include "../php/get_rooms.php"; ?>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Toast -->
            <div class='position-fixed p-3' style='z-index: 5; right: 0; bottom: 0;'>
                <div id='successToast' class='toast hide' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000'>
                    <div class='toast-header' style='font-size: 1.3em;'>
                        <strong class='mr-auto'>System</strong>
                        <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='toast-body m-2' style='font-size: 1.3em;'>
                        <i class='fa fa-check text-success rounded mr-2'></i>
                          Room deleted successfully
                    </div>
                </div>
            </div>
            <!-- Failure Toast -->
            <div class='position-fixed p-3' style='z-index: 5; right: 0; bottom: 0;'>
                <div id='failureToast' class='toast hide' role='alert' aria-live='assertive' aria-atomic='true' data-delay='3000'>
                    <div class='toast-header' style='font-size: 1.3em;'>
                        <strong class='mr-auto'>System</strong>
                        <button type='button' class='ml-2 mb-1 close' data-dismiss='toast' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='toast-body m-2' style='font-size: 1.3em;'>
                        <i class='fa fa-times text-danger rounded mr-2'></i>
                          Room could not be deleted
                    </div>
                </div>
            </div>

            <script>
            var roomToDelete = 0;

            function selectRoomToDelete(doornumber) {
                roomToDelete = doornumber;
            }

            function deleteRoom() {
                var xhttp = new XMLHttpRequest();
                var params = "doornumber=" + roomToDelete;

                xhttp.open("POST", "../php/delete_room.php?" + params, true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    if(xhttp.responseText == "true") {
                        $("#successToast").toast("show");
                        getRooms();
                        console.log("Updated");
                    }
                    else {
                        $("#failureToast").toast("show");
                    }
                  }
                };
            
                xhttp.send(params);
            }

            function getRooms() {
                var xhttp = new XMLHttpRequest();
                xhttp.open("POST", "../php/get_rooms.php", true);

                xhttp.onreadystatechange = function() {
                  if (this.readyState == 4 && this.status == 200) {
                    $("#tableContent").html(xhttp.responseText);
                  }
                };

                xhttp.send();
            }

            </script>
<?php require "../footers/managerfooter.php"; ?>