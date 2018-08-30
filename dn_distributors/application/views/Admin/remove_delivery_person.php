<?php require_once 'header.php'; ?>
<?php if($this->session->userdata('loggedin') == TRUE)  {?>
    <?php require_once 'top2.php'; ?>
<?php }?>
<?php require_once 'admin_side_bar.php' ?>
<div class="container col-md-10"><br>
    <?php if($this->session->flashdata('success')) {?>
        <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('error')) {?>
        <div class="alert alert-danger" role="alert">
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php } ?>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by delivery person name" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>

</div>
</div>

<script type="text/javascript">
    load_data();
    var save_method;

    setTimeout(function(){
        $('.alert').fadeOut();
    }, 3000);

    function remove_each_dp(dp_id){
        if(confirm('Are you sure you want to delete this data?')){
            $.ajax({
                url: "<?php echo site_url(); ?>/Admin/remove_each_dp/" + dp_id,
                type: "POST",
                dataType: "JSON",
                success: function(data){
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown){
                    alert('Error Deleting Data');
                }
            });
        }
    }

    function load_data(query){
        $.ajax({
            url: "<?php echo site_url(); ?>/Admin/search_remove_dp",
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
