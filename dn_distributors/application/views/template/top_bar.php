<div class="w3-bar w3-card-2 w3-wide">
    <a class="w3-bar-item w3-button w3-hover-white w3-padding-16" id="navbtn_menu1">
        Menu 1
    </a>
    <a class="w3-bar-item w3-button w3-hover-white w3-padding-16" id="navbtn_menu2">
        Menu 2
    </a>
    <a class="w3-bar-item w3-button w3-hover-white w3-padding-16" id="navbtn_menu3">
        Menu 3
    </a>
    <div class="w3-right w3-dropdown-click">
        <a class="w3-bar-item w3-button w3-hover-white w3-padding-16" href="#">
            <i class="fa fa-search" style="font-size: 25px"></i>
        </a>


    </div>
</div>

<script>
    function myFunction(){
        var x = document.getElementById("Demo");
        if(x.className.indexOf("w3-show") == -1){
            x.className += " w3-show";
        }else{
            x.className = x.className.replace(" w3-show", "");
        }
    }
</script>