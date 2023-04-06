<style>
.w3-button:hover {
    background-color: rgba(26, 151, 245,0.15)!important;
}
</style>

<!-- Top container -->
<div class="w3-top" style="z-index:4;">
    <div class="w3-bar w3-blue w3-large" style="z-index:4">
        <h3 class="w3-bar-item">ADMIN</h3>
    <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
    <div class="w3-dropdown-hover w3-hide-small w3-right w3-bar-item" style="margin-right: 25px;">
        <button class="w3-button" title="Notifications" style="color: #fff!important;background: none!important;">Dropdown <i class="fa fa-caret-down"></i></button>     
        <div class="w3-dropdown-content w3-card-4 w3-bar-block">
        <a href="#" class="w3-bar-item w3-button">Link</a>
        <a href="#" class="w3-bar-item w3-button">Link</a>
        <a href="#" class="w3-bar-item w3-button">Link</a>
        </div>
    </div>
    </div>

</div>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:260px;" id="mySidebar"><br>
    <div class="w3-bar-block w3-padding">
        <a href="#" class="w3-bar-item w3-hide-large w3-right-align" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw" style="font-size:20px;"></i></a>
        <div class="py-3">
            <div>
                <p class="text-muted ps-2 my-2" style="font-size:13px;font-weight:500;">TỔNG HỢP</p>
                <a href="admin.php?page_layout=tonghop" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'tonghop') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-solid fa-chart-line"></i>Tổng hợp</a>
            </div>
            <div class="pt-2">
                <p class="text-muted ps-2 my-2" style="font-size:13px;font-weight:500;">QUẢN LÝ</p>
                <a href="admin.php?page_layout=danhmuc" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'danhmuc') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-solid fa-diagram-project"></i>Danh mục</a>
                <a href="admin.php?page_layout=sanpham" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'sanpham') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-solid fa-table-cells"></i>Sản phẩm</a>
                <a onclick="myAccFunc()" href="javascript:void(0)" class="w3-button w3-block w3-white w3-left-align" id="myBtn">
                <i class="pe-3 fa-solid fa-cart-flatbed"></i> Đơn hàng <i class="ps-5 " style="padding-left: 70px;" id="btnArrow"></i>
                </a>
                <div id="demoAcc" class="w3-bar-block w3-hide ps-3 w3-medium">
                <a href="admin.php?page_layout=donhang" class="w3-bar-item w3-button <?php if( $_GET['page_layout'] === 'donhang') { echo 'w3-blue'; } ?>">Danh sách đơn hàng</a>
                <a href="admin.php?page_layout=khachhang" class="w3-bar-item w3-button <?php if( $_GET['page_layout'] === 'khachhang') { echo 'w3-blue'; } ?>">Danh sách khách hàng</a>
                </div>
                <a href="admin.php?page_layout=nguoidung" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'nguoidung') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-regular fa-user"></i>Người dùng</a>
                <a href="admin.php?page_layout=tintuc" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'tintuc') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-regular fa-newspaper"></i>Tin tức</a>
                <a href="admin.php?page_layout=binhluan" class="w3-bar-item w3-button w3-padding <?php if( $_GET['page_layout'] === 'binhluan') { echo 'w3-blue'; } ?>"><i class="pe-3 fa-regular fa-comments"></i>Bình luận</a>
            </div>
        </div>
    </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:280px;margin-right:15px;margin-top:43px;">
