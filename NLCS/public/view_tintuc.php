<?php
include '../partials/header.php';
?>
<hr>
<main>
<?php 
    $tintuc = mysqli_query($conn,"SELECT * FROM `tintuc` WHERE `id_tintuc`='".$_GET['id_tintuc']."' ");
    $row_tt=mysqli_fetch_array($tintuc);
    $binhluan = mysqli_query($conn,"SELECT bl.* , `username` FROM `binhluan` bl INNER JOIN `users` u ON bl.`id`=u.`id` WHERE `id_tintuc`='".$_GET['id_tintuc']."' AND bl.`trangthai`='2' ");

    
    if(isset($_POST['guibl'])){
        if(isset($_SESSION['username'])){
            $id = mysqli_query($conn,"SELECT `id` FROM `users` WHERE `username`= '".$_SESSION['username']."' ");
            $id_user = mysqli_fetch_array($id);
            $noidung = $_POST['noidung'];
            $error = [];
            if(empty($noidung)){
                $error['noidung'] = "Lỗi: Bạn chưa viết bình luận!";
            }
            if(count($error)==0){
                // var_dump("INSERT INTO `binhluan`(`id`, `id_tintuc`, `binhluan`, `ngayviet`) VALUES ('".$id_user['id']."','".$_GET['id_tintuc']."','".$noidung."','".time()."')");
                $thembinhluan = mysqli_query($conn,"INSERT INTO `binhluan`(`id`, `id_tintuc`, `binhluan`, `ngayviet`) VALUES ('".$id_user['id']."','".$_GET['id_tintuc']."','".$noidung."','".time()."')");
                if($thembinhluan){
                    echo ' <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                    </symbol>
                    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                    </symbol>
                    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                    </symbol>
                    </svg>
                    <div class="alert alert-success d-flex alert-dismissible fade show" role="alert">
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>
                        Gửi bình luận thành công !
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
                }
            }
        }else{
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Không thể gửi bình luận! </strong>Bạn chưa đăng nhập tài khoản! <a class="alert-link" href="server.php?page=dangnhap">Đăng nhập tài khoản.</a>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'; 
        }
       
    }
?>
    <div class="container">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item" ><a style="color:#e74c3c;" href="tintuc.php">Tin tức</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo $row_tt['tintuc'] ?></li>
        </ol>
        </nav>
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                <img class="img-fluid" data-src="<?php echo $row_tt['hinhtintuc'] ?>" alt="<?php echo $row_tt['tintuc'] ?>" src="<?php echo $row_tt['hinhtintuc'] ?>" alt="<?php echo $row_tt['tintuc'] ?>">
                <h3 class="pt-4"><?php echo $row_tt['tintuc'] ?></h3>
                <div class="blog-post-meta">   
                    <span class="author vcard">Người viết: <?php echo $row_tt['nguoiviet'] ?></span>
                    <span class="date">                
                        <time pubdate="" datetime="<?php echo date('d.m.Y',$row_tt['ngaylap'])?>"><?php echo date('d.m.Y',$row_tt['ngaylap'])?></time>
                    </span>                 
                </div>
                <p class="entry-content" style="white-space: pre-line;">
                    <?php echo $row_tt['noidung']?>
                </p>
                <div class="bg-light rounded-3 px-3 py-4 mt-5 border">
                    <p><b>Viết bình luận ...</b><i class="fa-solid fa-pen"></i></p>
                    <form method="POST" enctype="multipart/form-data">
                        <textarea name="noidung" class="form-control mb-1" id="exampleFormControlTextarea1" rows="3" placeholder="Bình luận..."></textarea>
                        <span class="text-danger"><?php echo (isset($error['noidung']))?$error['noidung']:''?></span>
                        <p class="text-muted">Bình luận của bạn sẽ được duyệt trước khi đăng lên!</p>
                        <button type="submit" name="guibl" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
                <hr>
                <div>
                    <h5>Bình luận</h5>
                    <?php while($row_bl=mysqli_fetch_array($binhluan)){ ?>
                        <div class="border rounded-1 p-3 mb-3">
                            <b><?php echo $row_bl['username'] ?> <i class="fa-solid fa-angle-right"></i> </b><span class="text-muted" style="font-size:14px;"><?php echo date('d/m/Y',$row_bl['ngayviet'])?></span>
                            <p class="me-2"><?php echo $row_bl['binhluan'] ?></p>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                <div class="news_latest">
                    <div class="sidebarblog-title">
                        <h3>Bài viết mới nhất</h3>
                    </div>
                    <ul>
                        <?php 
                        $tintucmoi = mysqli_query($conn,"SELECT * FROM `tintuc` WHERE `trangthai`='2' AND `hienthi`='1' ");
                        while($row_tt=mysqli_fetch_array($tintucmoi)){
                        ?> 
                        <li class="news_title">
                            <div class="img_news">
                                <a href="view_tintuc.php?id_tintuc=<?php echo $row_tt['id_tintuc']?>" title="<?php echo $row_tt['tintuc'] ?>" rel="nofollow">
                                    <img class="col-12"  data-src="<?php echo $row_tt['hinhtintuc'] ?>" src="<?php echo $row_tt['hinhtintuc'] ?>" alt="<?php echo $row_tt['tintuc'] ?>">
                                </a>
                            </div>
                            <div class="content_news">
                                <h3 class="blog-post-title mt-2">
                                    <a href="view_tintuc.php?id_tintuc=<?php echo $row_tt['id_tintuc']?>" title="<?php echo $row_tt['tintuc'] ?>"><?php echo $row_tt['tintuc'] ?></a>
                                </h3>
                                <div class="blog-post-meta">   
                                    <span class="author vcard">Người viết: <?php echo $row_tt['nguoiviet'] ?></span>
                                    <span class="date">                
                                        <time pubdate="" datetime="<?php echo date('d.m.Y',$row_tt['ngaylap'])?>"><?php echo date('d.m.Y',$row_tt['ngaylap'])?></time>
                                    </span>
                                </div>
                            </div>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>

        
        
    </div>
</main>
<?php
include '../partials/footer.php';
?>