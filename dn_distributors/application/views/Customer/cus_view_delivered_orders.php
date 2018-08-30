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
    <h1 style="color: #0c5460">Delivered Order Details</h1>
    <div class="table-responsive">

        <table class="table table-striped">
            <thead>
            <tr>
                <th>Order Number</th>
                <th>Ordered Date</th>
                <th>Delivered Date </th>
                <th>Delivered Address </th>
                <th>View Details </th>
                <th>Give Feedback</th>
            </tr>
            </thead>

            <tbody>
            <?php

            $num=$delivered_order->num_rows();
            if($num>0){
                //print_r($delivered_order->result());
                $order_id['id']=0;
                foreach($delivered_order->result() as $rec){
                    if($order_id['id']!=$rec->order_id){
                        $order_id['id'] = $rec->order_id;
                    ?>
                    <tr>
                        <td> <?php echo $rec-> order_id ; ?> </td>
                        <td> <?php echo $rec-> ordered_date ; ?> </td>
                        <td> <?php echo $rec-> delevered_date ; ?> </td>
                        <td> <?php echo $rec-> delivery_address ; ?> </td>
                        <td>
                            <div class="form-group">
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
                                                        <?php $order_id['price']=0 ?>
                                                        <?php foreach($delivered_order->result() as $op){
                                                            //print_r($op);
                                                            if($op->order_id==$rec->order_id){
                                                                //print_r($order_id['id']);
                                                                //$order_id['id2']=$op->order_id;
                                                                $order_id['price']+=$op-> total_price ; ?>
                                                                <tr>
                                                                    <td><?php echo $op-> product_id ; ?></td>
                                                                    <td><?php echo $op-> product_price ; ?></td>
                                                                    <td><?php echo $op-> quantity ; ?></td>
                                                                    <td><?php echo $op-> total_price ; ?></td>
                                                                </tr>

                                                            <?php }
                                                            else{
                                                                //$order_id['id2']=$op->order_id;
                                                            }
                                                            //print_r($order_id['price']);
                                                        }

                                                        ?>

                                                        <tr>
                                                            <td colspan="4" align="center"><?php echo "Total Price of this Order : Rs.".$order_id['price'] ; ?></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </td>
                        <td><button type="button" data-toggle="modal" data-target="#feedbackmodel" class="form-control btn-success" >Feedback</button></td>
                        <div id="feedbackmodel" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Give Feedback</h4>
                                    </div>
                                    <div class="modal-body">
                                        <label for="cus_feedback">Give Your Feedback Here</label>
                                        <textarea type="text" class="form-control" id="cus_feedback" name="cus_feedback" placeholder="Please Write Youre Feedback Here About Our Delivery Process" ></textarea>
                                        <?php echo '<button type="button" id="give_feedback" name="give_feedback"  class="btn btn-success give_feedback" data-order_id="'.$rec->order_id.'">Submit Your Feedback</button>' ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </tr>
                <?php
                    }
                    else{

                    }
                }
            }

            else{?>
                <tr>
                    <td colspan="6"> No Delivered Orders Yet.. </td>
                </tr>

            <?php } ?>
            </tbody>

        </table>

    </div>

</div>

<script>
    $(document).ready(function() {
        $('.give_feedback').click(function () {
                var feedback = $('#cus_feedback').val();
                var order_id = $(this).data("order_id");
                if(feedback!=null && order_id!=0){
                    $.ajax({
                        //url: "http://localhost/dn_distributors/index.php/Customer/Feedback",
                        method: "POST",
                        data: {order_id: order_id, cus_feedback: feedback},
                        success: function (data) {
                            alert ("Feedback Submitted");
                            //window.location.href ='http://localhost/dn_distributors/index.php/Customer/LoadPendingOrder';
                            $('#feedbackmodel').hide();
                            location.reload();
                            //$('#give_feedback').prop('disabled', true);
                        }
                    });
                }
                //alert(feedback);alert(order_id);

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
