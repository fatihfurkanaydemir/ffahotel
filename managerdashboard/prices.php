<?php require "../headers/managerheader.php"; ?>

<?php 
    include "../dbconnect.php";
?>

                <div class="col-10">
                    <div class="row ml-1 shadow">

                        <div class="row w-100 mx-2 mt-4">
                        <form id="roompriceform" class="w-100">
                            <div class="form-row">
                                <div class="form-group col-4">
                                    <select class="custom-control custom-select shadow" id="roomTypeSelect" name="roomtype" required>
                                        <option value="vip">VIP Room</option>
                                        <option value="family" selected>Family Room</option>
                                        <option value="double">Double Room</option>
                                        <option value="single">Single Room</option>
                                    </select>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                                <div class="form-group col-4">
                                    <input type="number" name="price" id="price" placeholder="Enter price" class="form-control" min="1" required>
                                    <div class="valid-feedback">Valid.</div>
                                    <div class="invalid-feedback">Please fill out this field.</div>
                                </div>
                              <div class="form-group col-4">
                                  <button type="button" onClick="addRoomtype()" class="btn btn-primary w-100">Add/Update</button>
                              </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                          <thead class="thead-light">
                            <tr>
                              <th scope="col">Room Type</th>
                              <th scope="col">Price</th>
                            </tr>
                          </thead>
                              <tbody id="tablecontent">
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <script src="js/roomprice_operations.js"></script>

<?php require "../footers/managerfooter.php"?>