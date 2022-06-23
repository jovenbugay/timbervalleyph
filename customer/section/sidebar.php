<style>
.sidebar-dark-primary{
    /* background: url('../assets/img/bg-masthead.jpg'); */
    
}
.sidebar  ul li a {
    /* text-decoration: underline !important; */
    border-top: 2px solid #bbb;
}

</style>


<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
        <img src="../logo.jpg" alt="AdminLTE Logo" class="brand-image elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Timber Valley PH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <!-- <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div> -->
            <div class="info">
                <!-- <a href="#" class="d-block"></a> -->
                
                <span style="color: white;"><?php echo $_SESSION['username']; ?></span>
                
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                   
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="nav-icon fa fa-home"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="account_info.php" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            Account Info
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="shipping_address.php" class="nav-link">
                        <i class="nav-icon fa fa-map-pin"></i>
                        <p>
                            Shipping Address
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="order_history.php" class="nav-link">
                        <i class="nav-icon fa fa-receipt"></i>
                        <p>
                            Order History
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="order_status.php" class="nav-link">
                        <i class="nav-icon fa fa-clock"></i>
                        <p>
                            Order Status
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="return_product.php" class="nav-link">
                        <i class="nav-icon fa fa-history"></i>
                        <p>
                            Return Product
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="aboutus.php" class="nav-link">
                        <i class="nav-icon fa fa-receipt"></i>
                        <p>
                            About Us
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="sign_out.php" class="nav-link">
                        <i class="nav-icon fa fa-power-off"></i>
                        <p>
                            Sign Out
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>