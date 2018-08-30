<?php require_once ('cus_header.php') ?>
<?php require_once ('top.php') ?>
<?php require_once ('customer_side_bar.php') ?>


<?php echo form_open('Customer/Registration',array("id" =>"form-register","class" => "form-horizontal"));?>

<div class="container" >

    <h2>Please Fill This Form To Register</h2>

    <div id="the-massage"> </div>

        <?php if($this->session->flashdata('massage')){
            $massage = $this->session->flashdata('massage');?>
            <div class="<?php echo $massage['class'] ?>"><?php echo $massage['massage']; ?></div>
        <?php } ?>
    <div class="container" >

        <h3>Your Details</h3>

        <div class="form-group">
            <label for="cus_name">Name</label>
            <input type="text" class="form-control" id="cus_name" name="cus_name" value="" placeholder="Your Name">
        </div>

        <div class="form-group">
            <label for="cus_nic">NIC</label>
            <input type="text" class="form-control" id="cus_nic" name="cus_nic" value="" placeholder="National Identity Card Number">
        </div>

        <div class="form-group">
            <label for="cus_address">Address</label>
            <input type="text" class="form-control" id="cus_address" name="cus_address" value="" placeholder="Your Address">
        </div>

        <div class="form-group">
            <label for="cus_phone">Phone Number</label>
            <input type="text" class="form-control" id="cus_phone" name="cus_phone" value="" placeholder="Your Mobile Phone Number">
        </div>
        <div class="form-group">
            <label for="cus_email">E-mail</label>
            <input type="text" class="form-control" id="cus_email" name="cus_email" value="" placeholder="Your E-mai Address">
        </div>

        <div class="form-group">
            <label for="cus_company_name">Company Name</label>
            <input type="text" class="form-control" id="cus_company_name" name="cus_company_name" value="" placeholder="Your Company Name">
        </div>

        <div class="form-group">
            <label for="cus_company_address">Company Address</label>
            <input type="text" class="form-control" id="cus_company_address" name="cus_company_address" value="" placeholder="Your Company Address" >
        </div>

        <div class="form-group">
            <label for="cus_company_phone">Company Phone Number</label>
            <input type="text" class="form-control" id="cus_company_phone" name="cus_company_phone" value="" placeholder="Your Company Phone number">
        </div>



        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-success">Complete Registration</button>
            </div><!-- /.col-lg-6 -->

            <div class="col-lg-6">
                <button type="button" class="btn btn-warning">Cancel Registration</button>
            </div><!-- /.col-lg-6 -->
        </div><!-- /.row -->

    </div>

<?php echo form_close();?>



    <script>

        $('#form-register').submit(function(e){
            e.preventDefault();
            //alert('submit');

            var me= $(this);

            $.ajax ({
                url : me.attr('action'),
                type : 'post',
                data : me.serialize(),
                dataType : 'json',
                success : function (response) {
                    if(response.success == true){
                        //alert('success');
                        //show success massage
                        //remove error class
                        $('#the-massage').append('<div class= "alert alert-success" >'+
                            '<span class="glyphicon glyphicon-ok "></span>'+
                            'Register Successful' + '</div>');

                        $('.form-group').removeClass('has-error')
                            .removeClass('has-success');

                        $('.text-danger').remove();

                        //reset form
                        me[0].reset();

                        //close the massage after seconds
                        $('.alert-success').delay(500).show(10,function(){
                            $(this).delay(3000).hide(10,function(){
                                $(this).remove();
                            });
                        })
                    }
                    else{
                        //alert('failed');
                        $.each(response.massages, function(key,value){
                            var element = $("#"+ key);

                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error':'has-success')
                                .find('.text-danger')
                                .remove();

                            element.after(value);
                        });
                    }
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