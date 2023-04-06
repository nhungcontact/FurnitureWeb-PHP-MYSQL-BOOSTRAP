
    <div class="login_background row">
        <div class="col-6">
            <img src="hinh/slide_2.jpg" alt="" class="img-fluid m-5">
        </div>
        <div class="col-6">
            <form method="post" class="login_form">
                <h4 class="text-center">Đăng Ký</h4>
                <div class="form-floating mb-4 mt-4">
                    <input class="form-control" type="text" name="username" id="floatingInput1"
                        value="<?php echo isset($username)?$username:""; ?>" placeholder="name@123">
                    <label for="floatingInput">Nhập tên đăng nhập</label>
                    <span class="text-danger"><?php echo (isset($errors['username']))?$errors['username']:''?></span>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" type="email" name="email" id="floatingInput1"
                        value="<?php echo isset($email)?$email:""; ?>" placeholder="name@example.com">
                    <label for="floatingInput">Nhập email</label>
                    <span class="text-danger"><?php echo (isset($errors['email']))?$errors['email']:''?></span>
                </div>
                <div class="mb-3">
                    <div class="d-flex align-items-baseline">
                        <p class="pe-4">Giới tính : </p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Nam">
                            <label class="form-check-label" for="inlineRadio1">Nam</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Nữ">
                            <label class="form-check-label" for="inlineRadio2">Nữ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Khác">
                            <label class="form-check-label" for="inlineRadio2">Khác</label>
                        </div>
                    </div>
                    <span class="text-danger"><?php echo (isset($errors['gender']))?$errors['gender']:''?></span>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" type="password" name="password_1" id="floatingInput1"
                        value="<?php echo isset($password_1)?$password_1:""; ?>" placeholder="mật khẩu">
                    <label for="floatingInput">Nhập mật khẩu</label>
                    <span class="text-danger"><?php echo (isset($errors['password_1']))?$errors['password_1']:''?></span>
                </div>
                <div class="form-floating mb-4">
                    <input class="form-control" type="password" name="password_2" id="floatingInput1"
                        value="<?php echo isset($password_2)?$password_2:""; ?>" placeholder="mật khẩu">
                    <label for="floatingInput">Nhập lại mật khẩu</label>
                    <span class="text-danger"><?php echo (isset($errors['password_2']))?$errors['password_2']:''?></span>
                </div>
                <p>
                Đã có tài khoản?
                    <a href="server.php?page=dangnhap">
                        Đăng Nhập!
                    </a>
                </p>
                <div class="d-grid gap-2 d-flex justify-content-end">
                    <button type="reset" class="btn btn-primary" name="reg_user">
                        Hủy
                    </button>
                    <button type="submit" class="btn btn-primary"
                                        name="reg_user">
                        Đăng Ký
                    </button>
                </div> 
            </form>
        </div>
    </div>