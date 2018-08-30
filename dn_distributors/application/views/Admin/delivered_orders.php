<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php }?>
<?php require_once 'admin_side_bar.php' ?>
<div class="container col-md-10"><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Order Date</th>
            <th>Customer Name</th>
            <th>Delivery Address</th>
            <th>Contact Number</th>
            <th>Product Code</th>
            <th>Product Name</th>
            <th>Amount</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($h->result() as $row)
        {
            ?><tr>
            <td><?php echo $row->order_date; ?></td>
            <td><?php echo $row->customer_name; ?></td>
            <td><?php echo $row->delivery_address; ?></td>
            <td><?php echo $row->contact_number; ?></td>
            <td><?php echo $row->product_code; ?></td>
            <td><?php echo $row->product_name; ?></td>
            <td><?php echo $row->amount; ?></td>
            <td><button type="button" class="btn btn-info" onclick="view_delivered_orders(<?php echo $row->order_number; ?>)">View</button></td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>

<div class="container modal fade" style="padding-top: 20px" id="viewDeliveredOrdersModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="order_date" style="color: grey">Order Date</label>
                    </div>
                    <div class="col-md-7">
                        <input name="order_date" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="customer_name" style="color: grey">Customer Name</label>
                    </div>
                    <div class="col-md-7">
                        <input name="customer_name" class="form-control" type="text">
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
                        <label for="contact_number" style="color: grey">Contact Number</label>
                    </div>
                    <div class="col-md-7">
                        <input name="contact_number" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="product_code" style="color: grey">Product Code</label>
                    </div>
                    <div class="col-md-7">
                        <input name="product_code" class="form-control" type="text">
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
                        <label for="amount" style="color: grey">Amount</label>
                    </div>
                    <div class="col-md-7">
                        <input name="amount" class="form-control" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    var save_method;
    function view_delivered_orders(order_number){
        save_method = 'view';
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/view_each_delivered_order/" + order_number,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="order_date"]').val(data.order_date);
                $('[name="customer_name"]').val(data.customer_name);
                $('[name="delivery_address"]').val(data.delivery_address);
                $('[name="contact_number"]').val(data.contact_number);
                $('[name="product_code"]').val(data.product_code);
                $('[name="product_name"]').val(data.product_name);
                $('[name="amount"]').val(data.amount);

                $('#viewDeliveredOrdersModal').modal('show');
            }
        })
    }
</script>


</body>
</html>
