<?php
require 'db.func.php';
require 'tools.func.php';

//1.判断是否为post提交
if (!empty($_POST['name'])){
    //2.接收post数据
    $name = htmlentities($_POST['name']);
    $number = htmlentities($_POST['number']);
    $email  = htmlentities($_POST['email']);
    $money = htmlentities(($_POST['money']));
    $info = htmlentities($_POST['info']);

    //3.头像上传处理
    $imageName = $_FILES['face']['name'];
    $imageType = $_FILES['face']['type'];
    $imageTmpName = $_FILES['face']['tmp_name'];
    $imageError = $_FILES['face']['error'];
    $imageSize = $_FILES['face']['size'];
    $mimeWhiteList = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
    $extWhiteList = ['jpeg', 'jpg', 'png', 'gif'];
    $allowSize =  10*1024*1024;
    $destDir = './upload';

    if ($imageError > UPLOAD_ERR_OK){
        setInfo('文件上传失败');
    }
    if (!in_array($imageType,$mimeWhiteList)){
        setInfo('文件上传失败');
    }
    $ext = pathinfo($imageName,PATHINFO_EXTENSION);
    if (!in_array($ext,$extWhiteList)){
        setInfo('文件上传失败');
    }
    if ($imageSize > $allowSize){
        setInfo('文件上传失败');
    }
    $newImageName = uniqid().'.'.$ext;
    if (!file_exists($destDir)){
        mkdir($destDir,755,true);
    }
    if (is_uploaded_file($imageTmpName )){
        move_uploaded_file($imageTmpName,$destDir.'/'.$newImageName);
    }else {
        setInfo('文件上传失败');
    }
    $pathinfo = pathinfo($destDir.'/'.$newImageName);
    $dirname =  $pathinfo['dirname'];
    $basename = $pathinfo['basename'];
    $face = $dirname.'/'.$basename;

    //4.向数据库插入数据
    $sql = "INSERT INTO student( name, number, email, money, face, info)
            VALUES('$name', '$number', '$email', '$money', '$face', '$info')";
    $result = execute($sql);
    if ($result){
        $sql = "SELECT id FROM student
            WHERE number = '$number'";
        $result2 = queryOne($sql);
        if ($result2){
            setSession('students',['name'=> $name, 'id' => $result2['id']]);
            header('location:index.php');
        }
    }else {
        setInfo('注册失败');
    }
}
require 'header.php';
?>

    <!-- 注册页面 -->
    <div class="container projects">
        <div class="projects-header page-header" >
            <div style="margin-left: 600px;">
                <a href="index.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  首页  </button></a>
            </div>
            <h3>注册</h3>
            <a href="login.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  去登录  </button></a>

        </div>
        <!--注册框-->
        <div class="row" >
            <div class="col-md-6 col-md-offset-3">
                <p><?php if (hasInfo()) echo getInfo(); ?></p>
                <form class="form-horizontal" action="register.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" placeholder="请输入姓名">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">学号</label>
                        <div class="col-sm-10">
                            <input type="text" name="number" class="form-control" placeholder="请输入学号">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">邮箱</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" placeholder="请输入正确邮箱">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">金钱</label>
                        <div class="col-sm-10">
                            <input type="text" name="money" class="form-control" placeholder="请输入数字">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">头像</label>
                        <div class="col-sm-10">
                            <input type="file" name="face">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">个人简介</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="info" rows="2"  placeholder="不超过50字"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary btn-default">注册</button>
                            <button type="reset" class="btn btn-default">重置</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
require 'footer.php';
?>