<?php require_once 'header.php'; ?>
<?php require_once 'top_3.php'; ?>
<?php require_once 'registration.php'; ?>
<?php require_once 'login.php'; ?>
<div class="col-md-12">
    <div class="table-responsive" style="padding-top: 10px">
        <?php
        foreach ($product as $row){
            echo '
                        <div class="col-md-3" style="
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

</body>
</html>
