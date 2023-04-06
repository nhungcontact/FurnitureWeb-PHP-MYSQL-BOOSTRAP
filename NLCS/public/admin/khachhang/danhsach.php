<?php
                $tim = isset($_GET['search'])?$_GET['search']:"";
                if($tim){
                    $where = "WHERE `hoten` LIKE '%".$tim."%'";
                }
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 6 ; //hien thi 1 trang 6 san pham
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
                $offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi
                if($tim){
                    $donhang = mysqli_query($conn, "SELECT * from `donhang` INNER JOIN `chitietdonhang` ON donhang.id_DH=chitietdonhang.id_DH ".$where." ORDER BY id_DH ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `donhang` ".$where." ");
                }else{
                    $donhang = mysqli_query($conn, "SELECT * from `donhang` ORDER BY id_DH ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `donhang`");
                }

                $totalRecords = $totalRecords->num_rows; // lay so dong
                $totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)
                ?>
                
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Đơn hàng</li>
                    </ol>
                </nav>
                <hr>
                <h3 class="text-center py-3">Danh sách người dùng mua hàng</h3>
                <!-- tim kiem -->
                <form method="GET" class="w-25 d-flex">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                    <input class="form-control ms-2" type="text" name="search" placeholder="Nhập tên người nhận" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
                </form>              
                <div class="pt-2">
                    <table class="table table-bordered table-light">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Mã người dùng</th>
                                <th class="text-center align-middle">Mã đơn hàng</th>
                                <th class="text-center align-middle">Tên liên lạc</th>
                                <th class="text-center align-middle">Số điện thoại</th>
                                <th class="text-center align-middle">Địa chỉ</th>
                                <th class="text-center align-middle">Địa chỉ cụ thể</th>
                                <!-- <th class="text-center">Ghi chú</th> -->
                                
                            </tr>
                        </thead>
                        <?php 
                            while ($value = mysqli_fetch_array($donhang)) {
                                if($value['trangthai']==1){
                                    $tt = "Đang giao hàng";
                                }else{
                                    $tt = "Chưa giao hàng";
                                }
                        ?>
                        <tbody>
                            <tr>
                                <td class="col-1 align-middle text-center">
                                    <p><?php echo $value['id']?></p>
                                </td>  
                                <td class="col-1 align-middle text-center">
                                    <p><?php echo $value['id_DH']?></p>
                                </td>                            
                                <td class="col-3 align-middle text-center">
                                    <p><?php echo $value['hoten']?></p>                        
                                </td>
                                <td class="col-2 align-middle text-center">
                                    <p><?php echo $value['sdt'] ?></p>
                                </td>
                                <td class="col-3 align-middle text-center">
                                    <p><?php echo $value['tinh'] ," , ", $value['huyen'] ," , ", $value['xa'] ?></p>                        
                                </td>
                                <td class="col-3 align-middle text-center">
                                    <p><?php echo $value['diachi']?></p>                        
                                </td>
                            </tr>
                        </tbody>
                        <?php } ?>
                    </table>
                </div>
