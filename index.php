<?php
include 'config.php';
session_start();
if($_SESSION['login'] == "OK") {
    if($_GET['action']=='del_folder'){
        $path_array = explode('/',$_GET['folder']);
        $del_folder = end($path_array);
        $new_path = "";
        foreach($path_array as $v){
            if($v != $del_folder and !empty($v)){
                $new_path .= "/".$v;
            }
        }
        rmdir('upload/'.$_GET['folder']);
        echo "<script>document.location.href=\"index.php?folder={$new_path}\";</script>";
        exit;

    }

    if($_GET['action']=='del_file'){
        unlink('upload/'.$_GET['folder']."/".$_GET['file']);
        echo "<script>document.location.href=\"index.php?folder={$_GET['folder']}\";</script>";
        exit;

    }

    if ($_POST['add_folder'] == "go") {
        if (!empty($_POST['folder_name'])) {
            mkdir('./upload/'.$_POST['set_folder'] .'/'. $_POST['folder_name']);
            $new_path = str_replace('#','',$_POST['set_folder']);
            echo "<script>document.location.href=\"index.php?folder={$new_path}\";</script>";

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
<!DOCTYPE html>
<html lang="zh-TW">
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

                        echo "路徑：<a href='index.php'>根目錄</a> ";
                        $pp= explode('/',$_GET['folder']);
                        if(is_array($pp) && !empty($pp)) {
                            foreach ( $pp as $v) {
                                if (!empty($v)) $p .= "/{$v}";
                                echo "<a href='index.php?folder={$p}'>{$v}</a> / ";
                            }
                        };

                        echo "
                        <table class=\"table table-light\">
                        <thead>
                            <tr>
                                <th>目錄 / 檔案</th>
                                <th>數量</th>
                                <th>修改時間</th>
                             </tr>
                        </thead>
                        <tbody>";

                        foreach($folders as $k=>$v){
                            $path = $open_folder.'/'.$v;
                            $num = get_num($open_folder.'/'.$v);
                            if($_SESSION['login'] == "OK"){
                                if($num == 0) {
                                    $del = "<a href='index.php?folder={$path}&action=del_folder' id='del_f{$v}' onclick=\"bbconfirm2('del_f{$v}','確定刪除目錄 {$v} ?')\"><i class='fas fa-minus-square text-danger'></i></a>";
                                }else{
                                    $del = "";
                                }
                            }
                            echo "<tr><td><a href=\"index.php?folder={$path}\"><i class='fa fa-folder text-warning'></i> {$v}</a> {$del}</td><td>{$num} 個項目</td><td>-</td></tr>";

                        }

                        foreach($files as $k=>$v){
                            if($_SESSION['login'] == "OK") {
                                $del = "<a href='index.php?folder={$_GET['folder']}&action=del_file&file={$v}' id='del_f2{$v}' onclick=\"bbconfirm2('del_f2{$v}','確定刪除檔案 {$v} ?')\"><i class='fas fa-minus-square text-danger'></i></a>";
                            }
                            $filesize = number_format(filesize('upload'.$_GET['folder'].'/'.$v) / pow(1024, 1), 2, '.', '');
                            $filetime = date ("Y-m-d H:i:s",filemtime('upload'.$_GET['folder'].'/'.$v));
                            echo "<tr><td><a href=\"show.php?folder={$_GET['folder']}&file={$v}\"><i class='fas fa-file text-info'></i> {$v}</a> {$del}</td><td>{$filesize} kB</td><td>{$filetime}</td></tr>";
                        }
                        echo "
                        </tbody>
                        </table>
                       
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