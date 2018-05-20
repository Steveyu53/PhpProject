<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="form.css" rel="stylesheet" type="text/css">
    <title>登陆</title>
</head>
<?php
    session_start();
    date_default_timezone_set('PRC');
//    if(isset($_SESSION['userid'])){
//        echo $_SESSION['userid'],"您已经登陆了";
//    }else{
//        $code = mt_rand(0,1000000);
//        $_SESSION['code'] = $code;
    if(isset($_COOKIE['userid'])){
        echo $_COOKIE['userid'],"您已经登陆了";
    }else{
?>
<body>
<div class="container">
    <div class="row row-centered">
        <div class="well col-md-6 col-centered">
            <h2>欢迎登录</h2>
            <form action="../php/login.php" method="post" role="form">
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"
                                                                          aria-hidden="true"></i></span>
                    <input type="text" class="form-control" id="userid" name="userid" placeholder="请输入用户ID"
                           required="required"/>
                </div>
                <div class="input-group input-group-md">
                    <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
                    <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码"
                           required="required"/>
                </div>
                <input type="hidden" name="originator" value="<?=$code?>">
                <br/>
                <button type="submit" class="btn btn-success btn-block">登录</button>
                <button type="button" class="btn btn-default btn-block" onclick="register()">注册</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
<script language="JavaScript">
    function register() {
        window.location = './register.html'
    }
</script>
<?php
}
?>