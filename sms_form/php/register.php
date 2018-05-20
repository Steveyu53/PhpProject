<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/13
 * Time: 15:11
 */
session_start();
date_default_timezone_set('PRC');
ini_set("display_errors", "on");

$v = $_SESSION['verifiedCode'];
$m = $_SESSION['mobile'];

$input_verifiedCode = $_POST['verifycode'];
$input_mobile = $_POST['mobile'];

if($v == $input_verifiedCode and $m == $input_mobile){
    //插入用户名到数据库
    $con = mysqli_connect("39.107.224.191","root","root");
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_select_db($con,"userdb");

    $username = $_POST['userid'];
    $password = $_POST['password'];
    $query = "INSERT INTO userInfo (username, password) VALUES ('$username', '$password')";
    mysqli_query($con, $query);
    mysqli_close($con);
?>
    <h1>添加成功！</h1>
    <a href='../form/login.php'>返回登录页面</a>
<?php }else{?>
    <h1>验证码错误！</h1>
    <a href='../form/register.html'>返回注册页面</a>
<?php }?>
