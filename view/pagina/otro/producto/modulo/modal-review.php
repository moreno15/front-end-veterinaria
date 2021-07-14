<!-- Leave a Review-->
<form class="modal fade" method="post" id="leaveReview" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Escribe tu Reseña</h4>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-name">Your Name</label>
              <input class="form-control" type="text" id="review-name" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-email">Your Email</label>
              <input class="form-control" type="email" id="review-email" required>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-subject">Subject</label>
              <input class="form-control" type="text" id="review-subject" required>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="form-group">
              <label for="review-rating">Rating</label>
              <select class="form-control" id="review-rating">
                <option>5 Stars</option>
                <option>4 Stars</option>
                <option>3 Stars</option>
                <option>2 Stars</option>
                <option>1 Star</option>
              </select>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="review-message">Review</label>
          <textarea class="form-control" id="review-message" rows="8" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" type="submit">Submit Review</button>
      </div>
    </div>
  </div>
</form>
