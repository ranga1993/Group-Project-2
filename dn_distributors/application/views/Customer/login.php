<div class="container modal fade" style="padding-top: 20px; width: 50%" id="loginModal">
    <div class="w3-card-2 text-center modal-dialog">
<!--        <div class="card-header black white-text" style="background-color: black; color: white">-->
<!--            <h2>login form</h2>-->
<!---->
<!--        </div>-->
        <div class="modal-content">
            <div class="modal-header">
<!--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">-->
<!--                    <span aria-hidden="true">&times;</span>-->
<!--                </button>-->
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php echo form_open('User_authentication/user_login');?>
            <div class="modal-body">
                <div class="row" style="padding-top:8px">
                    <!-- Default input email -->
                    <div class="col-md-3"">
                        <label for="email" style="color: grey">Your email</label>
                    </div>
                    <div class="col-md-7"">
                        <input type="email" class="form-control" name="email" style="width: 400px" required>
                    </div>
                </div>
                <div class="row" style="padding-top:8px">
                    <div class="col-md-3">
                        <label for="password" style="color: grey">Your password</label>
                    </div>
                    <div class="col-md-7">
                        <input type="password" class="form-control" name="password" style="width: 400px" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="w3-button btn-primary" style="border-radius: 8px">Login</button>
<!--                <button class="w3-button btn-outline-elegant waves-effect btn-sm" type="submit">Login</button>-->
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

