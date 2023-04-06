
<?php
ob_start();
include '../partials/header.php';

$username = "";
$email    = "";
$errors = [];
$name = "";
$sdt = "";
$diachi ="";

// Registration code
if (isset($_POST['reg_user'])) {
    
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $gender = isset($_POST['gender']) ? $_POST['gender'] : 0;
    $password_1 = mysqli_real_escape_string($conn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn, $_POST['password_2']);
    // Ensuring that the user has not left any input field blank
    // error messages will be displayed for every blank input
    if (empty($username)) { 
        $errors['username'] = "Lỗi: Bạn chưa nhập tên đăng nhập!"; 
    }
    if (empty($email)) { 
        $errors['email'] = "Lỗi: Bạn chưa nhập email đăng nhập!"; 
    }
    if (empty($gender)) { 
        $errors['gender'] = "Lỗi: Bạn chưa chọn giới tính!"; 
    }
    if (empty($password_1)) { 
        $errors['password_1'] = "Lỗi: Bạn chưa nhập mật khẩu đăng nhập!"; 
    }
    if (empty($password_2)) { 
        $errors['password_2'] = "Lỗi: Bạn chưa nhập mật khẩu đăng nhập!"; 
    }
   
    // nhap ten
    $sqlname = "SELECT * FROM users WHERE username = '$username'";
    $resultname = mysqli_query($conn, $sqlname);
    
    if (mysqli_num_rows($resultname) > 0){
        $errors['username'] = "Lỗi: Tên đăng nhập này đã có người dùng!";
    }
    $sqlemail = "SELECT * FROM users WHERE email = '$email'";
    $resultemail = mysqli_query($conn, $sqlemail);
    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là email đã tồn tại trong CSDL
    if (mysqli_num_rows($resultemail) > 0){
        $errors['email'] = "Lỗi: Email này đã có người dùng!";
    }

    //KIEM TRA MAT KHAU CO TRUNG KHOP KHONG?
    if ($password_1 != $password_2) {
        $errors['password_2'] = "Lỗi: Mật khẩu không trùng khớp";
        // Checking if the passwords match
    }
  
    // If the form is error free, then register the user
    if (count($errors) == 0) {
        // Password encryption to increase data security (ma hoa mat khau)
        $password = md5($password_1);
         
        // Inserting data into table
       
        // $query = "INSERT INTO `users`(`username`, `gioitinh`, `email`, `password`) 
        //                     VALUES ('$username','$gender','$email','$password')";
        $query = " INSERT INTO `users`( `username`, `gioitinh`, `email`, `password`, `trangthai`, `ngaylap`) 
                    VALUES ('$username','$gender','$email','$password',1,'".time()."')";
        mysqli_query($conn, $query);
       
        // Storing username of the logged in user,
        // in the session variable
        $_SESSION['username'] = $username;
         
        // Page on which the user will be
        // redirected after logging in
        header('location: trangchu.php');
    }
}

// Dang nhap
if (isset($_POST['login_user'])) {
     
    // Data sanitization to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    // Error message if the input field is left blank
    if (empty($username)) {
        $errors['username'] = "Lỗi: Bạn chưa nhập tên đăng nhập!";
    }
    if (empty($password)) {
        $errors['password'] = "Lỗi: Bạn chưa nhập mật khẩu!";
    }
    
    
    // Checking for the errors
    if (count($errors) == 0) {
         
        // Password matching
        $password = md5($password);
         
        $query = "SELECT * FROM `users` WHERE `username` =
                '$username' OR `email`= '$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        $tendangnhap = mysqli_fetch_array($results);
        // $results = 1 means that one user with the
        // entered username exists
        if (mysqli_num_rows($results) == 1) {
             
            // Storing username in session variable
            $_SESSION['username'] = $tendangnhap['username'];
            // Page on which the user is sent
            // to after logging in
            header('location: trangchu.php');
        }else{
            // If the username and password doesn't match
            $errors['username'] ="Lỗi: Tên đăng nhập/Email không chính xác";
            $errors['password']="Lỗi: Mật khẩu không chính xác";
        }
    }
}
?>
 <?php 
    if(isset($_GET['page'])){
        switch ($_GET['page']){
            case 'dangky':
                require_once '../public/register.php';
                break;
            case 'dangnhap':
                require_once '../public/login.php';
                break;
            case 'diachi':
                require_once '../public/thongtinDC.php';
                break;
            default:
                require_once '../public/dangky.php';
                break;
        }
    }else{
        require_once '../public/dangky.php';
    }
?>
<?php 
include '../partials/footer.php';
?>