<?php require "../headers/managerheader.php"; ?>

<?php 
if(isset($_REQUEST["logout"])) {
    $logout = $_REQUEST["logout"];
    
    if($logout == "1") {
        session_unset();
        session_destroy();

        header("Location: index.php");
    }
}
?>

    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/chart.esm.js" ></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.1.0/helpers.esm.js" ></script>
    </head>
                <div class="col-10">
                    <div class="row ml-1 shadow py-5">
                        <div class="row w-100 d-flex flex-row justify-content-around">
                            <div class="col-3">
                                <a href="#" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-dollar d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Revenue This Month</span>
                                    <span class="d-block" id="revenue" style="font-size: 2em;"></span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="customers.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-user d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Customers</span>
                                    <span class="d-block" id="customers" style="font-size: 2em;"></span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="rooms.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Rooms</span>
                                    <span class="d-block" id="rooms" style="font-size: 2em;"></span>
                                </a>
                            </div>
                        </div>

                        <div class="row w-100 d-flex flex-row justify-content-around mt-5">
                            <div class="col-3">
                                <a href="expenses.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-dollar d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Expense This Month</span>
                                    <span class="d-block" id="expense" style="font-size: 2em;"></span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="reviews.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-star d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Reviews</span>
                                    <span class="d-block" id="reviews" style="font-size: 2em;"></span>
                                </a>
                            </div>
                        </div>

                        <div class="row w-100 d-flex flex-row justify-content-center align-items-center mt-5">
                            <canvas id="canvas" class="ml-5"></canvas>
                        </div>

                    </div>
                </div>
            </div>

        <script src="js/chart.js"></script>
        <script src="js/dashboard_status.js"></script>

<?php require "../footers/managerfooter.php"?>