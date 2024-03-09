<div class="header-nav animate-dropdown">
    <div class="container">
        <div class="yamm navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                    class="navbar-toggle collapsed" type="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <div class="nav-bg-class">
                <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                    <div class="nav-outer">
                        <ul class="nav navbar-nav">
                            <li class="active dropdown yamm-fw">
                                <a href="index.php" data-hover="dropdown" class="dropdown-toggle">Home</a>
                            </li>
                            <li><a href="my-account.php"><i class="icon fa fa-user"></i> Akun Saya</a></li>
                            <li><a href="my-wishlist.php"><i class="icon fa fa-heart"></i> Daftar Keinginan</a></li>
                            <li><a href="my-cart.php"><i class="icon fa fa-shopping-cart"></i> Keranjang saya</a></li>
                            <?php if(strlen($_SESSION['login'])==0) { ?>
                            <li><a href="login.php"><i class="icon fa fa-sign-in"></i> Masuk</a></li>
                            <?php } else { ?>
                            <li><a href="logout.php"><i class="icon fa fa-sign-out"></i>Keluar</a></li>
                            <?php } ?>
                            <li>
                                <a href="track-orders.php" class="dropdown-toggle"><span class="key">Lacak
                                        pesanan</span></a>
                            </li>


                        </ul><!-- /.navbar-nav -->
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>