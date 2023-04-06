<?php
include '../partials/header.php';
?>
    <div class="breadcrumb_background_tt">
        <h1 class="title_bg">Tin tức</h1>
            <div class="overlay"></div>
    </div>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
                    <h2 class="pt-4">Tin tức</h2>
                    <?php 
                        $tintuc = mysqli_query($conn,"SELECT * FROM `tintuc` WHERE `trangthai`='1' AND `hienthi`='1' ");
                        while($row_tt=mysqli_fetch_array($tintuc)){
                        ?>
                        <div class="row py-4">
                            <div class="col-4 img-hover-zoom--1 img-hover-zoom--blur--1">
                                <a href="view_tintuc.php?id_tintuc=<?php echo $row_tt['id_tintuc']?>" class="blog-post-thumbnail" title="<?php echo $row_tt['tintuc'] ?>" rel="nofollow">
                                    <img class="lazyloaded" data-src="<?php echo $row_tt['hinhtintuc'] ?>" alt="<?php echo $row_tt['tintuc'] ?>" src="<?php echo $row_tt['hinhtintuc'] ?>" alt="<?php echo $row_tt['tintuc'] ?>">
                                </a>
                            </div>
                        
                            <div class="col-8">
                                <h3 class="blog-post-title">
                                    <a href="view_tintuc.php?id_tintuc=<?php echo $row_tt['id_tintuc']?>" title="<?php echo $row_tt['tintuc'] ?>"><?php echo $row_tt['tintuc'] ?></a>
                                </h3>
                                <div class="blog-post-meta">   
                                                <span class="author vcard">Người viết: <?php echo $row_tt['nguoiviet'] ?></span>
                                                <span class="date">                
                                                    <time pubdate="" datetime="<?php echo date('d.m.Y',$row_tt['ngaylap'])?>"><?php echo date('d.m.Y',$row_tt['ngaylap'])?></time>
                                                </span>
                                </div>
                                <p class="entry-content" style="text-overflow: ellipsis;
                                                                white-space: nowrap;
                                                                overflow: hidden;">
                                    <?php echo $row_tt['noidung']?>
                                </p>
                            </div>

                        </div>
                    <?php } ?>
                </div>
    
                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="news_latest">
                        <div class="sidebarblog-title">
                            <h3>Bài viết mới nhất</h3>
                        </div>
                        <ul>
                            <?php 
                            $tintucmoi = mysqli_query($conn,"SELECT * FROM `tintuc` WHERE `trangthai`='2'  AND `hienthi`='1'");
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