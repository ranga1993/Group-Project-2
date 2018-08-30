<?php /*require_once ('cus_header.php') */?><!--
<?php /*require_once ('top.php') */?>
--><?php /*require_once ('customer_side_bar.php') */?>
<?php require_once 'cus_header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php } else {?>
    <?php require_once 'top.php'; ?>
    <?php require_once 'login.php'; ?>
    <?php require_once 'registration.php'; ?>
<?php } ?>
<?php require_once 'customer_side_bar.php' ?>


<?php echo form_open('Customer/EditRegDetails');?>

<div class="container" >

    <?php if($this->session->flashdata('massage')){
            $massage = $this->session->flashdata('massage');?>
            <div class="<?php echo $massage['class'] ?>"><?php echo $massage['massage']; ?></div>
        <?php } ?>
    <div id="the-massage"> </div>

        <div class="container">
            <div class="col-md-10" style="padding-left: 120px">
                <h1 style="color: #0c5460">Your Details</h1>
            </div>
            <div class="col-md-10" style="padding-left: 120px">
                <div class="container" style="padding-top: 10px">

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_name" style="color: grey">Name</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_name" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_name; ?><?php }?>" required>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_nic" style="color: grey">NIC</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_nic" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_nic; ?><?php }?>" required readonly>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_phone" style="color: grey">Phone Number</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_phone" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_phone; ?><?php }?>" required>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_email" style="color: grey">Email</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_email" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_email; ?><?php }?>" required readonly>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_company_name" style="color: grey">Company Name</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_company_name" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_company_name; ?><?php }?>" required>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_company_address" style="color: grey">Company Address</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_company_address" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_company_address; ?><?php }?>" required>
                        </div>
                    </div>

                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-2">
                            <label for="cus_company_phone" style="color: grey">Company Phone</label>
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cus_company_phone" value="<?php foreach ($customer as $cus) {?><?php echo $cus->cus_company_phone; ?><?php }?>" required>
                        </div>
                    </div>

                    <br>
                    <div class="col-md-6">
                        <div class="row text-center" style="padding-top: 8px">
                            <button type="submit" class="btn btn-success" >Update Details</button>
                        </div>
                    </div>

                </div>
            </div>
            </div>--
        </div>
</div>

<?php echo form_close();?>
<script>
    type="application/javascript">
        /** After windod Load */
        $(window).bind("load", function() {
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove();
                });
            }, 4000);
        });
</script>
