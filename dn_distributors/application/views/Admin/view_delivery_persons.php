<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php } ?>
<?php require_once 'admin_side_bar.php' ?>
<div class="container col-md-10"><br>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by delivery person name" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>

</div>

<div class="container modal fade" style="padding-top: 20px" id="viewDPModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="dp_name" style="color: grey">Delivery Person Name</label>
                    </div>
                    <div class="col-md-7">
                        <input name="dp_name" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="dp_address" style="color: grey">Address</label>
                    </div>
                    <div class="col-md-7">
                        <input name="dp_address" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="dp_nic" style="color: grey">NIC</label>
                    </div>
                    <div class="col-md-7">
                        <input name="dp_nic" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="dp_email" style="color: grey">Email</label>
                    </div>
                    <div class="col-md-7">
                        <input name="dp_email" class="form-control" type="text">
                    </div>
                </div>
                <div class="row" style="padding-top: 8px">
                    <div class="col-md-3">
                        <label for="dp_phone" style="color: grey">Contact Number</label>
                    </div>
                    <div class="col-md-7">
                        <input name="dp_phone" class="form-control" type="text">
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
    function view_each_dp(dp_id){
        save_method = 'view';
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/view_each_dp/" + dp_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="dp_name"]').val(data.dp_name);
                $('[name="dp_address"]').val(data.dp_address);
                $('[name="dp_nic"]').val(data.dp_nic);
                $('[name="dp_email"]').val(data.dp_email);
                $('[name="dp_phone"]').val(data.dp_phone);

                $('#viewDPModal').modal('show');
            }
        })
    }

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/search_view_dp",
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

</script


</body>
</html>
