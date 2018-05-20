<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/5/14
 * Time: 0:01
 */
    session_start();
    session_unset();
    session_destroy();
    setcookie("userid", "", time() - 3600,'/');
    header("location:../form/login.php");
?>