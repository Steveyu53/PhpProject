<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/13
 * Time: 16:43
 */
    session_start();
//    date_default_timezone_set('Etc/GMT-8');
//    if(isset($_POST['originator'])) {
//        if($_POST['originator'] != $_SESSION['code']){
//            echo "<script language='JavaScript'>alert('请不要刷新本页面或重复提交表单！')</script>";
//            return;
//        }
//    }

    $input_uid = $_POST['userid'];
    $input_passwd = $_POST['password'];

    if($input_uid=="" or $input_passwd=="")
    {
        header("location:../form/wrong.php");
        return;
    }

    $con = mysqli_connect("39.107.224.191","root","root");
    if (!$con)
    {
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_select_db($con,"userdb");
    $query = "SELECT password from userInfo WHERE username='$input_uid'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_row($result);
    if($input_passwd == $row[0]){
        $_SESSION['userid']=$input_uid;
        $_SESSION['password']=$input_passwd;
        setcookie("userid",$input_uid, time()+3600*0.005,'/PhpProject/sms_form/form');
        header("location:../form/ok.php");
     }else{
        header("location:../form/wrong.php");
    }
    mysqli_close($con);
?>
