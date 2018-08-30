<?php require_once 'header.php'; ?>
<?php require_once 'top2.php'; ?>
<?php require_once 'dp_side_bar.php'; ?>
<div class="col-md-10"><br>
    <div class="w3-left-align">
        <input type="text" name="search_text" id="search_text" class="form-control" placeholder="Search by customer name" style="width: 50%">
    </div>
    <br>
    <div id="result"></div>
</div>
<?php if($this->session->flashdata('massage')){
    $massage = $this->session->flashdata('massage');?>
    <div class="<?php echo $massage['class'] ?>"><?php echo $massage['massage']; ?></div>
<?php } ?>



</body>
</html>
<script>
/** After windod Load */
load_data();
$(window).bind("load", function() {
window.setTimeout(function() {
$(".alert").fadeTo(500, 0).slideUp(500, function(){
$(this).remove();
});
}, 4000);
});

function load_data(query){
    $.ajax({
        url: "<?php echo site_url(); ?>/Delivery_person/search_view_pending_orders_view",
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