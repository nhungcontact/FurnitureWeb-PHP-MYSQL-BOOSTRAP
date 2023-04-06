<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php
        if(isset($_GET['url'])&& !empty($_GET['url'])){
            $url = $_GET['url'];
            unlink($url);
            ?>
        <div>
            <h1>Xóa ảnh thành công</h1>
            <a href="./index.php">Danh sách ảnh</a>
        </div>
        <?php } ?>
</body>
</html>