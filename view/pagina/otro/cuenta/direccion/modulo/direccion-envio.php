<div class="col-lg-8">
          <div class="padding-top-2x mt-2 hidden-lg-up"></div>
          <h5>Contact Address</h5>
          <hr class="padding-bottom-1x">
          <form class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-company">Company</label>
                <input class="form-control  form-control-square form-control-sm " type="text" id="account-company" value="Bets Company Ltd.">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group ">
                <label for="account-country">Country</label>
                <select class="form-control  form-control-square form-control-sm " id="account-country">
                  <option>Choose country</option>
                  <option>Australia</option>
                  <option>Canada</option>
                  <option>France</option>
                  <option>Germany</option>
                  <option>Switzerland</option>
                  <option selected="">United States</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-city">City</label>
                <select class="form-control  form-control-square form-control-sm " id="account-city">
                  <option>Choose city</option>
                  <option>Amsterdam</option>
                  <option>Berlin</option>
                  <option>Geneve</option>
                  <option selected="">New York</option>
                  <option>Paris</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-zip">ZIP Code</label>
                <input class="form-control  form-control-square form-control-sm " type="text" id="account-zip" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-address1">Address 1</label>
                <input class="form-control  form-control-square form-control-sm " type="text" id="account-address1" required="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="account-address2">Address 2</label>
                <input class="form-control  form-control-square form-control-sm " type="text" id="account-address2">
              </div>
            </div>
            <div class="col-12 padding-top-1x">
              <h5>Shipping Address</h5>
              <hr class="padding-bottom-1x">
              <div class="custom-control custom-checkbox d-block">
                <input class="custom-control-input  form-control-square form-control-sm " type="checkbox" id="same_address" checked="">
                <label class="custom-control-label " for="same_address">Same as Contact Address</label>
              </div>
              <hr class="margin-top-1x margin-bottom-1x">
              <div class="text-right">
                <button class="btn btn-primary margin-bottom-none  btn-sm" type="button" data-toast="" data-toast-position="topRight" data-toast-type="success" data-toast-icon="icon-check-circle" data-toast-title="Success!" data-toast-message="Your address updated successfuly.">Update Address</button>
              </div>
            </div>
          </form>
        </div>
