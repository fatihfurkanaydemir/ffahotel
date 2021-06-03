<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";

    $conn = connectdb();

    $messagecount = $conn->query("SELECT COUNT(*) AS messagecount FROM message")->fetch_assoc()["messagecount"];

    closedb($conn);
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-star d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Messages</span>
                                    <span class="d-block" style="font-size: 2em;"> <?php echo $messagecount; ?> </span>
                                </button>
                            </div>
                        </div>

                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Customer Id</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Datetime</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Mark As Read</th>
                                  </tr>
                                </thead>
                                <tbody id="tablecontent">
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/message_operations.js"></script>

<?php require "../footers/managerfooter.php"?>