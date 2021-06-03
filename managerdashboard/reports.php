<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-line-chart d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reports</span>
                                    <span class="d-block" id="reportcount" style="font-size: 2em;"> 15 </span>
                                </button>
                            </div>
                        </div>
                        <div class="row w-100 mx-2 mt-4">
                            <button type="button" class="btn btn-primary float-right mb-1" style="width: 30%;" data-toggle="modal" data-target="#getReportModal">
                                <i class="fa fa-plus"></i>
                                Get a new report
                            </button>
                        </div>
                        <div class="row w-100 mx-2 mt-4" style="max-height: 500px; overflow: auto;">
                            <table class="table table-hover">
                                <thead class="thead-light">
                                  <tr>
                                    <th scope="col">Report Id</th>
                                    <th scope="col">Report Date</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Revenue</th>
                                    <th scope="col">Expense</th>
                                    <th scope="col">Total Customers</th>
                                    <th scope="col">Download/Delete</th>
                                  </tr>
                                </thead>
                                <tbody id="tablecontent"> 
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Delete Report Modal -->
            <div class="modal fade" id="deleteReportModal" tabindex="-1" role="dialog" aria-labelledby="deleteReportModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteReportModalLabel">Delete Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the report ?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            <button type="button" class="btn btn-primary" onClick="deleteReport()" data-dismiss="modal">Yes</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Delete Report Modal -->
            <!-- Get Report Modal -->
            <div class="modal fade" id="getReportModal" tabindex="-1" role="dialog" aria-labelledby="getReportModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="getReportModalLabel">Get Report</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="getreportform" class="needs-validation" novalidate>
                                <div class="form-row">
                                    <div class="form-group col-6">
                                        <label for="startdate" class="text-primary">Start Date: </label>
                                        <input type="date" name="startdate" id="startdate" class="form-control" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="enddate" class="text-primary">End Date: </label>
                                        <input type="date" name="enddate" id="enddate" class="form-control" required>
                                        <div class="valid-feedback">Valid.</div>
                                        <div class="invalid-feedback">Please fill out this field.</div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="btn-getreport" onClick="getReport()">Get Report</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Get Report Modal -->

            <canvas id="customerChart" width="1200" height="600" style="display: hidden;"></canvas>
            <canvas id="revenueExpenseChart" width="1200" height="600" style="display: hidden;"></canvas>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js" type="module"></script>
            <script src="js/report_operations.js"></script>
            <script>
            </script>
            
<?php require "../footers/managerfooter.php"?>