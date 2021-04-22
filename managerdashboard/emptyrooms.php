<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 d-flex flex-row justify-content-around align-items-center p-3">
                            <div class="col-3">
                                <a href="rooms.php" class="btn btn-secondary w-100 py-4">
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
                                <a href="emptyrooms.php" class="btn btn-secondary w-100 py-4 active">
                                    <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Empty Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 50 </span>
                                </a>
                            </div>
                        </div>
                        
                        <div class="row w-100 mt-2">
                            <div class="row mx-3 mb-1">
                                <div class="col">
                                    <span class="text-primary">Search an empty room for a range of date: </span>
                                </div>
                            </div>
                            <div class="form-row w-100 mx-3">
                                <div class="col-5">
                                    <input type="date" class="form-control d-inline-block">
                                </div>
                                <div class="col-5">
                                    <input type="date" class="form-control d-inline-block">
                                </div>
                                <div class="col-2">
                                    <button type="button" class="btn btn-primary btn-block">Search</button>
                                </div>
                            </div>
                        </div>
                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Room Id</th>
                                    <th scope="col">Room Type</th>
                                    <th scope="col">Floor</th>
                                    <th scope="col">Door Number</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  <tr>
                                    <td>15</td>
                                    <td>Single Room</td>
                                    <td>123456</td>
                                    <td>201</td>
                                  </tr>
                                  
                                  
                                  
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

<?php require "../footers/managerfooter.php"; ?>