<?php session_start(); ?>
<img src="./img/cat-a.png" width="30"><a class="navbar-brand" href="index.php"><?php echo $sitename; ?></a>
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-item" href="#">
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <li class="nav-item">
            <?php
                if($_SESSION['login'] == "OK"){
                    echo "<a href=\"#\" class=\"nav-link\" onclick=\"bbconfirm('logout-form','真的要離開了嗎？')\">[ 登出 ]</a>
                         <form id=\"logout-form\" action=\"logout.php\" method=\"POST\" style=\"display: none;\" onsubmit='return false;'>                        
                         </form>
                         ";
                }else{
                    echo "
                    <a href=\"login.php\" class=\"nav-link\">[ 登入 ]</a>
                    ";
                }
            ?>
        </li>
    </ul>
</div>