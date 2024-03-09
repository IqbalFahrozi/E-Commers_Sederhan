<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="assets/css/contoh.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <div class="box">
        <div>
            <a href="my-wishlist.php"><i class="icon fas fa-heart"></i> <span>Daftar Keinginan</span></a>
            <a href="my-cart.php"><i class="icon fas fa-shopping-cart"></i> <span>Keranjang saya</span></a>
            <a href="track-orders.php" class="dropdown-toggle"><span class="key">Lacak pesanan</span></a>
        </div>
        <div>
            <a href="my-account.php"><i class="icon fas fa-user"></i> <span>Akun Saya</span></a>
            <?php if (strlen($_SESSION['login']) == 0) { ?>
            <a href="login.php"><i class="icon fas fa-sign-in-alt"></i> <span>Masuk</span></a>
            <?php } else { ?>
            <a href="logout.php"><i class="icon fas fa-sign-out-alt"></i><span>Keluar</span></a>
            <?php } ?>
        </div>
    </div>
    <div class="navbar">
        <div class="navbar-logo">
            <a href="index.php">
                <img src="img/logo.png" alt="Home" style="width: 100px; height: 100px; object-fit: cover;">
            </a>
        </div>
        <div class="navbar-text">
            <form class="navbar-form" role="search" action="search-result.php" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search here..." name="product" required="required">
                </div>
                <button type="submit" class="btn btn-default btn-primary">Search</button>
            </form>
        </div>
        <?php
            if (!empty($_SESSION['cart'])) {
        ?>
        <div class="dropdown dropdown-cart">
            <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                <div class="items-cart-inner">
                    <div class="total-price-basket">
                        <span class="lbl">cart -</span>
                        <span class="total-price">
                            <span class="sign">Rp.</span>
                            <span class="value">
                                <?php echo $_SESSION['tp']; ?>
                            </span>
                        </span>
                    </div>
                    <div class="basket">
                        <i class="icon fas fa-shopping-cart"></i>
                    </div>
                    <div class="basket-item-count"><span class="count">
                            <?php echo $_SESSION['qnty']; ?>
                        </span>
                    </div>
                </div>
            </a>
            <ul class="dropdown-menu">
                <?php
                    $sql = "SELECT * FROM products WHERE id IN(";
                    foreach ($_SESSION['cart'] as $id => $value) {
                        $sql .= $id . ",";
                    }
                    $sql = substr($sql, 0, -1) . ") ORDER BY id ASC";
                    $query = mysqli_query($con, $sql);
                    $totalprice = 0;
                    $totalqunty = 0;
                    if (!empty($query)) {
                        while ($row = mysqli_fetch_array($query)) {
                            $quantity = $_SESSION['cart'][$row['id']]['quantity'];
                            $subtotal = $_SESSION['cart'][$row['id']]['quantity'] * $row['productPrice'] + $row['shippingCharge'];
                            $totalprice += $subtotal;
                            $_SESSION['qnty'] = $totalqunty += $quantity;

                            $gambar1 = base64_encode($row['productImage1']);
                            $gambar2 = base64_encode($row['productImage2']);
                            $gambar3 = base64_encode($row['productImage3']);
                ?>
                <div class="cart-item product-summary">
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="image">
                                <a href="product-details.php?pid=<?php echo htmlentities($row['id']); ?>">
                                    <img src="data:image/jpeg;base64,<?php echo $gambar1; ?>" width="35" height="50" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-7">
                            <h3 class="name"><a href="product-details.php?pid=<?php echo $row['id']; ?>">
                                    <?php echo $row['productName']; ?>
                                </a>
                            </h3>
                            <div class="price">
                                Rp.
                                <?php echo ($row['productPrice'] + $row['shippingCharge']); ?>*
                                <?php echo $_SESSION['cart'][$row['id']]['quantity']; ?>
                            </div>
                        </div>
                    </div>
                </div><!-- /.cart-item -->
                <?php }
                                            } ?>
                <div class="clearfix"></div>
                <hr>
                <div class="clearfix cart-total">
                    <div class="pull-right">
                        <span class="text">Total :</span><span class='price'>Rp.
                            <?php echo $_SESSION['tp'] = "$totalprice" . ".00"; ?>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <a href="my-cart.php" class="btn btn-upper btn-primary btn-block m-t-20">My Cart</a>
                </div><!-- /.cart-total-->

            </ul><!-- /.dropdown-menu-->
        </div><!-- /.dropdown-cart -->
        <?php } else { ?>
        <div class="dropdown dropdown-cart">
            <a href="#" class="dropdown  lnk-cart" data-toggle="dropdown">
                <div class="items-cart-inner">
                    <div class="total-price-basket">
                        <span class="lbl">Keranjang -</span>
                        <span class="total-price">
                            <span class="sign">IDR.</span>
                            <span class="value">0</span>
                        </span>
                    </div>
                    <div class="basket">
                        <i class="icon fas fa-shopping-cart"></i>
                        <div class="basket-item-count"><span class="count">0</span></div>
                    </div>

                </div>
            </a>
            <ul class="dropdown-menu">
                <div class="cart-item product-summary">
                    <div class="row">
                        <div class="col-xs-12">
                            Your Shopping Cart is Empty.
                        </div>
                    </div>
                </div><!-- /.cart-item -->
                <hr>
                <div class="clearfix cart-total">
                    <div class="clearfix"></div>
                    <a href="index.php" class="btn btn-upper btn-primary btn-block m-t-20">Continue Shopping</a>
                </div><!-- /.cart-total-->
            </ul><!-- /.dropdown-menu-->
        </div>
        <?php } ?>

        <div class="clearfix"></div>
    </div>
    </div>


</body>

</html>
