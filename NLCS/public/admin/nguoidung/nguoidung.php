<?php
                $tim = isset($_GET['search'])?$_GET['search']:"";
                if($tim){
                    $where = "WHERE `username` LIKE '%".$tim."%'";
                }
                $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 6 ; //hien thi 1 trang 6 san pham
                $current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
                $offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi
                if($tim){
                    $user = mysqli_query($conn, "SELECT * from `users` ".$where." ORDER BY id ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * from `users` ".$where." ");
                }else{
                    $user = mysqli_query($conn, "SELECT * FROM `users` ORDER BY id ASC LIMIT " .$item_per_page." OFFSET ".$offset);
                    $totalRecords = mysqli_query($conn, "SELECT * FROM `users`");
                }

                $totalRecords = $totalRecords->num_rows; // lay so dong
                $totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)
                ?>
                
                <nav aria-label="breadcrumb" class="pt-3">
                    <ol class="breadcrumb ps-3">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Người dùng</li>
                    </ol>
                </nav>
                <hr>
                <h3 class="text-center py-3">Danh sách người dùng</h3>
                <!-- tim kiem -->
                <form method="GET" class="w-25 d-flex py-2">
                    <button class="btn btn-primary" type="submit">Tìm</button>
                    <input class="form-control ms-2" type="text" name="search" placeholder="Nhập tên người nhận" value="<?php echo isset($_GET['search'])?$_GET['search']:"" ?>">
                </form>               
                <span>Có tất cả <strong><?php echo $totalRecords ?></strong> người dùng </span>
                <div class="pt-2">
                    <table class="table table-bordered table-light table-sm">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">Mã người dùng</th>
                                <th class="text-center align-middle">Tên người dùng</th>
                                <th class="text-center align-middle">Giới tính</th>
                                <th class="text-center align-middle">Email</th>
                                <th class="text-center align-middle">Trạng thái</th>
                                <th class="text-center align-middle">Ngày lập</th>
                                <th class="text-center align-middle">Sửa trạng thái</th>
                                
                            </tr>
                        </thead>
                        <?php while ($value = mysqli_fetch_array($user)){?>
                            <tbody>
                                <tr>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo $value['id']?></p>
                                    </td>                            
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo $value['username']?></p>                        
                                    </td>
                                    <td class="col-1 align-middle text-center">
                                        <p><?php echo $value['gioitinh']?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo $value['email']?></p>                        
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <?php if($value['trangthai']==1){?>
                                            <p class="text-success">Kích hoạt</p>
                                        <?php }else {?>
                                            <p class="text-success">Block</p>
                                        <?php } ?>
                                    </td>
                                    <td class="col-2 align-middle text-center">
                                        <p><?php echo date('d/m/Y H:i',$value['ngaylap'])?></p>                        
                                    </td>
                                    <td class="col-1 align-middle text-center">
                                        <p><a href="inhoadon.php?id_DH=<?php echo $value['id']?>">In</a></p>
                                    </td>
                                </tr>
                            </tbody>
                        <?php } ?>
                    </table>
                </div>
