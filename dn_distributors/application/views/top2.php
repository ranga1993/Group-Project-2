<nav class="w3-navbar navbar-inverse" style="height: inherit">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="#">Page 1-1</a></li>
                    <li><a href="#">Page 1-2</a></li>
                    <li><a href="#">Page 1-3</a></li>
                </ul>
            </li>
            <li><a href="#">Page 2</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li style="padding-top: 7px">
                <font color="white" size="5">
                    <!--                --><?php //if($this->session->userdata('user_id') == TRUE) {?>
                    <?php echo ($this->session->userdata('name')); ?>
                    <!--                --><?php //} ?>
                </font>
            </li>
            <li class="logout">
                <a href="<?php echo base_url('index.php/User_authentication/logout'); ?>">
                    <span class="glyphicon glyphicon-log-out"></span>
                </a>
                <!--                <ul class="dropdown-menu">-->
                <!--                    <li><a href="#">Page 1-1</a></li>-->
                <!--                    <li><a href="#">Page 1-2</a></li>-->
                <!--                    <li><a href="#">Page 1-3</a></li>-->
                <!--                </ul>-->
            </li>
        </ul>
    </div>
</nav>

