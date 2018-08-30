<?php require_once ('cus_header.php') ?>
<?php require_once ('top.php') ?>
<?php require_once ('customer_side_bar.php') ?>

<div class="container" >

    <h2>Please Give Your Feedback By Filling This Form</h2>

    <div class="container">
        <?php if($this->session->flashdata('massage')){
            $message = $this->session->flashdata('massage');?>
            <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?></div>
        <?php } ?>
    </div>

    <div class="container" >
        <?php echo form_open('Customer/Feedback');?>

        <h3>Order Details</h3>

        <div class="form-group">
            <label for="order_no">Order Number</label>
            <input type="text" class="form-control" id="order_no" name="order_no" value="<?php foreach ($order as $res) {?><?php echo $res->order_number; ?><?php }?>" >
        </div>
        <div class="form-group">
            <label for="order_date">Order Date</label>
            <input type="text" class="form-control" id="order_date" name="order_date" value="<?php foreach ($order as $res) {?><?php echo $res->order_date; ?><?php }?>">
        </div>
        <div class="form-group">
            <label for="order_status">Order Status</label>
            <input type="text" class="form-control" id="order_status" name="order_status" value="<?php foreach ($order as $res) {?><?php if ($res->order_status == 2){echo 'Delivered';} ?><?php }?>">
        </div>

    </div>
    <?php echo validation_errors(); ?>

    <div class="container">

        <div class="the-massage"> </div>

        <h3>Your Feedback</h3>


        <div class="container">
            <div class="form-group">
                <label for="cus_feedback">Give Your Feedback Here</label>
                <textarea type="text" class="form-control" rows="3" id="cus_feedback" name="cus_feedback" placeholder="Please Write Youre Feedback Here About Our Delevery Process" required></textarea>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-success">Submit Your Feedback</button>
                </div>
            </div>
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

</div>




