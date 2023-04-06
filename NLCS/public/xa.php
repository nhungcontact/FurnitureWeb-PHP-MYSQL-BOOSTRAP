<option value="" selected>Chọn phường xã</option>
<?php include '../partials/mysqli_connect.php';
    $sql = mysqli_query($conn,"SELECT * FROM `phuongxa` WHERE `id_huyen` = '".$_POST['idhuyen']."' ");
        while($row_xa = mysqli_fetch_array($sql)){
    ?>
        <option value="<?php echo $row_xa['id_xa'] ?>"><?php echo $row_xa['ten_xa'] ?></option>
    <?php } ?>
                