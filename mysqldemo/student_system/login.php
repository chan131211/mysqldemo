<?php

//1连接数据库
require 'db.func.php';
require 'tools.func.php';

//2.判断是否为post提交
if (!empty($_POST['name'])){
    //3.接收post数据
    $name = htmlentities($_POST['name']);
    $number = htmlentities($_POST['number']);
    //4.查询数据库，判断姓名和学号是否正确，正确则写入session
    $sql = "SELECT id, name, number 
            FROM student
            WHERE name = '$name'
            AND number = '$number'";
    $result = queryOne($sql);
    if ($result){
        setSession('students',['name' => $name, 'id' => $result['id']]);
        header('location:index.php');
    }else {
        setInfo('姓名或者学号错误');
    }
}
//5.显示结果
require 'header.php';
?>
    <!--登录框-->
    <!-- 登录页面 -->
    <div class="projects-header page-header" >
        <div style="margin-left: 600px;">
            <a href="index.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  首页  </button></a>
        </div>
        <h3>登录</h3>
        <a href="register.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  去注册  </button></a>
    </div>
    <!-- 登录框 -->
    <div class="row" >
        <div class="col-md-6 col-md-offset-3">
            <p><?php if (hasInfo()) echo getInfo(); ?></p>
            <form class="form-horizontal" action="login.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                    <div class="col-sm-10">
                        <input type="text"  class="form-control" placeholder="请输入姓名,字数不超过10位" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">学号</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" placeholder="请输入学号,数字不超过8位" name="number">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-default">登陆</button>
                        <button type="reset" class="btn btn-default">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
require 'footer.php';
?>