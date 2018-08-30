<nav class="w3-navbar navbar-inverse" style="height: inherit">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo site_url(); ?>/Home">Home</a></li>
<!--            <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Page 1 <span class="caret"></span></a>-->
<!--                <ul class="dropdown-menu">-->
<!--                    <li><a href="#">Page 1-1</a></li>-->
<!--                    <li><a href="#">Page 1-2</a></li>-->
<!--                    <li><a href="#">Page 1-3</a></li>-->
<!--                </ul>-->
<!--            </li>-->
            <li><a href="<?php echo site_url(); ?>/Home/products">Products</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contact Us</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <a data-toggle="modal" href="#regModal">
                    Register
                </a>
            </li>
            <li class="login">
                <a data-toggle="modal" href="#loginModal">
                    <span class="glyphicon glyphicon-log-in"></span>
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

