<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";

    $conn = connectdb();

    $reviewcount = $conn->query("
        SELECT COUNT(*) as reviewcount
        FROM reservation res JOIN comment com ON com.id = res.commentid
        JOIN customer cus ON res.customerid = cus.id
        ")->fetch_assoc()["reviewcount"];

    closedb($conn);
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-star d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reviews</span>
                                    <span class="d-block" style="font-size: 2em;"> <?php echo $reviewcount; ?> </span>
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
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="deleteReview()">Yes</button>
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
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Text</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Delete</th>
                                  </tr>
                                </thead>
                                <tbody id="tablecontent">
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/review_operations.js"></script>

<?php require "../footers/managerfooter.php"?>