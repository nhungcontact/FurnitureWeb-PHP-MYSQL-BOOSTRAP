<?php
include '../partials/header.php';
?>
<style>
    
/* nut so luong */
   .buttons_added {
    opacity:1;
    display:inline-block;
    display:-ms-inline-flexbox;
    display:inline-flex;
    white-space:nowrap;
    vertical-align:top;
}
.is-form {
    overflow:hidden;
    position:relative;
    background-color:#f9f9f9;
    height:2.2rem;
    width:1.9rem;
    padding:0;
    text-shadow:1px 1px 1px #fff;
    border:1px solid #ddd;
}
.is-form:focus,.input-text:focus {
    outline:none;
}
.is-form.minus {
    border-radius:4px 0 0 4px;
}
.is-form.plus {
    border-radius:0 4px 4px 0;
}
.input-qty {
    background-color:#fff;
    height:2.2rem;
    text-align:center;
    font-size:1rem;
    display:inline-block;
    vertical-align:top;
    margin:0;
    border-top:1px solid #ddd;
    border-bottom:1px solid #ddd;
    border-left:0;
    border-right:0;
    padding:0;
}
.input-qty::-webkit-outer-spin-button,.input-qty::-webkit-inner-spin-button {
    margin:0;
}
</style>
<main>
        <?php        
        $result = mysqli_query($conn, "SELECT * FROM `sanpham` p INNER JOIN `loaisanpham` l WHERE p.lsp_ma = l.lsp_ma AND p.id_SP= '".$_GET['id_SP']."'");
        $sanpham = mysqli_fetch_assoc($result);?>
    <hr>
    <div class="container details">
        <h2 class="py-4 text-center">Chi tiết sản phẩm</h2>
        <div class="row">
            <div class="col-6">
                <img src="hinh/<?= $sanpham['hinh'] ?>" alt="" class="img-fluid" id="expandedImg">
                <div class="owl-carousel owl-theme mt-2">
                    <div class="item">
                        <img src="hinh/<?php echo $sanpham['hinh'] ?>" alt="" class="demo img-fluid" onclick="myFunction(this);">
                    </div>
                    <div class="item">
                        <img src="hinh/<?php echo $sanpham['hinh1'] ?>" alt="" class="demo img-fluid" onclick="myFunction(this);">
                    </div>
                    <?php 
                        $thuvienanh = mysqli_query($conn, "SELECT * FROM `thuvienanh` WHERE `id_SP`='".$_GET['id_SP']."'");
                        while($row_anh = mysqli_fetch_assoc($thuvienanh)){
                            echo "";
                            ?>
                        <div class="item">
                            <img src="<?php echo $row_anh['path'] ?>" alt="" class="demo img-fluid" onclick="myFunction(this);">
                        </div>
                    <?php }?>
                    
                    
                </div>
            </div>
            <div class="col-6 noidung">
                <h4><?php echo $sanpham['tensanpham'] ?></h4>
                <p>Phân loại : <?php echo $sanpham['lsp_ten'] ?></p>
                <h5 class="text-danger"><?php echo number_format($sanpham['gia']) ?>đ <del class="card-price-old"><?php echo isset($sanpham['giacu'])?$sanpham['giacu']:"" ?></del></h5>
                <form method="POST" action="view_cart.php?action=add">
                    <div class="my-3">
                        <div class="col-2 align-self-center">
                            <b>Màu sắc</b>
                        </div>
                        <div class="col-8 align-self-center">
                            <?php 
                                $mausac = mysqli_query($conn,"SELECT * FROM `chitietsanpham` ct INNER JOIN `mausac` ms ON ct.`id_mausac`=ms.`id_mausac` WHERE ct.`id_SP`='".$_GET['id_SP']."'");
                                while($rowms=mysqli_fetch_array($mausac)){
                            ?>
                            <div class="form-check form-check-inline" style="font-size:28px;margin-right:0px!important;">
                                <input class="form-check-input" style="border-radius:50%;background-color:<?php echo $rowms['mausac_css']?>!important;" type="radio" name="mausac[<?php echo $sanpham['id_SP']?>]" value="<?php echo $rowms['mausac'] ?>" title="<?php echo $rowms['mausac'] ?>" <?php isset($_GET['mausac'])?"checked":"";  ?> />
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-2 align-self-center">
                            <b>Số lượng</b>
                        </div>
                        <div class="buttons_added my-1 col-8 align-self-center">
                            <input class="minus is-form" type="button" value="-">
                            <input aria-label="quantity" class="input-qty" max="<?php echo $sanpham['soluong']?>" min="1" name="quanlity[<?php echo $sanpham['id_SP']?>]" type="number" value="1">
                            <input class="plus is-form" type="button" value="+">
                            <p class="px-3 py-2 m-0 text-secondary" style="font-size:14px;"><?php echo $sanpham['soluong']?> sản phẩm</p><br>
                        </div>
                    </div>
                    <div class="border border-1 rounded p-2 my-2">
                        <p><b>Mô tả : </b></p>
                        <p><?php echo $sanpham['mota'] ?></p>
                    </div>
                    <div class="pt-4">
                        <button class="themvao" type="submit" name="themvao" onclick="sendSuccess('<?php echo $sanpham['tensanpham'] ?>')">Thêm vào giỏ hàng</button>
                    </div>
                </form>

            </div>
        </div>
        <hr>
        <div class="row">
            <h3>Sản phẩm liên quan</h3>
            <div class="owl-carousel owl-theme lienquan">
                <?php   
                $where = "WHERE l.lsp_ten = '".$sanpham['lsp_ten']."'";
                $resultlq = mysqli_query($conn, "SELECT * FROM `sanpham` p INNER JOIN `loaisanpham` l ON p.lsp_ma = l.lsp_ma ".$where);
                while($rowlq = mysqli_fetch_array($resultlq)){?>
                    <div class="item">
                        <a href="view_sanpham.php?id_SP=<?php echo $rowlq['id_SP'] ?>">
                            <img src="hinh/<?php echo $rowlq['hinh']?>" alt="" class="img-fluid">
                            <p class="pt-2 m-0 text-dark"><?php echo $rowlq['tensanpham'] ?></p>
                        </a>
                        <p class="text-danger"><?php echo number_format($rowlq['gia']) ?>đ<del class="card-price-old"><?php echo $rowlq['giacu']?></del></p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <hr>
    </div>
</main>
<script>
    function myFunction(imgs) {
    // Get the expanded image
    var expandImg = document.getElementById("expandedImg");
    // Use the same src in the expanded image as the image being clicked on from the grid
    expandImg.src = imgs.src;    
    let dots = document.getElementsByClassName("demo");
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    this.className += "active_img"
    // Show the container element (hidden with CSS)
    expandImg.parentElement.style.display = "block";
    }
</script>
<script>
    $('.owl-carousel').owlCarousel({
    loop:false,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:3
        }
    }
})
</script>
<script>
    $('.lienquan').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
})
</script>
<script>
      function sendSuccess(ten){
        var getSelectedValue = document.querySelector( 'input[name="mausac[<?php echo $sanpham['id_SP']?>]"]:checked');
        alert(getSelectedValue);   
        if(getSelectedValue != '') {   
                confirm("Bạn muốn thêm '" + ten + "' vào giỏ hàng!");  
        }else {  
                confirm("Bạn chưa chọn màu sắc!");
        }
    }
</script>
<?php
include '../partials/footer.php';
?>