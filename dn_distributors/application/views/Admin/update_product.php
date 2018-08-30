<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php } ?>
<?php require_once 'admin_side_bar.php' ?>
<div class="container col-md-10"><br>
    <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success');

            ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by product name" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>
</div>

<div class="container modal fade" style="padding-top: 20px" id="updateProductModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" id="form">
                    <input type="hidden" value="" name="product_id">
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
                            <label for="product_type" style="color: grey">Product Type</label>
                        </div>
                        <div class="col-md-7">
                            <input name="product_type" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-3">
                            <label for="product_description" style="color: grey">Product Description</label>
                        </div>
                        <div class="col-md-7">
                            <input name="product_description" class="form-control" type="text">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-3">
                            <label for="product_image" style="color: grey">Product Image</label>
                        </div>
                        <div class="col-md-7">
                            <input name="product_image" class="form-control">
                        </div>
                    </div>
                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-3">
                            <label for="product_price" style="color: grey">Product Price</label>
                        </div>
                        <div class="col-md-7">
                            <input name="product_price" class="form-control" type="text">
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
    load_data();
    var save_method;

    setTimeout(function(){
        $('.alert').fadeOut();
    }, 3000);

    function update_product(product_id){
        save_method = 'update';
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/update_each_product/" + product_id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="product_id"]').val(data.product_id);
                $('[name="product_name"]').val(data.product_name);
                $('[name="product_type"]').val(data.product_type);
                $('[name="product_description"]').val(data.product_description);
                $('[name="product_image"]').val(data.product_image);
                $('[name="product_price"]').val(data.product_price);

                $('#updateProductModal').modal('show');
            }
        })
    }

    function save(){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/update_product_details",
            type: "POST",
            data: $('#form'). serialize(),
//            data: new FormData(this),
//            processData: false,
//            contentType: false,
//            cache: false,
//            async: false,
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

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/search_update_product",
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
