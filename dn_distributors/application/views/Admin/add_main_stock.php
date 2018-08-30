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
        <?php echo form_open('Admin/insert_main_stock'); ?>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="date" style="color: grey">Date</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="date" value="<?php echo date('m/d/Y'); ?>" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="product_name" style="color: grey">Product Name</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="product_name" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="quantity" style="color: grey">Adding Quantity</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="quantity" required>
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
