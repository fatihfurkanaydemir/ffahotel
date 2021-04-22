<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-star d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reviews</span>
                                    <span class="d-block" style="font-size: 2em;"> 15 </span>
                                </button>
                            </div>
                        </div>

                        <!-- Delete Review Modal -->
                        <div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog" aria-labelledby="deleteReviewModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteReviewModalLabel">Delete Review</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete the review ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-primary">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Delete Review Modal -->

                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Review</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                        <i class="fa fa-star rating-stars"></i>
                                    </td>
                                    <td>Very nice hotel, good service and comfort.</td>
                                    <td>
                                        <i class="fa fa-user"></i>
                                        Fatih Furkan Aydemir
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReviewModal">
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