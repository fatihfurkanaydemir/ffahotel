<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 d-flex flex-row justify-content-around align-items-center p-3">
                            <div class="col-3">
                                <a href="rooms.php" class="btn btn-secondary w-100 py-4 active">
                                    <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 250 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="bookingrooms.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-calendar d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Booking Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 50 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="bookedrooms.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-bed d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Booked Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 150 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="emptyrooms.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Empty Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 50 </span>
                                </a>
                            </div>
                        </div>

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
                                        <button type="button" class="btn btn-primary">Yes</button>
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
                                    <th scope="col">Room Id</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Floor</th>
                                    <th scope="col">Door Number</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Edit/Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>2</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>202</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Single Room</td>
                                    <td>2</td>
                                    <td>201</td>
                                    <td>50</td>
                                    <td>Empty</td>
                                    <td>
                                        <a href="editroom.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteRoomModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

<?php require "../footers/managerfooter.php"; ?>