<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php }?>
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
        <?php echo form_open('Admin/add_product_details'); ?>
<!--        <div class="row" style="padding-top: 8px">-->
<!--            <div class="col-md-2">-->
<!--                <label for="product_code" style="color: grey">Product Code</label>-->
<!--            </div>-->
<!--            <div class="col-md-7">-->
<!--                <input type="text" class="form-control" name="product_code" required>-->
<!--            </div>-->
<!--        </div>-->
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
                <label for="product_type" style="color: grey">Product Type</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="product_type" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="product_description" style="color: grey">Product Description</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="product_description" required>
            </div>
        </div>
        <div class="row file-field" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="product_image" style="color: grey">Product Image</label>
            </div>
            <div class="col-md-7" style="padding-left:17px; height: 100px">
                <input type="file" name="product_image" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="product_price" style="color: grey">Unit Price</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="product_price" required>
            </div>
        </div>
        <div class="row" style="padding-top: 8px">
            <div class="col-md-2">
                <label for="minimum_quantity" style="color: grey">Minimum Quantity</label>
            </div>
            <div class="col-md-7">
                <input type="text" class="form-control" name="minimum_quantity" required>
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
