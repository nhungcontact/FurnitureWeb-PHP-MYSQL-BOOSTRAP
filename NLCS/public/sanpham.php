<?php
include('../partials/header.php')
?>
    <div class="breadcrumb_background_sp">
        <h1 class="title_bg">Sản phẩm</h1>
        <div class="overlay">
        </div>
    </div>
    <?php 
        $order ="";
        $orderField = isset($_GET['field'])?$_GET['field']:"";
        $orderSort = isset($_GET['sort'])?$_GET['sort']:"";

        $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 12 ; //hien thi 1 trang 6 san pham
        $current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
        $offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi

        if(!empty($orderField) && !empty($orderSort)){
            $order = "ORDER BY `sanpham`.`".$orderField."` ".$orderSort;
            $sanpham = mysqli_query($conn, "SELECT * from `sanpham` ".$order." LIMIT " .$item_per_page." OFFSET ".$offset);
            $totalRecords = mysqli_query($conn, "SELECT * from `sanpham`");
        }elseif(isset($_GET['mucgia'])){
            $giachecked = [];
            $giachecked = $_GET['mucgia'];
            foreach($giachecked as $key){
                $where = "WHERE ".$key;
            }
            $sanpham = mysqli_query($conn, "SELECT * from `sanpham` ".$where." ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
            $totalRecords = mysqli_query($conn, "SELECT * from `sanpham` ".$where." ");
        }else{
            $sanpham = mysqli_query($conn, "SELECT * from `sanpham` ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
            $totalRecords = mysqli_query($conn, "SELECT * from `sanpham`");
        }

        $totalRecords = $totalRecords->num_rows; // lay so dong
        $totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)


    ?>
    <!-- main -->
    <main>
        <div class="container-md">
            <div class="row">
                <div class="col-3 d-xxl-block d-xl-block d-lg-block d-md-block d-sm-none d-xs-none d-none">
                    <form class="gia" method="GET">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                        <!-- <div>
                            <div class="layered_subtitle dropdown-filter">
                                <span>Danh mục sản phẩm</span>
                                <span class="icon-control">
                                    <i class="fa-solid fa-minus"></i>
                                </span>
                            </div>
                            <?php 
                                $loaisp = mysqli_query($conn,"SELECT * FROM `loaisanpham`");
                                while($rowlsp=mysqli_fetch_array($loaisp)){
                                    $checked = "";
                                    if(isset($_GET['lsp'])){
                                        $checked = $_GET['lsp'];
                                    }
                            ?>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="lsp" value="<?php echo $rowlsp['lsp_ma'] ?>" id="<?php echo $rowlsp['lsp_ma'] ?>" <?php if($rowlsp['lsp_ma']==$checked){ echo "checked";}?>/>
                                    <label class="form-check-label" for="<?php echo $rowlsp['lsp_ma'] ?>">
                                        <?php echo $rowlsp['lsp_ten'] ?>
                                    </label>
                                </div>
                            <?php } ?>
                        </div> -->
                        <div>
                            <div class="layered_subtitle dropdown-filter">
                                <span>GIÁ SẢN PHẨM</span>
                                <span class="icon-control">
                                    <i class="fa-solid fa-minus"></i>
                                </span>
                            </div>
                            
                                <?php 
                                    $gia = mysqli_query($conn,"SELECT * FROM `gia`");
                                    while($row_gia = mysqli_fetch_array($gia)){
                                        $checked = [];
                                        if(isset($_GET['mucgia'])){
                                            $checked = $_GET['mucgia'];
                                        }
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" name="mucgia[]" type="checkbox" id="<?php echo $row_gia['id_gia'] ?>" value="<?php echo $row_gia['cautruc'] ?>" <?php if(in_array($row_gia['cautruc'],$checked)){ echo "checked";}  ?> />
                                    <label class="form-check-label" for="<?php echo $row_gia['id_gia'] ?>"><?php echo $row_gia['mucgia'] ?></label>
                                </div>
                                <?php } ?>
                            
                        </div>

                        <div>
                            <div class="layered_subtitle dropdown-filter">
                                <span>MÀU SẮC</span>
                                <span class="icon-control">
                                    <i class="fa-solid fa-minus"></i>
                                </span>
                            </div>
                            <div class="mausac">
                                <?php 
                                    $mausac = mysqli_query($conn,"SELECT * FROM `mausac`");
                                    while($rowms=mysqli_fetch_array($mausac)){
                                        $checked = [];
                                        if(isset($_GET['mausac'])){
                                            $checked = $_GET['mausac'];
                                        }
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="background-color:<?php echo $rowms['mausac_css']?>!important;" name="mausac[]" type="checkbox" value="<?php echo $rowms['id_mausac'] ?>" title="<?php echo $rowms['mausac'] ?>" <?php if(in_array($rowms['id_mausac'],$checked)){ echo "checked";}  ?> />
                                </div>
                                <?php } ?>

                            </div>
                        </div>
                    </form>
                </div>
                <!-- an -->

                    <div class="collapse_boloc d-xxl-none d-xl-none d-lg-none d-md-none d-sm-flex d-xs-flex d-flex" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <p>BỘ LỘC SẢN PHẨM</p>
                        <i class="fa-solid fa-angle-down"></i>
                    </div>
                    <div class="collapse" id="collapseExample">
                        <div class="col">
                            <div>
                                <div class="layered_subtitle dropdown-filter">
                                    <span>THƯƠNG HIỆU</span>
                                    <span class="icon-control">
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                            </div>
                            <div>
                                <div class="layered_subtitle dropdown-filter">
                                    <span>GIÁ SẢN PHẨM</span>
                                    <span class="icon-control">
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </div>
                                <div class="gia">
                                    <?php 
                                    $gia = mysqli_query($conn,"SELECT * FROM `gia`");
                                    while($row_gia = mysqli_fetch_array($gia)){
                                        $checked = [];
                                        if(isset($_GET['mucgia'])){
                                            $checked = $_GET['mucgia'];
                                        }
                                ?>
                                <div class="form-check">
                                    <input class="form-check-input" name="mucgia[]" type="checkbox" id="<?php echo $row_gia['id_gia'] ?>" value="<?php echo $row_gia['cautruc'] ?>" <?php if(in_array($row_gia['cautruc'],$checked)){ echo "checked";}  ?> />
                                    <label class="form-check-label" for="<?php echo $row_gia['id_gia'] ?>"><?php echo $row_gia['mucgia'] ?></label>
                                </div>
                                <?php } ?>
                                </div>
                            </div>

                            <div>
                                <div class="layered_subtitle dropdown-filter">
                                    <span>MÀU SẮC</span>
                                    <span class="icon-control">
                                        <i class="fa-solid fa-minus"></i>
                                    </span>
                                </div>
                                <div class="mausac">
                                    <?php 
                                    $mausac = mysqli_query($conn,"SELECT * FROM `mausac`");
                                    while($rowms=mysqli_fetch_array($mausac)){
                                        $checked = [];
                                        if(isset($_GET['mausac'])){
                                            $checked = $_GET['mausac'];
                                        }
                                ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" style="background-color:<?php echo $rowms['mausac_css']?>!important;" name="mausac[]" type="checkbox" value="<?php echo $rowms['id_mausac'] ?>" title="<?php echo $rowms['mausac'] ?>" <?php if(in_array($rowms['id_mausac'],$checked)){ echo "checked";}  ?> />
                                </div>
                                <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>
               
                <div class="col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12">
                    <div class="py-3 row align-items-center">
                        <h4 class="py-3 col-xxl-9 col-xl-9 col-lg-9 col-md-9 col-sm-12 col-xs-12 col-12 text-xxl-start text-xl-start text-lg-start text-md-center text-sm-center text-xs-center text-center">Tất cả sản phẩm</h4>
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12 col-12">
                            <form action="" >
                                <select name="sort" id="sort" class="sort_form" onchange=" this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);">
                                    <option value="?field=gia&sort=none">-- Lọc theo --</option>
                                    <option value="?field=gia&sort=DESC">-- Giá tăng dần --</option>
                                    <option value="?field=gia&sort=ASC">-- Giá giảm dần --</option>
                                    <option value="?field=tensanpham&sort=ASC">-- Lọc theo tên A đến Z --</option>
                                    <option value="?field=tensanpham&sort=DESC">-- Lọc theo tên Z đến A --</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <?php 
                        while ($value = mysqli_fetch_array($sanpham)) {
                        ?>
                        <div class="col-lg-3 col-md-6 col-sm-6 col-6 spm">
                            <div class="product-img">
                                <div>
                                    <div class="product-sale"><span><?php echo isset($value['phantram'])?$value['phantram']:""?></span></div>
                                </div>
                                <a href="view_sanpham.php?id_SP=<?php echo $value['id_SP'] ?>" class="change">
                                    <img src="hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                                    <img src="hinh/<?php echo $value['hinh1']?>" alt="" class="img-fluid img-top">
                                </a>
                            </div>
                            <div class="title_sp">
                                <a href="view_sanpham.php?id_SP=<?php echo $value['id_SP'] ?>"><?php echo $value['tensanpham']?></a>
                                <p><?php echo number_format($value['gia']) ?>đ <del class="card-price-old"><?php echo $value['giacu']?></del></p>
                            </div>

                            <!-- <form class="text-center" method="POST" action="view_cart.php?action=add">
                                <input aria-label="quantity" class="text-center mb-2" max="<?php echo $value['soluong']?>" min="1" size="3" name="quanlity[<?php echo $value['id_SP']?>]" type="number" value="1"><br>
                                <button class="btndathang" type="submit" name="themvao">Đặt hàng</button>
                            </form> -->
                        </div>
                        <?php } ?>  
                         <?php
                         include './pagination.php';
                         ?>
                    </div>
                </div>

            </div>
           
        </div>
    </main>
    <?php
    include '../partials/footer.php';
?>