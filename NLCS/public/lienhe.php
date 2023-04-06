<?php
include '../partials/header.php';
?>
    <div class="breadcrumb_background_lh">
        <h1 class="title_bg">Liên hệ</h1>
        <div class="overlay"></div>
    </div>
    <!-- main -->
    
    <main>
    
        <div class="container">
            <div class="row py-3">
                <div class="col-md-4 col-sm-12 col-12 col-lg-4">
                    <ul class="lienhe">
                        <li>
                           <span>
                           <i class="fa-solid fa-location-dot"></i> 
                            Số nhà 123, đường số 1, phường Xuân Khánh, quận Ninh Kiều, thành phố Cần Thơ
                           </span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i> 
                            <a href="tel:19006777">1900 6777</a>
                        </li>
                        <li>
                           <i class="fa-solid fa-envelope"></i>
                            <a href="#">homes@company.vn</a>
                        </li>
                    </ul>
                  
                    <form class="pt-5" method="POST">
                        <h3 class="text-center">Liên hệ</h3>
                            <div class="mb-3">
                                <label for="exampleFormControlInput" class="form-label">Họ Tên</label>
                                <input type="text" name="hoten" class="form-control" id="exampleFormControlInput">
                                <span class="text-danger"><?php echo (isset($errors['hoten']))?$errors['hoten']:''?></span>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                                <span class="text-danger"><?php echo (isset($errors['email']))?$errors['email']:''?></span>
                            </div>

                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Nội dung</label>
                                <textarea class="form-control" name="noidung" id="exampleFormControlTextarea1" rows="3" ></textarea>
                                <span class="text-danger"><?php echo (isset($errors['noidung']))?$errors['noidung']:''?></span>
                            </div>

                            <div class="mb-3">
                                <button type="submit" name="btnlh" class="btn_lienhe">Gửi liên hệ</button>
                            </div>
                    </form>
                </div>
                <div class="col-md-8 col-sm-12 col-12 col-lg-8">
                    <div>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d62860.40218799748!2d105.7205707379525!3d10.035405683256487!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0883fbc944b83%3A0x77fc34233e5e1320!2zTmluaCBLaeG7gXUsIEPhuqduIFRoxqEsIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1661424958453!5m2!1svi!2s" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
    include '../partials/footer.php';
?>