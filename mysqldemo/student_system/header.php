<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
$name = getSession('name','students')
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>注册</title>
    <link href="style/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/css/site.min.css" rel="stylesheet">
</head>

<body>
<!--导航栏-->
<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <?php if (!empty($name)): ?>
            <a class="navbar-brand hidden-sm" href="index.php">慕课网 <?php echo $name ?>,欢迎您！</a>
            <?php else: ?>
            <a class="navbar-brand hidden-sm" href="index.php">慕课网</a>
            <?php endif;?>
        </div>
    </div>
</div>
<!--导航栏结束-->