<?php
include '../partials/mysqli_connect.php';
include '../partials/giangsinh.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <link rel="stylesheet" href="fontawesome-free-6.0.0/css/all.min.css">   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> 
    <link rel="stylesheet" href="owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="owlcarousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/phantrang.css">
</head>
<body>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Boostrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <!-- owl carousel -->
    <script src="owlcarousel/owl.carousel.min.js"></script>
     <!-- header -->
     <header class="header" style="<?php echo ($_SERVER["PHP_SELF"] == '/NLCS/public/trangchu.php') ? 'position: absolute' : 'position: relative' ?>;">
     <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xxl-7 col-xl-7 col-lg-7 col-md-6 col-sm-6 col-xs-6 col-6">
                    <ul>
                        <li>
                            <span>
                            <i class="fa-solid fa-phone-volume" style="font-size: 15px;color: #e74c3c;padding-right: 3px;"></i>
                            HotLine: 
                            </span>
                            <a href="tel: 19006777" class="a_topleft">19006777</a>
                        </li>
                    </ul>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-6 col-6">
                    <?php 
                    if (isset($_SESSION['username']) && $_SESSION['username']){
                        echo '<div class="account_top">
                                        <a class="account_left" style="" href="taikhoan.php?username='.$_SESSION['username'].'" title="Tài khoản"><b>'.$_SESSION['username'].'</b></a>
                                        <a href="logout.php" title="Thoát">Thoát</a>
                                    
                                </div>';
                            }
                            else{
                                echo '<div class="account_top">
                                            <a class="account_left" href="server.php?page=dangky" title="Đăng ký">Đăng Ký</a>
                                            <a href="server.php?page=dangnhap" title="Đăng Nhập">Đăng nhập</a>
                                    </div>';
                            }
                    ?>
                </div>
                <div class="col-1 cart_header">
                   
                    <a href="view_cart.php" class="giohang" title="Giỏ hàng">
                        <i class="fa-solid fa-basket-shopping"></i>
                        <span class="count_item count_item_pr">
                            <?php 
                            if (isset($_SESSION['soluong']) && !empty($_SESSION['cart'])){?>
                                <?php echo $_SESSION['soluong'] ?>
                            <?php }else{?>
                                <?php echo 0; }?>
                        </span>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="<?php echo ($_SERVER["PHP_SELF"] == '/NLCS/public/trangchu.php') ? '' : 'top_divider' ?>">
        </div>

        <div class="container-xl">
            <div class="row align-items-center justify-content-between">
                <a href="trangchu.php" class="logo col-2">
                            HOME's
                </a>
                <div class="left_header col-7">
                    <nav>
                        <ul class="main_menu">
                            <li><a href="trangchu.php" class="items_menu first afters">
                                TRANG CHỦ
                            </a></li>
                            <li><a href="gioithieu.php" class="items_menu first after">
                                GIỚI THIỆU
                            </a></li>
                            <li><a href="sanpham.php" class="items_menu first after">
                                SẢN PHẨM
                            </a></li>
                            
                            <li><a href="tintuc.php" class="items_menu first after">
                                TIN TỨC
                            </a></li>
                            <li><a href="lienhe.php" class="items_menu first after">
                                LIÊN HỆ
                            </a></li>
                        </ul>
                    </nav>
                </div>
                <div class="d-xxl-none d-xl-none d-lg-block d-md-block d-sm-block d-block col-lg-5 col-md-4 col-sm-4 col-4"></div>
                <div class="right_header col-xxl-3 col-xl-3 col-lg-4 col-md-5 col-sm-5 col-5">
                    <!-- search -->
                    <form onsubmit="submitFn(this, event);" action="timkiem.php" method="GET" class="search_box">
                        <input type="text" name="search" class="search_text" placeholder="Tìm sản phẩm">
                        <button class="search_btn" type="submit">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>                    
                </div>
                <!-- menu -->
               
                    <label for="nav_menu_input" class="nav_menu_icon col-1">
                            <i class="fa-solid fa-bars"></i>
                    </label>
                    <input type="checkbox" hidden id="nav_menu_input" class="nav_input">
                    <label for="nav_menu_input" class="nev_menu_icon"></label>
                    <!-- man xam -->
                    <div class="overlay_header"></div>
                    <!-- menu -->
                    <nav class="nav_menu">
                        <div class="d-flex border-bottom">
                            <div class="logo mt-2 ms-2">
                                HOME's
                            </div>
                            <label for="nav_menu_input" class="nav_menu_close">
                                <i class="fa-solid fa-xmark"></i>
                            </label>
                        </div>
                        <div class="p-3 float-end">
                            <a href="view_cart.php" class="giohang" title="Giỏ hàng">
                                <i class="fa-solid fa-basket-shopping"></i>
                                <span class="count_item count_item_pr">
                                    <?php 
                                        if (isset($_SESSION['soluong']) && !empty($_SESSION['cart'])){?>
                                            <?php echo $_SESSION['soluong'] ?>
                                        <?php }else{ ?>
                                            <?php echo 0 ?>
                                    <?php } ?>
                                </span>
                            </a>
                        </div>
                        <ul class="nav_menu_list">
                            <li><a class="nav_menu_item" href="trangchu.php">
                                Trang chủ
                            </a></li>
                            <li class="level0"><a class="nav_menu_item" href="gioithieu.php">
                                Giới thiệu
                            </a></li>
                            <li class="level0"><a class="nav_menu_item" href="sanpham.php">
                                SẢN PHẨM
                            </a></li>
                            <li class="level0"><a class="nav_menu_item" href="tintuc.php">
                                Tin tức
                            </a></li>
                            <li class="level0"><a class="nav_menu_item" href="lienhe.php">
                                Liên hệ
                            </a></li>
                        </ul>
                    </nav>
            </div>
        </div>
    </header>