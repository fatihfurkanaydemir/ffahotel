<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">
                        <div class="row w-100 p-3">
                            <div class="col-4">
                                <button class="btn btn-secondary w-100 py-4">
                                    <i class="fa fa-line-chart d-inline" style="font-size: 24px;"></i>
                                    <span style="font-size: 1.2em;">Total Reports</span>
                                    <span class="d-block" style="font-size: 2em;"> 15 </span>
                                </button>
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
                                        <button type="button" class="btn btn-primary">Yes</button>
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
                                        <form action="#" id="getreportform">
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
                                            <input type="submit" class="btn btn-primary w-100" value="Get Report">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary">Ok</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Get Report Modal -->

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
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Revenue</th>
                                    <th scope="col">Expense</th>
                                    <th scope="col">Total Customers</th>
                                    <th scope="col">Delete</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>1</td>
                                    <td>01.03.2021</td>
                                    <td>01.04.2021</td>
                                    <td>40000</td>
                                    <td>11000</td>
                                    <td>250</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#deleteReportModal">
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