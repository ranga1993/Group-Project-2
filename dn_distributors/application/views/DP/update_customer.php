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
            <th>Contact Number</th>
            <th>Company Contact Number</th>
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
            <td><button type="button" class="btn btn-success" onclick="edit_customer(<?php echo $row->cus_id; ?>)">Update</button></td>
            <!--                <td>--><?php //echo anchor("Admin/view_each_customer/{$row-> customer_id}",'View',['class'=>'btn btn-info']);?><!--</td>-->
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
</div>

<div class="container modal fade" style="padding-top: 20px" id="updateCustomerModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" id="form">
                    <input type="hidden" value="" name="cus_id">
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
                    <div class="row" style="padding-top: 8px">
                        <button class="btn btn-success" type="button" id="btnsave" onclick="save()">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<script type="text/javascript">
    var save_method;
    function edit_customer(cus_id){
        save_method = 'update';
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/view_each_customer/" + cus_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="cus_id"]').val(data.cus_id);
                $('[name="cus_name"]').val(data.cus_name);
                $('[name="cus_company_name"]').val(data.cus_company_name);
                $('[name="cus_company_address"]').val(data.cus_company_address);
                $('[name="cus_nic"]').val(data.cus_nic);
                $('[name="cus_email"]').val(data.cus_email);
                $('[name="cus_phone"]').val(data.cus_phone);
                $('[name="cus_company_phone"]').val(data.cus_company_phone);

                $('#updateCustomerModal').modal('show');
            }
        })
    }

    function save(){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/update_customer_details",
            type: "POST",
            data: $('#form'). serialize(),
            dataType: "JSON",
            success: function(data){
                $('#updateCustomerModal').modal('hide');
                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown){
                alert('Error Updating Data');
            }
        });
    }


</script>


</body>
</html>
