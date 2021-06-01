<?php require "../headers/managerheader.php"; ?>

                <div class="col-10">
                    <div class="row ml-1 shadow">  
                        <div class="card w-100">
                            <div class="card-title text-center">
                                <span style="font-size: 1.5em;">Add Room</span>
                            </div>
                            <div class="card-body">
                                <form id="addroomform" action="#" method="POST" class="needs-validation" novalidate>
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="roomtype" class="text-primary">Select the room type: </label>
                                            <select id="roomtype" class="custom-select" name="roomtype">
                                                <option value="vip">VIP Room</option>
                                                <option value="family">Family Room</option>
                                                <option value="double">Double Room</option>
                                                <option value="single">Single Room</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="floor" class="text-primary">Select the floor: </label>
                                            <select id="floor" class="custom-select" name="floor">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-row">
                                        <div class="form-group col-6">
                                            <label for="doornumber" class="text-primary">Door number: </label>
                                            <input type="number" name="doornumber" id="doornumber" placeholder="Enter door number" class="form-control" min="0" maxlength="3" required>
                                            <div class="valid-feedback">Valid.</div>
                                            <div class="invalid-feedback">Please fill out this field.</div>
                                        </div>
                                    </div>                                
                                    <button type="button" onClick="addRoom()" class="btn btn-primary mt-3 shadow" style="width: 100%;">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <script src="js/add_room.js"></script>


<?php require "../footers/managerfooter.php"; ?>