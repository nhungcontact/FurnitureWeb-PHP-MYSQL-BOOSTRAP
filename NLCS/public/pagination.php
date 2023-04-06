
 <div class="d-flex justify-content-center py-3">

<?php
$pagelayout = isset($_GET['page_layout'])?$_GET['page_layout']:"";  
if($pagelayout=="danhsach"){
    $trang = "page_layout=danhsach&";
}
$tim = isset($_GET['search'])?$_GET['search']:"";
if($tim){
    $param = "search=".$tim."&";
}
$lsp_ma = isset($_GET['lsp_ma'])?$_GET['lsp_ma']:"";
if(!empty($lsp_ma)){
    $lsp = "lsp_ma=".$lsp_ma."&";
}

$orderField = isset($_GET['field'])?$_GET['field']:"";
$orderSort = isset($_GET['sort'])?$_GET['sort']:"";

if(!empty($orderField) && !empty($orderSort)){
    $sapxep = "field=".$orderField."&sort=".$orderSort."&";
}

    if($current_page > 2){
        $first_page = 1;
    ?>
    <div><a class="page_link" href="?<?php echo isset($trang)?$trang:"" ?><?php echo isset($lsp)?$lsp:""?><?php echo isset($sapxep)?$sapxep:""?><?php echo isset($param)?$param:""?>per_page=<?=$item_per_page?>&page=<?=$first_page?>" title="First"><i class="fa-solid fa-angle-left"></i></a></div>

<?php } 

    if($current_page > 1){
        $prev_page = $current_page - 1;
    ?>
    <div><a class="page_link" href="?<?php echo isset($trang)?$trang:"" ?><?php echo isset($lsp)?$lsp:""?><?php echo isset($sapxep)?$sapxep:""?><?php echo isset($param)?$param:""?>per_page=<?=$item_per_page?>&page=<?=$prev_page?>" title="Prev"><i class="fa-solid fa-angles-left"></i></a></div>
<?php } ?>

 <?php for ($num = 1; $num<= $totalPages; $num++){ ?>
    <?php if($num != $current_page){?>
        <?php if($num > $current_page -2 && $num < $current_page + 2){?>
            <div><a class="page_link" href="?<?php echo isset($trang)?$trang:"" ?><?php echo isset($lsp)?$lsp:""?><?php echo isset($sapxep)?$sapxep:""?><?php echo isset($param)?$param:""?>per_page=<?=$item_per_page?>&page=<?=$num?>"><?=$num?></a></div>
        <?php }?>  
    <?php }else{?>
        <div class="current_page"><a class=" page_link"><?=$num?></a></div>
    <?php } ?>
<?php } ?>

<?php 
if($current_page < $totalPages -1){
    $next_page = $current_page +1;?>
    <div><a class="page_link" href="?<?php echo isset($trang)?$trang:"" ?><?php echo isset($lsp)?$lsp:""?><?php echo isset($sapxep)?$sapxep:""?><?php echo isset($param)?$param:""?>per_page=<?=$item_per_page?>&page=<?=$next_page?>" title="Next" ><i class="fa-solid fa-angles-right"></i></a></div>
<?php }
    if($current_page < $totalPages - 2){
        $end_page = $totalPages;
    ?>
    <div><a class="page_link" href="?<?php echo isset($trang)?$trang:"" ?><?php echo isset($lsp)?$lsp:""?><?php echo isset($sapxep)?$sapxep:""?><?php echo isset($param)?$param:""?>per_page=<?=$item_per_page?>&page=<?=$end_page?>" title="Last"><i class="fa-solid fa-angle-right"></i></a></div>

<?php } ?>

</div>
