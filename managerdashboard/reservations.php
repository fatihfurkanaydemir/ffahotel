<?php require "../headers/managerheader.php"; ?>
                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-calendar-check-o d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reservations</span>
                                    <span class="d-block" style="font-size: 2em;"> 250 </span>
                                </button>
                            </div>
                        </div>

                        <!-- Delete Reservation Modal -->
                        <div class="modal fade" id="deleteReservationModal" tabindex="-1" role="dialog" aria-labelledby="deleteReservationModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteReservationModalLabel">Delete Reservation</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the reservation ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Reservation Modal -->
                        <div class="row w-100 mx-2 mt-4">
                            <a href="addreservation.php" class="btn btn-primary float-right mb-1" style="width: 30%;">
                                <i class="fa fa-plus"></i>
                                Add new reservation
                            </a>
                        </div>
                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Reservation Id</th>
                                    <th scope="col">Customer First Name</th>
                                    <th scope="col">Customer Last Name</th>
                                    <th scope="col">Room Id</th>
                                    <th scope="col">Check-in Date</th>
                                    <th scope="col">Check-out Date</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Edit/Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>Fatih Furkan</td>
                                    <td>Aydemir</td>
                                    <td>15</td>
                                    <td>01.04.2021</td>
                                    <td>06.04.2021</td>
                                    <td>250</td>
                                    <td>
                                        <a href="editreservation.php" type="button" class="btn btn-primary">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReservationModal">
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

<?php require "../footers/managerfooter.php"?>