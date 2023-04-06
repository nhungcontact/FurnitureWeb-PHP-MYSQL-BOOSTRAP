
<div class="login_background row">
        <div class="col-6">
            <img src="hinh/slide_2.jpg" alt="" class="img-fluid m-5">
        </div>
        <div class="col-6">
            <form method="post" class="login_form">
                <h4 class="text-center">Đăng Nhập</h4>
                <div class="form-floating mb-4 mt-4">
                    <input class="form-control" type="text" name="username" id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput">Nhập tên đăng nhập/Email</label>
                    <span class="text-danger"><?php echo (isset($errors['username']))?$errors['username']:''?></span>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" type="password" name="password" id="floatingPassword" placeholder="Password">
                    <label for="floatingPassword">Nhập mật khẩu</label>
                    <span class="text-danger"><?php echo (isset($errors['password']))?$errors['password']:''?></span>
                </div>
                <!-- <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                        Nhớ mật khẩu
                    </label>
                </div> -->
                
                <div class="mb-2">
                    <button style="background-color: #e74c3c!important; color:#fff!important;" type="submit" class="btn col-12" name="login_user">Đăng Nhập</button>
                </div>
                
                <div class="row justify-content-between mb-2">
                    <div class="col-6">
                        <a style="font-size: 14px; color: #000084 !important;" href="quenmatkhau.php" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo">
                        Quên mật khẩu ?
                        </a>                    
                    </div>

                    <div class="col-6 text-end">
                        <a style="font-size: 14px; color: #000084 !important;" href="server.php?page=dangky">
                        Tạo tài khoản mới ?
                        </a>
                    </div>
                </div>
                <div class="">
                    <div class="line_or d-flex align-items-center pb-2">
                        <div class="line_1"></div>
                        <div class="or">HOẶC</div>
                        <div class="line_1"></div>
                    </div>
                    <div class="link_social d-flex flex-wrap justify-content-around">
                        <button class="d-flex justify-content-center align-items-center me-2">
                            <div class="_1a550J social-white-background social-white-fb-blue-png"></div>
                            <div class="text_social">Facebook</div>
                        </button>
                        <button class="d-flex justify-content-center align-items-center">
                            <div class="_1a550J social-white-background social-white-google-png"></div>
                            <div class="text_social">Google</div>
                        </button>
                    </div>
                </div>

            </form>

            <!-- form quên mật khẩu -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" style="z-index: 9000;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Quên mật khẩu ?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <?php 
                          if(isset($_POST['gui'])== true){
                            $email_quenmk = $_POST['email_quenmk'];
                            // $connect=new PDO("mysql:host=localhost;dbname=ct275_lab3;charset=utf8","root","");
                            // $connect->setAtrribute(PDO::AFTER_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            // $sql = "SELECT * FROM `users` where `email` = '?'";
                            // $stmt = $connect->prepare($sql); 
                            // $stmt -> execute( [$email_quenmk] );
                            // echo $count = $stmt->rowCount();
                          }
                        ?>
                        <form method="POST">
                            <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Email:</label>
                                        <input value="<?php if(isset($email_quenmk) == true ) echo $email_quenmk ?>" name="email_quenmk" type="email" class="form-control" id="recipient-name" >
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary" name="gui" value="nutgui">Gửi</button>
                            </div>  
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>