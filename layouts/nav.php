<?php $menu = get_menu(); ?>
<div class="list-group">
<?php
$path = explode('=',$_SERVER['REQUEST_URI']);
$p = explode('&',$path[1]);
foreach($menu as $k => $v){
    if($p[0]==urlencode($v)){
        $active = "active";
    }else{
        $active = "";
    }
    echo "
    <a href=\"index.php?folder=$v\" class=\"list-group-item {$active}\">$v</a>";
}

?>
</div>