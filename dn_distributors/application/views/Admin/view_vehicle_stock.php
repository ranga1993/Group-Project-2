<?php require_once 'header.php'; ?>
<?php require_once 'top2.php'; ?>
<?php require_once 'admin_side_bar.php' ?>
<div class="container col-md-10"><br>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by product name or date" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>
</div>

<div class="container modal fade" style="padding-top: 20px" id="viewVehicleStockModal">
    <div class="w3-card-2 text-center modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form action="#" id="form">
                    <input type="hidden" value="" name="id">
                    <div class="row" style="padding-top: 8px">
                        <div class="col-md-3">
                            <label for="date" style="color: grey">Date</label>
                        </div>
                        <div class="col-md-7">
                            <input name="date" class="form-control" type="text">
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
                            <label for="remain_quantity" style="color: grey">Quantity</label>
                        </div>
                        <div class="col-md-7">
                            <input name="remain_quantity" class="form-control" type="text">
                        </div>
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
    function view_stock(id){
        save_method = 'update';
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/view_each_vehicle_stock/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                $('[name="id"]').val(data.id);
                $('[name="date"]').val(data.date);
                $('[name="product_name"]').val(data.product_name);
                $('[name="remain_quantity"]').val(data.remain_quantity);

                $('#viewVehicleStockModal').modal('show');
            }
        })
    }

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/search_view_vehicle_stock",
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
