<?php require "../headers/managerheader.php"; ?>

        <div class="col-10">
            <div class="row ml-1 shadow" style="max-height: 230px; overflow: hidden;">
                <form id="addexpenseform" class="needs-validation m-3 w-100" novalidate>
                    <div class="form-row">
                        <div class="form-group col-6">
                            <label for="date" class="text-primary">Date:</label>
                            <input type="date" name="date" id="date" value="<?php echo date("Y-m-d") ?>" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                        <div class="form-group col-6">
                            <label for="amount" class="text-primary">Amount:</label>
                            <input type="number" name="amount" id="amount" min="0" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-8">
                            <label for="description" class="text-primary">Description:</label>
                            <input type="text" name="description" id="description" class="form-control" required>
                            <div class="valid-feedback">Valid.</div>
                            <div class="invalid-feedback">Please fill out this field.</div>
                        </div>
                    <div class="form-group col-4">
                        <label for="date" class="text-primary">&nbsp;</label>
                        <button type="button" class="btn btn-primary w-100" onClick="addExpense()">Add</button>
                    </div>
                    </div>
                </form>
            </div>
            <div class="row ml-1 mt-3 shadow" style="max-height: 500px; overflow: auto;">
            <table class="table table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Description</th>
                    <th scope="col">Delete</th>
                  </tr>
                </thead>
                <tbody id="tablecontent">
                    
                </tbody>
            </table>
            </div>
        </div>

        <!-- Delete Expense Modal -->
        <div class="modal fade" id="deleteExpenseModal" tabindex="-1" role="dialog" aria-labelledby="deleteExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteExpenseModalLabel">Delete Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete the expense ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onClick="deleteExpense()">Yes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Expense Modal -->

        <script src="js/expense_operations.js"></script>

<?php require "../footers/managerfooter.php"?>