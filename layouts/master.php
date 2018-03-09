<!DOCTYPE html>
<html lang="zh-TW">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('page-title')</title>

    <?php include('layouts.header'); ?>

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <?php include('nav_top.php'); ?>
    </div>
</nav>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <div class="col-lg-3">
            <h3 class="my-4">你好 Hello</h3>
            <?php include('nav.php'); ?>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">

            <div class="card mt-4">
                <div class="card-body">

                </div>
            </div>
            <!-- /.card -->


            <!-- /.card -->

        </div>
        <!-- /.col-lg-9 -->

    </div>

</div>
<!-- /.container -->
<br>
<!-- Footer -->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">
            Copyright &copy; 彰化縣教育處學管科 2018
        </p>
    </div>
    <!-- /.container -->
</footer>

<?php include('layouts.footer'); ?>
<?php include('layouts.bootbox'); ?>
</body>

</html>