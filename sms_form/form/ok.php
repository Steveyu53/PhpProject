<?php
    session_start()
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <title>Title</title>

</head>
<body>
<h1>登陆成功！</h1>
<small>欢迎用户<?php echo $_SESSION['userid']; ?></small>
<a href="../php/logout.php">注销</a>

</div>
</body>
</html>
<script language="JavaScript" >

</script>