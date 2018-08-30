<?php //require_once ('cus_header.php') ?>
<?php //require_once ('top.php') ?>
<?php //require_once ('customer_side_bar.php') ?>
<?php require_once 'cus_header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php } else {?>
    <?php require_once 'top.php'; ?>
    <?php require_once 'login.php'; ?>
    <?php require_once 'registration.php'; ?>
<?php } ?>
<?php require_once 'customer_side_bar.php' ?>

        <?php if($this->session->flashdata('massage')){
            $massage = $this->session->flashdata('massage');?>
            <div class="<?php echo $massage['class'] ?>"><?php echo $massage['massage']; ?></div>
        <?php } ?>

<div class="col-lg-10 col-md-12 ">
    <div class="table-responsive">
        <h3 align="center" >Our Product Details</h3>

        <?php
        foreach ($product as $row){
            echo '
                        <div class="col-md-3 " style="
                                                     padding:20px;
                                                     background-color:#f1f1f1;
                                                     border:1px solid #ccc;
                                                     margin-bottom:16px;
                                                     height:420px;" align="center">
                                <h4 style="color:#3c3f80; font-family:verdana;">'.$row->product_type.' </h4>
                                <img src="'.base_url().'assets/images/'.$row->product_image.'" class="img-thumbnail" style="width:300px;height:250px;" /><br />
                                <h4> '.$row->product_name.' </h4>
                                <h4>Rs : '.$row->product_price.' </h4>
                                <h5>'.$row->product_description.' </h5>
                        </div>
                    ';
        }
        ?>
    </div>
</div>


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