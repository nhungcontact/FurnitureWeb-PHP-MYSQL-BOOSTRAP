<?php
require_once '../partials/mysqli_connect.php';
include './function.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin</title>
    <link rel="stylesheet" href="fontawesome-free-6.0.0/css/all.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sidebars/">
    <!-- Bootstrap core CSS -->
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="sidebars.css" rel="stylesheet">
    <link href="css/phantrang.css" rel="stylesheet">
  </head>
  <style>
    #mySidenav{
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: #212529;
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 40px;
    }
    #mySidenav .closebtn {
        position: absolute;
        top: -10px;
        right: 15px;
        font-size: 33px;
        margin-left: 50px;
    }
    #main {
        transition: margin-left .5s;
        padding: 10px;
    }
  </style>
        <!-- jquery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <body>
<main>
    <div class="flex-shrink-0 bg-dark" id="mySidenav">
    <a href="javascript:void(0)" class="closebtn link-light text-decoration-none" onclick="closeNav()">×</a>
        <a href="/" class="d-flex align-items-center pb-3 ps-3 mb-3 link-light text-decoration-none border-bottom">
            <span class="fs-5 fw-semibold">ADMIN</span>
        </a>
        <ul class="list-unstyled ps-0">
            <li class="py-1">
            <a href="admin.php?page_layout=trangchu" class="link"><i class="fa-solid fa-table-list me-3"></i>Trang chủ</a>
            </li>
            <li class="py-1"><a href="admin.php?page_layout=danhsach" class="link"><i class="fa-solid fa-cart-flatbed me-3" ></i>Sản phẩm</a></li>
            <li class="py-1"><a href="admin.php?page_layout=danhmuc" class="link"><i class="fa-solid fa-cart-flatbed me-3" ></i>Danh mục</a></li>
            <li class="mb-1 py-1">
                <a href="/" class="link btn-toggle collapsed" data-bs-toggle="collapse" data-bs-target="#home-collapse" aria-expanded="true">
                <i class="fa-solid fa-cart-flatbed me-3"> </i>Đơn hàng
                </a>
                <div class="collapse show" id="home-collapse">
                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                    <li><a href="admin.php?page_layout=donhang" class="link-light rounded">Danh sách đơn hàng</a></li>
                    <li><a href="admin.php?page_layout=khachhang" class="link-light rounded">Danh sách khách hàng</a></li>
                </ul>
                </div>
            </li>
            
        </ul>
    </div>

    <div class="container-fluid" id="main">
        <div class="d-flex align-items-center p-3 mb-3 border-bottom justify-content-between">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
            <div>
                <img src="https://github.com/mdo.png" alt="mdo" width="30" height="30" class="rounded-circle me-2">
                <span class="fw-semibold">Admin</span>
            </div>
        </div>

        <?php 
        if(isset($_GET['page_layout'])){
            switch ($_GET['page_layout']){
                case 'danhsach':
                    require_once '../public/danhsach.php';
                    break;
                case 'danhmuc':
                    require_once '../public/danhmuc.php';
                    break;
                case 'them':
                    require_once '../public/themsanpham.php';
                    break;
                case 'sua':
                    require_once '../public/sua.php';
                    break;
                case 'xoa':
                    require_once '../public/xoa.php';
                    break;
                case 'xoaanh':
                    require_once '../public/xoaanh.php';
                    break;
                case 'themloai':
                    require_once '../public/themloai.php';
                    break;
                case 'sualoai':
                    require_once '../public/sualoai.php';
                    break;
                case 'xoaloai':
                    require_once '../public/xoaloai.php';
                    break;
                case 'donhang':
                    require_once '../public/donhang.php';
                    break;
                case 'khachhang':
                    require_once '../public/khachhang.php';
                    break;
                default:
                    require_once '../public/danhsach.php';
                    break;
            }
        }else{
            require_once '../public/danhsach.php';
        }
        ?>
    </div>
</main>




    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>

      <script src="sidebars.js"></script>

    <script>
        
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
        }
        
    </script>
  </body>
</html>
