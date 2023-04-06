<?php

$item_per_page = !empty($_GET['per_page']) ? $_GET['per_page']: 9 ; //hien thi 1 trang 6 san pham
$current_page = !empty($_GET['page']) ? $_GET['page']: 1 ;  //trang hien tai
$offset = ($current_page - 1) * $item_per_page; //vi tri san pham hien thi

$products = mysqli_query($conn, "SELECT * from `products` ORDER BY id_SP ASC LIMIT " .$item_per_page." OFFSET ".$offset);
$totalRecords = mysqli_query($conn, "SELECT * from `products`");
$totalRecords = $totalRecords->num_rows; // lay so dong
$totalPages = ceil($totalRecords / $item_per_page); //tinh tong so trang(ceil là lam tron)
?>