
    <?php
        if(isset($_POST['capnhat'])){
            $trangthai = $_POST['trangthai'];
            $error=[];
            if(empty($trangthai)){
                $error['trangthai']="Lỗi: Bạn chưa chọn trạng thái";
            }
            $capnhat_dh = mysqli_query($conn,"UPDATE `donhang` SET `trangthai`='".$trangthai."' WHERE id_DH= '".$_GET['id_DH']."' ");
            
            if($capnhat_dh){
                echo '<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
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
                    Cập nhật trạng thái thành công ! <a href="admin.php?page_layout=donhang">Quay về</a>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    $tatca = mysqli_query($conn, "SELECT p.tensanpham,p.gia, ct.*,d.* FROM `donhang` d INNER JOIN `chitietdonhang` ct ON d.id_DH = ct.id_DH INNER JOIN `sanpham` p ON p.id_SP=ct.id_SP WHERE d.id_DH= '".$_GET['id_DH']."' ");
    $totalRecords = $tatca->num_rows;
    
    ?>
<!-- 
    <div class="align-middle border border-4 border-dark p-1 w-50 chitiet">
        <div class="border border-dark py-2">
            <h3 class="text-center">Chi tiết đơn hàng</h3>
            <hr>
            <div class="px-3 m-3">
                <p class="border-bottom">Thông tin liên lạc</p>
                <label><b>Tên người nhận : </b></label> <span><?php echo $row['0']['hoten']?></span><br/>
                <label><b>Số điện thoại : </b></label> <span><?php echo $row['0']['sdt']?></span><br/>
                <label><b>Địa chỉ liên lạc :</b> <span><?php echo $row['0']['xa'],", ", $row['0']['huyen'],", ", $row['0']['tinh'] ?></span></label><br/>
                <label><b>Địa chỉ cụ thể : </b></label> <span><?php echo $row['0']['diachi']?></span><br/>
            </div>
            <hr>
            <div class="px-3 m-3">
                <p class="border-bottom">Thông tin đơn hàng</p>
                <?php
                    $tongsoluong = 0;
                    foreach ($row as $key => $row_ct){ ?>                        
                        <label>Sản phẩm <?php echo $key+1 ?>:</label><br/>
                        <label><b>Tên sản phẩm : </b></label> <span><?php echo $row_ct['tensanpham']?></span><br/>
                        <label><b>Giá sản phẩm : </b></label> <span><?php echo $row_ct['gia']?></span><br/>
                        <label><b>Số lượng mua : </b></label> <span><?php echo $row_ct['soluong']?></span><br/>
                    <?php 
                    
                
                    } ?>
            </div>
            
        </div>
    </div> -->
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb ps-3">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item" aria-current="page"><a href="admin.php?page_layout=donhang">Đơn hàng</a></li>
            <li class="breadcrumb-item active" aria-current="page">Chi tiết đơn hàng</li>
        </ol>
    </nav>
    <hr>
    <h3 class="text-center py-3">Danh sách của đơn hàng <b> mã <?php echo $_GET['id_DH'] ?></b></h3>
    <!-- tim kiem -->
    <form method="GET" class="w-25 d-flex">
        <button class="btn btn-primary" type="submit">Tìm</button>
        <input class="form-control ms-2" type="text" name="search" placeholder="Nhập tên người nhận" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
    </form>
    <div class="pt-2">
    <span>Có tất cả <strong><?php echo $totalRecords ?></strong> sản phẩm </span>
    </div>
    <form class="py-3" method="POST">
        <table class="table table-bordered table-light ">
            <thead>
                <tr>
                    <th class="text-center align-middle">STT</th>
                    <th class="text-center align-middle">Tên sản phẩm</th>
                    <th class="text-center align-middle">Màu sắc</th>
                    <th class="text-center align-middle">Số lượng</th>
                    <th class="text-center align-middle">Giá</th>
                    <th class="text-center align-middle">Tổng tiền</th>
                    <th class="text-center align-middle">Ngày đặt</th>
                </tr>
            </thead>
            <?php
                $i = 1 ;
                while ($value = mysqli_fetch_assoc($tatca)){
                ?>
                <tbody>
                    <tr>
                        <td class="col-1 align-middle text-center">
                            <p><?php echo $i++ ?></p>
                        </td>                            
                        <td class="col-2 align-middle text-center">
                            <p><?php echo $value['tensanpham']?></p>                        
                        </td>
                        <td class="col-2 align-middle text-center">
                            <p><?php echo $value['mausac']?></p>                        
                        </td>
                        <td class="col-1 align-middle text-center">
                            <p><?php echo $value['soluong']?></p>                        
                        </td>
                        <td class="col-2 align-middle text-center">
                            <p><?php echo number_format($value['gia']) ?></p>                        
                        </td>
                        <td class="col-2 align-middle text-center">
                            <p><?php echo number_format($value['gia']*$value['soluong']) ?></p>                        
                        </td>
                        <td class="col-2 align-middle text-center">
                            <p><?php echo date('d/m/Y H:i',$value['ngaylap'])?></p>                        
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
        <div class="d-flex">
            <label for="inputState" class="col-form-label pe-3"><b>Trạng thái: </b></label>
            <select name="trangthai" class="form-select w-25" id="floatingSelectGrid" aria-label="Floating label select example">
                <option value="1" >Đang giao hàng</option>
                <option value="0" >Đã giao hàng</option>
                <option value="2" >Hủy</option>
            </select>
        </div>
        <div class="d-flex justify-content-end">
            <a href="admin.php?page_layout=donhang"><button type="button" class="btn btn-danger me-2"><i class="fa-solid fa-chevron-left me-1"></i>Quay về</button></a>
            <button type="submit" name="capnhat" class="btn btn-success me-2" >Cập nhật</button>
        </div>
    </form>