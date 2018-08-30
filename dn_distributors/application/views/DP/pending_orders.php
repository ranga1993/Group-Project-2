<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php }?>
<?php require_once 'dp_side_bar.php' ?>
<div class="container col-md-10"><br>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by customer name" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>
<!--    <table class="table table-striped">-->
<!--        <thead>-->
<!--        <tr>-->
<!--            <th>Customer Name</th>-->
<!--            <th>Delivery Address</th>-->
<!--            <th>Ordered Date</th>-->
<!--            <th>Product Name</th>-->
<!--            <th>Quantity</th>-->
<!--            <th>Total Price</th>-->
<!--            <th></th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--        --><?php
//        foreach ($h->result() as $row)
//        {
//            ?><!--<tr>-->
<!--            <td>--><?php //echo $row->cus_name; ?><!--</td>-->
<!--            <td>--><?php //echo $row->delivery_address; ?><!--</td>-->
<!--            <td>--><?php //echo $row->ordered_date; ?><!--</td>-->
<!--            <td>--><?php //echo $row->product_name; ?><!--</td>-->
<!--            <td>--><?php //echo $row->quantity; ?><!--</td>-->
<!--            <td>--><?php //echo $row->total_price; ?><!--</td>-->
<!--            </tr>-->
<!--        --><?php //}
//        ?>
<!--        </tbody>-->
<!--    </table>-->
</div>

<div class="container modal fade" style="padding-top: 20px" id="viewPendingOrderModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_name" style="color: grey">Customer Name</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_name" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="delivery_address" style="color: grey">Delivery Address</label>
                    </div>
                    <div class="col-md-7">
                        <input name="delivery_address" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="ordered_date" style="color: grey">Ordered Date</label>
                    </div>
                    <div class="col-md-7">
                        <input name="ordered_date" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="product_name" style="color: grey">Product Name</label>
                    </div>
                    <div class="col-md-7">
                        <input name="product_name" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="quantity" style="color: grey">Quantity</label>
                    </div>
                    <div class="col-md-7">
                        <input name="quantity" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="total_price" style="color: grey">Total Price</label>
                    </div>
                    <div class="col-md-7">
                        <input name="total_price" class="form-control" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<script type="text/javascript">
    load_data();
    var save_method;
    function view_each_order(order_id){
        save_method = 'view';
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/view_each_pending_order/" + order_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="cus_name"]').val(data.cus_name);
                $('[name="delivery_address"]').val(data.delivery_address);
                $('[name="ordered_date"]').val(data.ordered_date);
                $('[name="product_name"]').val(data.product_name);
                $('[name="quantity"]').val(data.quantity);
                $('[name="total_price"]').val(data.total_price);

                $('#viewPendingOrderModal').modal('show');
            }
        })
    }

    function complete_order(order_id){
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/complete_order",
            type: "POST",
            data: {order_id:order_id},
            success: function(){
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error Updating Data');
            }
        })
    }

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/search_view_pending_orders",
            type: "POST",
            data: {query:query},
            success: function(data){
                $('#result').html(data);
            }
        });
    }

    $('#search_text').keyup(function(){
        var search = $(this).val();
        if(search != ''){
            load_data(search);
        }
        else {
            load_data();
        }
    });

</script>

</body>
</html>
