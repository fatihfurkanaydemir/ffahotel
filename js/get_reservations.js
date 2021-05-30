function getReservations() {
    var params = "";
    
    $.ajax({
        type: "post",
        url: "php/get_reservations.php",
        data: params,
        success: function(data, status) {            
            this.listReservations(JSON.parse(data));
        },
        error: function(xhr, desc, err) {
            console.log(desc);
            this.listReservations({});
        },
        listReservations: function(data) {        
            var reservations = data.reservations;
        
            var html = "";
            reservations.forEach((reservation) => {
                if(reservation.status == "active") {
                    html += `
                            <div class="card mt-4 shadow"> 
                                <div class="card-body"> 
                                    <div class="row"> 
                                        <div class="col-sm-4"> 
                                            <img src="img/vipRoom.jpg" alt="Vip Room" 
                                                class="reservation-card-img card-img mx-auto d-block"> 
                                        </div> \
                                        <div class="col-sm-4 pl-5 pl-sm-0"> 
                                            <span class="d-block font-weight-bold mt-4 mt-sm-0" 
                                                style="font-size: 1.2em;">Reservation Continues</span> 
                                            <span class="d-block mt-1">" +  + "</span> 
                                            <span class="d-block mt-1">${reservation.checkindate} - ${reservation.checkoutdate}</span> 
                                            <span class="d-block mt-1">Room: ${reservation.doornumber}</span> 
                                            <span class="d-block mt-1">${reservation.totalprice} USD</span> 
                                        </div> 
                                        <div class="m-auto"> 
                                            <button class="btn btn-primary mt-4 mt-sm-0 mb-4" data-toggle="modal" 
                                                data-target="#extendReservationModal">Extend</button> 
                                            <button class="btn btn-primary mt-4 mt-sm-0 mb-4" data-toggle="modal" 
                                                data-target="#cancelReservationModal">Cancel</button> 
                                        </div> 
                                    </div> 
                                </div>
                            </div>`;
                }        
                else if(reservation.status == "ended") {
                    
                }
                else if(reservation.status == "canceled") {

                }
                
            });

            $("#reservations").html(html);
        }
    });
}

 