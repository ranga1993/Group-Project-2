<?php require_once 'header.php'; ?>
<?php require_once 'top2.php'; ?>
<?php require_once 'dp_side_bar.php' ?>
<div class="container col-md-10"><br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Customer Name</th>
            <th>Company Name</th>
            <th>Company Address</th>
            <th>NIC</th>
            <th>Email</th>
            <th>Mobile Number</th>
            <th>Company Number</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($h->result() as $row)
        {
            ?><tr>
            <td><?php echo $row->cus_name; ?></td>
            <td><?php echo $row->cus_company_name; ?></td>
            <td><?php echo $row->cus_company_address; ?></td>
            <td><?php echo $row->cus_nic; ?></td>
            <td><?php echo $row->cus_email; ?></td>
            <td><?php echo $row->cus_phone; ?></td>
            <td><?php echo $row->cus_company_phone; ?></td>
            <?php echo ' <td><button type="button" name="make_order" class="btn btn-info make_order" data-cus_nic="'.$row->cus_nic.'" data-cus_company_address="'.$row->cus_company_address.'" >Make Order</button></td>'; ?>
            <td><button type="button" class="btn btn-info" onclick="view_each_customer(<?php echo $row->cus_id; ?>)">View</button></td>
            <!--                <td>--><?php //echo anchor("Admin/view_each_customer/{$row-> customer_id}",'View',['class'=>'btn btn-info']);?><!--</td>-->
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>

<div class="container modal fade" style="padding-top: 20px" id="viewCustomerModal">
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
                        <label for="cus_company_name" style="color: grey">Company Name</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_company_name" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_company_address" style="color: grey">Company Address</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_company_address" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_nic" style="color: grey">NIC</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_nic" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_email" style="color: grey">Email</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_email" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_phone" style="color: grey">Contact Number</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_phone" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="cus_company_phone" style="color: grey">Company Contact Number</label>
                    </div>
                    <div class="col-md-7">
                        <input name="cus_company_phone" class="form-control" type="text">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</div>

<script type="text/javascript">
    var save_method;
    function view_each_customer(cus_id){
        save_method = 'view';
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/view_each_customer/" + cus_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="cus_name"]').val(data.cus_name);
                $('[name="cus_company_name"]').val(data.cus_company_name);
                $('[name="cus_company_address"]').val(data.cus_company_address);
                $('[name="cus_nic"]').val(data.cus_nic);
                $('[name="cus_email"]').val(data.cus_email);
                $('[name="cus_phone"]').val(data.cus_phone);
                $('[name="cus_company_phone"]').val(data.cus_company_phone);

                $('#viewCustomerModal').modal('show');
            }
        })
    }

    $(document).ready(function() {
        $('.make_order').click(function () {
            var cus_nic = $(this).data("cus_nic");
            var cus_company_address = $(this).data("cus_company_address");

            if (confirm("Do you want make a order.?")) {
                $.ajax({
                    url: "http://localhost/dn_distributors/index.php/Delivery_person/MakeOrderDirect",
                    method: "POST",
                    data: {cus_company_address: cus_company_address, cus_nic: cus_nic},

                    success: function (data) {
                        //alert ("Product Added into Cart ");
                        //$('#cart_details').html(data);
                        //$('#'+product_id).val('');
                       }
                });
            }
            else {
                return false;
            }
        });
    });
</script>
