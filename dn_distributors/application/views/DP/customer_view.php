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
    load_data();
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

//    $(document).ready(function() {
//        $('.make_order').click(function () {
//            var cus_nic = $(this).data("cus_nic");
//            var cus_company_address = $(this).data("cus_company_address");
//
//            if (confirm("Do you want make a order.?")) {
//                window.location.href = "<?php //echo base_url('index.php/Delivery_person/MakeOrderDirect'); ?>//?cus_nic="+cus_nic+"&cus_company_address="+cus_company_address;
//            }
//            else {
//                return false;
//            }
//        });
//    });

    function make_order(cus_id){
//        alert($cus_id);

//        $.ajax({
//            url: "<?php //echo site_url(); ?>///Delivery_person/MakeOrderCustomerVice/" + cus_id,
//            type: "POST",
//            data: {'cus_id':cus_id}
//        });

        if (confirm("Do you want make a order.?")) {
            location.href = "<?php echo base_url('index.php/Delivery_person/MakeOrderCustomerVice'); ?>?cus_id="+cus_id;
        }
        else {
            return false;
        }
    }

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Delivery_person/search_view_customer",
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
