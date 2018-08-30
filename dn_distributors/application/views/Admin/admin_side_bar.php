<div class="row">
    <div class="col-md-2">
<!--        <div class="w3-sidebar w3-bar-block w3-white w3-card" id="side_bar" style="width: 16%">-->
            <ul class="nav sidebar-nav">
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Customers<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 100%">
                        <li><a href="<?php echo site_url(); ?>/Admin/add_customer">Add Customer</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/update_customer">Update Customer Details</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/view_customer">View Customers</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/remove_customer">Remove Customer</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Delivery Person<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 100%">
                        <li><a href="<?php echo site_url(); ?>/Admin/add_delivery_person">Add Delivery Person</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/update_delivery_person">Update Delivery Person</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/view_delivery_person">View Delivery Persons</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/remove_dp">Remove Delivery Person</a></li>
                    </ul>
                </li>
<!--                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Orders<span class="caret"></span></a>-->
<!--                    <ul class="dropdown-menu" style="width: 100%">-->
<!--                        <li><a href="#">Create Order</a></li>-->
<!--                        <li><a href="#">Update Order Details</a></li>-->
<!--                        <li><a href="--><?php //echo site_url(); ?><!--/Admin/view_pending_orders">View Pending Orders</a></li>-->
<!--                        <li><a href="--><?php //echo site_url(); ?><!--/Admin/view_delivered_orders">View Delivered Orders</a></li>-->
<!--                        <li><a href="#">Close Order</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Products<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 100%">
                        <li><a href="<?php echo site_url(); ?>/Admin/add_product">Add Product</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/update_product">Update Product Details</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/view_products">View Products</a></li>
<!--                        <li><a href="--><?php //echo site_url(); ?><!--/Admin/remove_product">Remove Product</a></li>-->
                    </ul>
                </li>
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Main Stock<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 100%">
                        <li><a href="<?php echo site_url(); ?>/Admin/add_main_stock">Add Stock</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/update_main_stock">Update Main Stock</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/view_main_stock">View Main Stock</a></li>
                        <!--                        <li><a href="--><?php //echo site_url(); ?><!--/Admin/remove_product">Remove Product</a></li>-->
                    </ul>
                </li>
<!--                <li><a href="--><?php //echo site_url(); ?><!--/Admin/view_main_stock">View Main Stock</a></li>-->
                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Manage Vehicle Stock<span class="caret"></span></a>
                    <ul class="dropdown-menu" style="width: 100%">
                        <li><a href="<?php echo site_url(); ?>/Admin/vehicle_stock">Add Vehicle Stock</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/update_vehicle_stock">Update Vehicle Stock</a></li>
                        <li><a href="<?php echo site_url(); ?>/Admin/view_vehicle_stock">View Vehicle Stock</a></li>
                    </ul>
                </li>
            </ul>
<!--            <button class="w3-button w3-block w3-dropdown-click w3-left-align">-->
<!--                Manage Customers-->
<!--                <i class="caret"></i>-->
<!--            </button>-->
<!--            <div class="w3-dropdown-content" style="width: 100%">-->
<!--                <a href="Admin/add_customer" class="w3-bar-item w3-button">Add Customer</a>-->
<!--                <a href="Admin/update_customer" class="w3-bar-item w3-button">Update Customer</a>-->
<!--            </div>-->
<!--            <button class="w3-button w3-block w3-left-align" onclick="myAccFunc1()">-->
<!--                Manage Customers <i class="caret"></i>-->
<!--            </button>-->
<!--            <div id="demoAcc1" class="w3-hide w3-white w3-card">-->
<!--                <a href="Admin/add_customer" class="w3-bar-item w3-button" id="1">Add Customer</a>-->
<!--                <a href="Admin/update_customer" class="w3-bar-item w3-button" id="2">Update Customer Details</a>-->
<!--                <a href="#" class="w3-bar-item w3-button" id="3">View Customers</a>-->
<!--                <a href="#" class="w3-bar-item w3-button" id="4">Remove Customer</a>-->
<!--            </div>-->
<!--            <button class="w3-button w3-block w3-left-align" onclick="myAccFunc2()">-->
<!--                Manage Delivery Persons <i class="caret"></i>-->
<!--            </button>-->
<!--            <div id="demoAcc2" class="w3-hide w3-white w3-card">-->
<!--                <a href="#" class="w3-bar-item w3-button">Add Delivery Person</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Update Delivery Person</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">View Delivery Persons</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Remove Delivery Person</a>-->
<!--            </div>-->
<!--            <button class="w3-button w3-block w3-left-align" onclick="myAccFunc3()">-->
<!--                Manage Orders <i class="caret"></i>-->
<!--            </button>-->
<!--            <div id="demoAcc3" class="w3-hide w3-white w3-card">-->
<!--                <a href="#" class="w3-bar-item w3-button">Create Order</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Update Order Details</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">View Pending Orders</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">View Delivered Orders</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Close Order</a>-->
<!--            </div>-->
<!--            <button class="w3-button w3-block w3-left-align" onclick="myAccFunc4()">-->
<!--                Manage Products <i class="caret"></i>-->
<!--            </button>-->
<!--            <div id="demoAcc4" class="w3-hide w3-white w3-card">-->
<!--                <a href="#" class="w3-bar-item w3-button">Add Product</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Update Product Details</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">View Products</a>-->
<!--                <a href="#" class="w3-bar-item w3-button">Remove Product</a>-->
<!--            </div>-->
<!--        </div>-->

    </div>


