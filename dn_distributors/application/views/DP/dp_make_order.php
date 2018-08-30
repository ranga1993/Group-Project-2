<?php require_once 'header.php'; ?>
<?php require_once 'top2.php'; ?>
<?php require_once 'dp_side_bar.php' ?>

<?php if($this->session->flashdata('massage')){
    $massage = $this->session->flashdata('massage');?>
    <div class="<?php echo $massage['class'] ?>"><?php echo $massage['massage']; ?></div>
<?php } ?>

<div class="col-lg-4 col-md-10 ">
    <div class="table-responsive">
        <h3 align="center" >Add Item and Quantity</h3>
        <?php echo form_open('Delivery_person/SubmitOrder');?>
        <?php
        foreach ($product as $row){
            echo '
                        <div class="col-md-4" style="
                                                     padding:20px;
                                                     background-color:#f1f1f1;
                                                     border:1px solid #ccc;
                                                     margin-bottom:16px;
                                                     height:270px;" align="center">
                                <img src="http://localhost/dn_distributors/assets/images/'.$row->product_image.'" class="img-thumbnail" style="width:200px;height:100px;"/><br />
                                <h4> '.$row->product_name.' </h4>
                                <h4>Rs : '.$row->product_price.' </h4>
                                <input type="text" class="quantity" name="quantity"  id="'.$row->product_id.'" placeholder="Add Quantity Here" />
                                <button type="button" name="add_cart"  class="btn btn-success add_cart" data-product_name="'.$row->product_name.'" data-product_price="'.$row->product_price.'" data-product_id="'.$row->product_id.'">Add to Order</button>
                        </div>
                    ';
        }
        ?>
    </div>
</div>

<div class="col-md-4 col-lg-5">

    <div id="cart_details">
        <h3 align="center">Order is Empty</h3>
    </div>

    <div class="form-group">
        <label for="cus_nic">Customer NIC</label>
        <input type="text" class="form-control" id="cus_nic" name="cus_nic" value="<?php if($cus_nic) {echo $cus_nic;} ?>" placeholder="Customer NIC" required>
    </div>

    <div class="form-group">
        <label for="delivery_address">Delivery Address</label>
        <input type="text" class="form-control" id="delivery_address" name="delivery_address" value="<?php if($cus_company_address) { echo $cus_company_address;}?>" placeholder="Delivery Address" required>
    </div>

    <div class="form-group">
        <label for="delivery_date">Delivery Date</label>
        <input type="date" class="form-control" id="delivery_date" name="delivery_date" value="" placeholder="Delivery Date" required>
    </div>

    <div class="form-group">

        <button type="submit" class="btn btn-success">Complete Your Order</button>


        <button type="button" name="clear_cart" class="btn btn-warning clear_cart">Cancel Your Order</button>

    </div>

</div>

</div>







<script>
    $(document).ready(function(){
        $('.add_cart').click(function(){
            var product_id = $(this).data("product_id");
            var product_name = $(this).data("product_name");
            var product_price = $(this).data("product_price");
            var quantity = $('#'+ product_id).val();

            if (quantity!='' && quantity>0){

                    $.ajax({
                        url : "http://localhost/dn_distributors/index.php/Customer/AddToCart",
                        method : "POST",
                        data : {product_id : product_id, product_name : product_name, product_price : product_price, quantity : quantity },

                        success : function(data){
                            //alert ("Product Added into Cart ");
                            $('#cart_details').html(data);
                            $('#'+product_id).val('');
                        }
                    });
                }


            else{
                alert("Please Enter Valid Quantity");
            }

        });

        $('#cart_details').load("http://localhost/dn_distributors/index.php/Delivery_person/LoadCart");

        $(document).on('click','.remove_inventory',function(){
            var row_id = $(this).attr("id");
            if(confirm("Are you sure you want to remove this ? "))
            {
                $.ajax({
                    url : "http://localhost/dn_distributors/index.php/Delivery_person/RemoveItem",
                    method : "POST",
                    data : {row_id : row_id},
                    success : function(data){
                        alert ("Item Removed from Your Order");
                        $('#cart_details').html(data);
                    }
                })
            }
            else
            {
                return false ;
                //alert("so");
            }
        });

        $(document).on('click','.clear_cart',function(){
            if(confirm("Are you sure you want to clear order ? ")){
                $.ajax({
                    url : "http://localhost/dn_distributors/index.php/Delivery_person/ClearCart",
                    success : function (data){
                        alert("Your order has been canceled...");
                        $('#cart_details').html(data);
                    }

                });
            }
            else{
                return false ;
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

<?php echo form_close();?>
