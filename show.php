<!DOCTYPE html>
<html lang="zh-TW">
<?php
include 'config.php';
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $sitename; ?></title>
    <?php include './layouts/header.php'; ?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php include('./layouts/nav_top.php'); ?>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h1>作品欣賞<a href="#" class="btn btn-secondary" onclick="history.back()">返回</a></h1>
                    <?php
                        $page = $_GET['folder'];
                        $file = urldecode($_GET['file']);
                    ?>
                    <div>
                    路徑：<a href='index.php'>根目錄</a>
                    <?php
                    foreach(explode('/',$_GET['folder']) as $v){
                    if(!empty($v)) $p .= "/{$v}";
                    echo "<a href='index.php?folder={$p}'>{$v}</a> / ";
                    }
                    ?>
                    </div>
                    <div>
                    <object id="flashplayer" style="display: inline; visibility: visible; position: relative; z-index: 1000;" type="application/x-shockwave-flash" data="./img/Scratch.swf" height="643" width="800">
                        <param name="allowScriptAccess" value="sameDomain">
                        <param name="allowFullScreen" value="true">
                        <param name="flashvars" value="project=upload<?php echo $page; ?>/<?php echo $file; ?>&autostart=false">
                    </object>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">
            <?php echo $footer; ?>
        </p>
    </div>
</footer>
<?php include('./layouts/footer.php'); ?>
<?php include('./layouts/bootbox.php'); ?>
</body>
</html>