<div class="container modal fade" style="padding-top: 20px" id="regModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('User_authentication/user_registration'); ?>
            <div class="modal-body">
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="name" style="color: grey">Your Name</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="name" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="company_name" style="color: grey">Company Name</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="company_name" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="address" style="color: grey">Address</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="address" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="nic" style="color: grey">NIC</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="nic" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="email" style="color: grey">Email</label>
                    </div>
                    <div class="col-md-7">
                        <input type="email" class="form-control" name="email" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="contact_number" style="color: grey">Contact Number</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="contact_number" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="password" style="color: grey">Password</label>
                    </div>
                    <div class="col-md-7">
                        <input type="password" class="form-control" name="password" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="confirm_password" style="color: grey">Confirm Password</label>
                    </div>
                    <div class="col-md-7">
                        <input type="password" class="form-control" name="confirm_password" style="width: 400px" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="w3-button btn-primary" style="border-radius: 8px">Submit</button>
                <button type="reset" class="w3-button btn-info" style="border-radius: 8px">Reset</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

