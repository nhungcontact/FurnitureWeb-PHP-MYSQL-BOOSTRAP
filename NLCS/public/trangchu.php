<?php

include('../partials/header.php') ?>
    <!-- banner -->
    <div class="banner">
        <img src="hinh/slide_1.jpg" class="d-block w-100" alt="...">
    </div>
    <!-- main -->
    <div class="owl-carousel owl-theme owl-loaded py-3">
        <div class="owl-stage-outer">
            <div class="owl-stage">
                <div class="owl-item">
                    <img height="170px" src="hinh/banner1.jpg" alt="">
                    <div class="content">
                        <h5>Sofa hiện đại</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
                <div class="owl-item">
                    <img height="170px" src="hinh/banner2.jpg" alt="">
                    <div class="content">
                        <h5>Phòng khách tối giản</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
                <div class="owl-item">
                    <img height="170px" src="hinh/banner3.jpg" alt="">
                    <div class="content">
                        <h5>Phòng ngủ hài hòa</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
                <div class="owl-item">
                    <img height="170px" src="hinh/banner4.jpg" alt="">
                    <div class="content">
                        <h5>Giá đỡ tiện lợi</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
                <div class="owl-item">
                    <img height="170px" src="hinh/banner5.jpg" alt="">
                    <div class="content">
                        <h5>Bàn ăn sang trọng</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
                <div class="owl-item">
                    <img height="170px" src="hinh/banner6.jpg" alt="">
                    <div class="content">
                        <h5>Kệ sách nhỏ gọn</h3>
                        <a class="button" href="sanpham.php">Xem ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            var owl = $('.owl-carousel');
            owl.owlCarousel({
                items:4,
                loop:true,
                margin:10,
                autoplay:true,
                autoplayTimeout:1000,
                autoplayHoverPause:true
            });
            $('.play').on('click',function(){
                owl.trigger('play.owl.autoplay',[1000])
            })
            $('.stop').on('click',function(){
                owl.trigger('stop.owl.autoplay')
            })
});
    </script>

    <main >
    <img class="img-fluid" src="hinh/banner7.jpg" data-src="hinh/banner7.jpg" alt="Banner quảng cáo">

        <!-- san pham moi -->
        <div class="container">
            <div class="py-5">
                <h3 class="text-center">SẢN PHẨM MỚI VỀ</h3>
                <a href="sanpham.php" class="see_all">Xem tất cả >></a>
            </div>
            
            <div class="row justify-content-center">
                <?php 

                    $sanpham = mysqli_query($conn, "SELECT * FROM `sanpham` WHERE  ((id_SP>201 and id_SP < 210)) ORDER BY id_SP DESC");
                    foreach($sanpham as $key => $value): 
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 spm">
                    <div class="product-img">
                        <div>
                            <div class="product-sale"><span><?php echo $value['phantram']?></span></div>
                        </div>
                        <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>" class="change">
                            <img src="hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                            <img src="hinh/<?php echo $value['hinh1']?>" alt="" class="img-fluid img-top">
                        </a>
                    </div>
                    <div class="title_sp">
                        <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>"><?php echo $value['tensanpham']?></a>
                        <p><?php echo number_format($value['gia']) ?>đ <del class="card-price-old"><?php echo $value['giacu']?></del></p>
                    </div>
                </div>
                <?php endforeach ?>   
            </div>
            
        </div>
        <div class="row py-5 justify-content-center">
            <div class="col-4 img-hover-zoom img-hover-zoom--blur">
                <img class="img-fluid" src="https://nhaxinh.com/wp-content/uploads/2021/11/miami-01.png" alt="">
                <div class="caption_banner">
					<span class="subtitle">Thư giãn với</span>
					<h3>Sofa</h3>
					
					<a class="button" href="#">Mua ngay</a>
										
			    </div>
                <div class="overlay"></div>

            </div>
            <div class="col-4 img-hover-zoom img-hover-zoom--blur">
                <img class="img-fluid" src="	https://nhaxinh.com/wp-content/uploads/2021/10/phong-anmiami-xanh-new3.jpg" alt="">
                <div class="caption_banner">
					<span class="subtitle">Thiết kế hiện đại</span>
					<h3>Modern Furniture</h3>
					<a class="button" href="#">Mua ngay</a>
										
			    </div>
                <div class="overlay"></div>

            </div>
            <div class="col-4 img-hover-zoom img-hover-zoom--blur">
                <img class="img-fluid" src="	https://nhaxinh.com/wp-content/uploads/2022/03/sofa-du-bai-kieu-dang-hien-dai-mau-nau-tram.jpg" alt="">
                <div class="caption_banner">
					<span class="subtitle">Nội Thất Sang Trọng</span>
					<h3>Phong Cách Hoàng Gia</h3>
					
					<a class="button" href="#">Mua ngay</a>
										
			    </div>
                <div class="overlay"></div>

            </div>
            

        </div>
            <!-- San pham noi bat -->
        <div class="container">
            <div class="py-5">
                <h3 class="text-center">SẢN PHẨM BÁN CHẠY</h3>
                <a href="sanpham.php" class="see_all">Xem tất cả >></a>
            </div>
            <div class="row justify-content-center">
            <?php 

                $sanphamnb = mysqli_query($conn, "SELECT * FROM sanpham WHERE  ((id_SP>101 and id_SP < 110)) ORDER BY id_SP DESC");
                foreach($sanphamnb as $key => $value): 
            ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-6 spm">
                    <div class="product-img">
                        <div class="product-sale"><span><?php echo $value['phantram']?></span></div>
                        <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>" class="change">
                            <img src="hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                            <img src="hinh/<?php echo $value['hinh1']?>" alt="" class="img-fluid img-top">
                        </a>
                    </div>
                    <div class="title_sp">
                        <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>"><?php echo $value['tensanpham']?></a>
                        <p><?php echo number_format($value['gia']) ?>đ <del class="card-price-old"><?php echo $value['giacu']?></del></p>
                    </div>
                </div>
                <?php endforeach ?> 
            </div>
        </div>

        <div class="py-5 d-flex justify-content-center">
            <div class="img-hover-zoom-1 img-hover-zoom--blur-1">
                    <img  src="//bizweb.dktcdn.net/100/364/402/themes/857456/assets/banner.jpg?1650271997394" data-src="//bizweb.dktcdn.net/100/364/402/themes/857456/assets/banner.jpg?1650271997394" alt="Banner quảng cáo" data-was-processed="true">
            </div>
        </div>

            <!-- San pham hot -->
            <div class="container">
                <div class="py-5">
                    <h3 class="text-center">SẢN PHẨM GIẢM GIÁ</h3>
                    <a href="sanpham.php" class="see_all">Xem tất cả >></a>
                </div>
                <div class="row justify-content-center">
                <?php
                    $sanphamnb = mysqli_query($conn, "SELECT * FROM `sanpham` ORDER BY `phantram` DESC");
                    foreach($sanphamnb as $key => $value):
                        if($value['phantram']!=NULL){
                            if($key<8){?>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-6 spm">
                                <div class="product-img">
                                    <div class="product-sale"><span><?php echo $value['phantram']?></span></div>
                                    <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>" class="change">
                                        <img src="hinh/<?php echo $value['hinh']?>" alt="" class="img-fluid">
                                        <img src="hinh/<?php echo $value['hinh1']?>" alt="" class="img-fluid img-top">
                                    </a>
                                </div>
                                <div class="title_sp">
                                    <a href="view_sanpham.php?id_SP=<?= $value['id_SP'] ?>"><?php echo $value['tensanpham']?></a>
                                    <p><?php echo number_format($value['gia']) ?>đ <del class="card-price-old"><?php echo $value['giacu']?></del></p>
                                </div>
                            </div>
                            <?php } ?>
                        <?php } ?>
                    <?php endforeach ?> 
                </div>
        </div>
        
    </main>
<?php
    include '../partials/footer.php';
?>
