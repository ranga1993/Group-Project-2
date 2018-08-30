<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php } ?>
<?php require_once 'admin_side_bar.php' ?>
<div class="col-md-10">
    <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="container" style="padding-top: 10px">
        <?php echo form_open('Admin/customer_registration'); ?>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_name" style="color: grey">Customer Name</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_name" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_company_name" style="color: grey">Company Name</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_company_name" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_company_address" style="color: grey">Company Address</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_company_address" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_nic" style="color: grey">NIC</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_nic" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_email" style="color: grey">Email</label>
            </div>
            <div class="col-md-7">
                <input type="email" class="form-control" name="cus_email" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_phone" style="color: grey">Contact Number</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_phone" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="cus_company_phone" style="color: grey">Company Contact Number</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="cus_company_phone" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="password" style="color: grey">Password</label>
            </div>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="confirm_password" style="color: grey">Confirm Password</label>
            </div>
            <div class="col-md-7">
                <input type="password" class="form-control" name="confirm_password" required>
            </div>
        </div>
        <br>
        <div class="row text-center" style="padding-top: 8px">
            <button type="submit" class="w3-button btn-primary" style="border-radius: 8px">Submit</button>
            <button type="reset" class="w3-button btn-info" style="border-radius: 8px">Reset</button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
</div>
<script type="text/javascript">
    setTimeout(function(){
        $('.alert').fadeOut();
    }, 3000);
</script>

</body>
</html>
