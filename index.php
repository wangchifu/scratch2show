<!DOCTYPE html>
<html lang="zh-TW">
<?php
include 'config.php';
session_start();
if($_SESSION['login'] == "OK") {
    if ($_POST['add_folder'] == "go") {
        if (!empty($_POST['folder_name'])) {

            mkdir('./upload/'.$_POST['set_folder'] .'/'. $_POST['folder_name']);
        }
    }

    if($_POST['add_file']=="go"){
        $num =  count($_FILES["files"]["name"]);
        for ( $i=0 ; $i<$num ; $i++ ) {
            $ext = end(explode(".", $_FILES["files"]["name"][$i]));
            if($ext == "sb2") {
                move_uploaded_file($_FILES["files"]["tmp_name"][$i], "./upload/" . $_POST['set_folder'] . "/" . $_FILES["files"]["name"][$i]);
            }
        }
    }
}
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="./fontawesome/css/fontawesome-all.css" rel="stylesheet">
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
        <!--
        <div class="col-lg-3">
            <h3 class="my-4">歡迎光臨</h3>
            <?php //include('./layouts/nav.php'); ?>
        </div>
        -->
        <div class="col-lg-12">
            <div class="card mt-4">
                <div class="card-body">
                    <h1>你好</h1>
                    <?php

                    if($_SESSION['login'] == "OK") {
                        $folder = (empty($_GET['folder'])) ? "根目錄" : $_GET['folder'];
                        $folder_array = explode('/',$_GET['folder']);
                        $this_folder = end($folder_array);
                        if(empty($this_folder)) $this_folder="根目錄";
                        echo "
                        <div class=\"card card-outline-secondary my-4\">
                        <div class=\"card-header\">
                            管理員新增
                        </div>
                        <div class=\"card-body\">
          
                                <table class=\"table table-light\">
                                    <thead>
                                    <tr>
                                        <th>
                                            放置目錄
                                        </th>
                                        <th>
                                            目錄 / 檔案
                                        </th>
                                        <th>
                                            動作
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <form class=\"form-horizontal\" method=\"POST\" id=\"folder\" enctype='multipart/form-data' onsubmit=\"return false;\">
                                    <tr>
                                        <td>
                                        {$this_folder}
                                        <input type='hidden' name='set_folder' value='{$_GET['folder']}'>
                                        </td>
                                        <td>
                                         <input type='text' name='folder_name' placeholder='目錄名稱' class=\"form-control\">
                                        </td>
                                        <td>
                                         <a href=\"#\" class=\"btn btn-success\" onclick=\"bbconfirm('folder','確定要新增目錄？')\"><i class='fas fa-folder'></i> 新增目錄</a>
                                        </td>
                                    </tr>
                                    <input type=\"hidden\" name=\"add_folder\" value=\"go\">
                                    </form>
                                    <form class=\"form-horizontal\" method=\"POST\" id=\"file\" enctype='multipart/form-data' onsubmit=\"return false;\">
                                    <tr>                                  
                                        <td>
                                            {$this_folder}
                                            <input type='hidden' name='set_folder' value='{$_GET['folder']}'>
                                        </td>
                                        <td>
                                            <input type=\"file\" name=\"files[]\" class=\"form-control\" required multiple=\"multiple\">
                                        </td>
                                        <td>
                                            <a href=\"#\" class=\"btn btn-success\" onclick=\"bbconfirm('file','確定要新增檔案？')\"><i class='fas fa-file'></i> 新增檔案</a>
                                        </td>
                                    </tr>
                                
                                    <input type=\"hidden\" name=\"add_file\" value=\"go\">
                                    </form>
                                    </tbody>
                                </table>
                                
                            
                        </div>                                               
                    </div>
                    
                        ";
                    }

                    if(!empty($_GET['folder'])){
                        $open_folder = $_GET['folder'];
                    }else{
                        $open_folder = null;
                    }
                        $folders = get_folders($open_folder);
                        $files = get_files($open_folder);
                        echo "                     
                        <div class=\"card card-outline-secondary my-4\">
                        <div class=\"card-header\">
                            路徑：<a href='index.php'>根目錄</a> ";
                        foreach(explode('/',$_GET['folder']) as $v){
                            if(!empty($v)) $p .= "/{$v}";
                            echo "<a href='index.php?folder={$p}'>{$v}</a> / ";
                        }
                        echo "
                        </div>
                        <div class=\"card-body\">
                        ";
                        foreach($folders as $k=>$v){
                            $path = $open_folder.'/'.$v;
                            echo "<a href=\"index.php?folder={$path}\" class='list-group-item'><i class='fa fa-folder text-warning'></i> {$v}</a>";
                        }

                        foreach($files as $k=>$v){
                            echo "<a href=\"show.php?folder={$_GET['folder']}&file={$v}\" class='list-group-item'><i class='fas fa-file text-info'></i> {$v}</a>";
                        }
                        echo "
                        </div>
                        </div>
                        ";

                    ?>
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