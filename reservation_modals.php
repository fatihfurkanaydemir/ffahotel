<div class="modal fade" id="extendReservationModal" tabindex="-1" role="dialog"
    aria-labelledby="extendReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="extendReservationModalLabel">Extend
                    Reservation</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="form-group">
                    <label for="newCheckOutDate">Select new checkin date</label>
                    <input type="date" class="form-control" name="newcheckindate" id="newcheckindate">
                </div>
                <div class="form-group">
                    <label for="newCheckOutDate">Select new checkout date</label>
                    <input type="date" class="form-control" name="newcheckoutdate" id="newcheckoutdate">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="cancelReservationModal" tabindex="-1" role="dialog"
    aria-labelledby="cancelReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelReservationModalLabel">Cancel
                    Reservation</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to cancel this reservation ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" id="btn-cancelReservation" class="btn btn-primary" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteReviewModal" tabindex="-1" role="dialog"
    aria-labelledby="deleteReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteReviewModalLabel">Delete Review</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete your review ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-deleteReview" data-dismiss="modal">Yes</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editReviewModal" tabindex="-1" role="dialog"
    aria-labelledby="editReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editReviewModalLabel">Edit Review</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                <fieldset class="starability-basic" id="editreview-commentrate">
                    <input type="radio" id="editrate1" name="rating" value="1">
                    <label for="editrate1" title="Terrible">1 star</label>

                    <input type="radio" id="editrate2" name="rating" value="2">
                    <label for="editrate2" title="Not good">2 stars</label>

                    <input type="radio" id="editrate3" name="rating" value="3">
                    <label for="editrate3" title="Average">3 stars</label>

                    <input type="radio" id="editrate4" name="rating" value="4">
                    <label for="editrate4" title="Very good">4 stars</label>

                    <input type="radio" id="editrate5" name="rating" value="5">
                    <label for="editrate5" title="Amazing">5 stars</label>
                </fieldset>
            </form>
            <textarea class="form-control" rows="10" id="editreview-commenttext">
            </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btn-editReview" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="makeReviewModal" tabindex="-1" role="dialog"
    aria-labelledby="makeReviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="makeReviewModalLabel">Make Review</h5>
                <button type="button" class="close" data-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form>
                <fieldset class="starability-basic" id="makereview-commentrate">
                    <input type="radio" id="makerate1" name="rating" value="1">
                    <label for="makerate1" title="Terrible">1 star</label> 

                    <input type="radio" id="makerate2" name="rating" value="2">
                    <label for="makerate2" title="Not good">2 stars</label>   

                    <input type="radio" id="makerate3" name="rating" value="3" checked>
                    <label for="makerate3" title="Average">3 stars</label> 

                    <input type="radio" id="makerate4" name="rating" value="4">
                    <label for="makerate4" title="Very good">4 stars</label>  

                    <input type="radio" id="makerate5" name="rating" value="5">
                    <label for="makerate5" title="Amazing">5 stars</label>
                </fieldset>
            </form>
            <textarea class="form-control" rows="10" id="makereview-commenttext">
            </textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-dismiss="modal">Close</button>
                <button type="button" id="btn-makeReview" class="btn btn-primary" data-dismiss="modal">Save</button>
            </div>
        </div>
    </div>
</div>