<?php
//自行更改
$admin = "admin";
$password = "demo1234";
$sitename = "Scratch2展示平台";
$footer = "Copyright &copy; xx國小 2018";



//以下勿改
function checkin(){
    session_start();
    if($_SESSION['login'] != "OK"){
        header("Location:login.php");
    }
}

function get_menu(){
    $i = 0;
    if ($handle = opendir('./upload')) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && substr($file,-4) != '.sb2' && substr($file,0,1) !=".") {
                $menu[$i] = $file;
                $i++;
            }
        }
        closedir($handle);
    }
    return $menu;
}

function get_files($folder){
    $i = 0;
    if ($handle = opendir('./upload/'.$folder)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && substr($file,-4) == '.sb2') {
                $files[$i] = $file;
                $i++;
            }
        }
        closedir($handle);
    }
    sort($files);
    return $files;
}

function get_folders($folder){
    $i = 0;
    if ($handle = opendir('./upload/'.$folder)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..' && is_dir('./upload/'.$folder.'/'.$file)) {
                $folders[$i] = $file;
                $i++;
            }
        }
        closedir($handle);
    }
    sort($folders);
    return $folders;
}

function get_num($folder){
    $i = 0;
    if ($handle = opendir('./upload/'.$folder)) {
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $i++;
            }
        }
        closedir($handle);
    }
    return $i;
}
?>