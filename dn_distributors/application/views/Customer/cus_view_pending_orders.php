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
<div class="container">

        <h1 style="color: #0c5460">Pending Order Details</h1>
        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order Number</th>
                        <th>Delivery Address </th>
                        <th>Ordered Date </th>
                        <th>View Details</th>
                        <th>Cancel Order</th>
                    </tr>
                </thead>

                <tbody>
                <?php
//                print_r($pending_orders->result());
                $num_pending=$pending_orders->num_rows();

                if($num_pending>0){
                    $order_id=0;
                    foreach($pending_orders->result() as $rec){
                        if($order_id!=$rec->order_id){
                            $order_id= $rec->order_id;
                            $id=$rec->order_id;?>
                            <?php $order_price=0;
                            ?>
                            <tr>
                                <td> <?php echo $rec-> order_id ; ?> </td>
                                <td> <?php echo $rec-> delivery_address ; ?> </td>
                                <td> <?php echo $rec-> ordered_date ; ?> </td>
                                <td> <div class="form-group">
                                        <button type="button" class="form-control btn-info" data-toggle="modal" data-target="#myModal">view</button>

                                        <div id="myModal" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Order Details</h4>
                                                    </div>

                                                    <div class="modal-body">

                                                        <div class="table-responsive">
                                                            <table class="table table-striped">
                                                                <thead>
                                                                <tr>
                                                                    <th>Product ID</th>
                                                                    <th>Product Price </th>
                                                                    <th>Quantity </th>
                                                                    <th>Total Price</th>

                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                    <?php foreach($pending_orders->result() as $op){

                                                                        if($order_id==$op->order_id){
                                                                            //print_r($products);
                                                                        $order_price+=$op-> total_price ; ?>
                                                                        <tr>
                                                                            <td><?php echo $op-> product_id ; ?></td>
                                                                            <td><?php echo $op-> product_price ; ?></td>
                                                                            <td><?php echo $op-> quantity ; ?></td>
                                                                            <td><?php echo $op-> total_price ; ?></td>
                                                                        </tr>

                                                                    <?php }
                                                                        else{
                                                                            //$order_id['id2']=$op->order_id;
                                                                            //print_r($op->order_id);
                                                                            ?>
                                                                        <?php }}?>
                                                                    <tr>
                                                                        <td colspan="3" align="right"><?php echo "Total Price of this Order : Rs.".$order_price ; ?></td>
                                                                    </tr>
                                                                </tbody>
                                                                </table>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </td>
                                <?php echo '<td><button type="button" name="cancel_order" class="form-control btn-danger cancel_order" data-order_id="'.$rec->order_id.'">Cancel</button></td>' ?>
                                <br>
                            </tr>
                            <?php

                            }
                        else{

                        }
                    }
                }

                else{ ?>
                    <tr>
                        <td colspan="5" align="center"> No Pending Orders Yet... </td>
                    </tr>

                <?php }?>

                </tbody>

            </table>

        </div>

    <?php echo form_close(); ?>

</div>

<script>
    $(document).ready(function() {
        $('.cancel_order').click(function () {
            if(confirm("Are you sure you want to cancel this order")){
                var order_id = $(this).data("order_id");
                //alert(order_id);
                $.ajax({
                    url: "http://localhost/dn_distributors/index.php/Customer/CancelOrder",
                    method: "POST",
                    data: {order_id: order_id},
                    success: function (data) {
                        alert ("Order Removed");
                        window.location.href ='http://localhost/dn_distributors/index.php/Customer/LoadPendingOrder';

                    }

                });

            }
            else{
                return false;
            }


        });
    });

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

