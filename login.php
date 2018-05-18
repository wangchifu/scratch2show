<?php
include 'config.php';
if($_REQUEST['send'] == "go"){
    if($admin == $_REQUEST['admin'] and $password == $_REQUEST['password']){
        session_start();
        $_SESSION['login'] = "OK";
        header("Location:index.php");
        echo $_SESSION['login'];
        die();
    }else{
        $error = "帳號或密碼錯誤！";
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
        <div class="col-lg-3">
            <h3 class="my-4">歡迎光臨</h3>
        </div>
        <div class="col-lg-4">
        </div>
        <div class="col-lg-4">
            <div class="card mt-4">
                <div class="card-body">
                    <h1>登入</h1>
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">
                            Login
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal" method="POST">
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input id="username" type="text" class="form-control" name="admin" value="" autofocus required placeholder="請輸入帳號">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="請輸入密碼">
                                        <span class="help-block">
                                        <strong class="text-danger"><?php echo $error; ?></strong>
                                    </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success col-md-12">
                                            送出
                                        </button>
                                    </div>
                                </div>
                                <input type="hidden" name="send" value="go">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
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