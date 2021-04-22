<?php require "../headers/managerheader.php"; ?>

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
                                    <span style="font-size: 1.2em;">Revenue</span>
                                    <span class="d-block" style="font-size: 2em;"> 4000 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="customers.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-user d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Customers</span>
                                    <span class="d-block" style="font-size: 2em;"> 400 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="rooms.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-home d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Rooms</span>
                                    <span class="d-block" style="font-size: 2em;"> 400 </span>
                                </a>
                            </div>
                        </div>

                        <div class="row w-100 d-flex flex-row justify-content-around mt-5">
                            <div class="col-3">
                                <a href="#" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-dollar d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Expense</span>
                                    <span class="d-block" style="font-size: 2em;"> 1000 </span>
                                </a>
                            </div>
                            <div class="col-3">
                                <a href="reviews.php" class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-star d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Reviews</span>
                                    <span class="d-block" style="font-size: 2em;"> 4.7/5 </span>
                                </a>
                            </div>
                        </div>

                        <div class="row w-100 d-flex flex-row justify-content-center align-items-center mt-5">
                            <canvas id="canvas" class="ml-5"></canvas>
                        </div>

                    </div>
                </div>
            </div>

        <script src="chart.js"></script>

<?php require "../footers/managerfooter.php"?>