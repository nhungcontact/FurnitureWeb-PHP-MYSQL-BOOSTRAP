<option value="" selected>Chọn quận huyện</option>
<?php include '../partials/mysqli_connect.php';
    $sql = mysqli_query($conn,"SELECT * FROM `quanhuyen` WHERE `id_tinh` = '".$_POST['idtinh']."' ");
        while($row_huyen = mysqli_fetch_array($sql)){
    ?>
        <option value="<?php echo $row_huyen['id_huyen'] ?>"><?php echo $row_huyen['ten_huyen'] ?></option>
    <?php } ?>
                