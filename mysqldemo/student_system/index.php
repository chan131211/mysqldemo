<?php
require 'db.func.php';
require 'tools.func.php';
$userName = getSession('name','students');
//查询数据库
//$_POST['searchName'] 不为空则查询搜索用户的数据，$_POST['searchName']为空则查询所有用户的数据
if (!empty($_POST['searchName'])){
    $sql = "SELECT name, info, face FROM student
            WHERE name = '{$_POST['searchName']}'";
    $result = query($sql);
}else {
    $sql = "SELECT name, info, face FROM student
            ORDER BY created_at DESC";
    $result = query($sql);
}
//遍历学生数据

//转账

//判断是否为post提交
if (!empty($_POST['transferName'])){
    //判断用户是否登陆，是则进行转账操作，否则进行登陆
    if (empty($userName)){
        header('location:login.php');
        exit;
    }
    //接收post提交的转账数据
    $transferName = htmlentities($_POST['transferName']);
    $money  = htmlentities($_POST['money']);
    //书写并执行sql语句
    $sql1 = "UPDATE student SET money = money+{$money}
             WHERE name = '$transferName'";
    $sql2 = "UPDATE student SET money = money-{$money}
             WHERE name = '$userName'";
    $result2 = executePDO($sql1,$sql2);
    //显示结果
    if ($result2){
        echo "<script>alert('转账成功')</script>";
    }else {
        echo "<script>alert('转账失败')</script>";
    }
}

require 'header.php';
?>

    <!--巨幕-->
    <div class="jumbotron masthead">
        <div class="container">
          <h1>学生转账管理系统</h1>
          <h2>实现学生转账功能</h2>
            <p class="masthead-button-links">
                <form class="form-inline" action="index.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" id="exampleInputName2" placeholder="输入搜索的用户名" name="searchName" value="">
                        <button class="btn btn-default" type="submit">搜索</button>
                        <?php if (!empty($userName)): ?>
                            <a href="logout.php"><button type="button" class="btn btn-primary btn-default" data-toggle="modal">  退出  </button></a>
                        <?php else: ?>
                        <a href="register.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  注册  </button></a>
                        <a href="login.php"><button type="button"  class="btn btn-primary btn-default" data-toggle="modal">  登录  </button></a>
                        <?php endif;?>
                    </div>
                </form>
            </p>
        </div>
    </div>
    <!--巨幕结束-->
    <!-- 模态框 -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <form class="form-inline" action="index.php" method="post" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">转账</h4>
                    </div>
                    <div class="modal-body">
                        <p>
                          收款人：
                          <select name="transferName" class="form-control">
                              <?php foreach ($result as $studentName): ?>
                            <option value="<?php echo $studentName['name']; ?>"><?php echo $studentName['name']; ?></option>
                              <?php endforeach; ?>
                          </select>
                        </p>
                        <br />
                        <p>转账金额：<input type="text" name="money" class="form-control" id="exampleInputEmail1" placeholder="请输入数字"> </p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="submit" id="submit" onclick="show(this)">确认转账</button>
                        <button type="reset" class="btn btn-default">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--模态框结束-->
    <div class="container projects">
        <div class="projects-header page-header">
            <h2>用户展示</h2>
            <p>将用户信息展示在页面中</p>
        </div>
        <!--信息展示-->
        <div class="row">
            <?php foreach ($result as $student): ?>
            <div class="col-lg-4">
                <img class="img-circle" src="<?php echo $student['face']; ?>" alt="无法显示" width="140" height="140">
                <h3><?php echo $student['name']; ?></h3>
                <p><?php echo $student['info'] ?></p>
                <div class="button">
                  <button type="button" class="btn btn-primary btn-default" data-toggle="modal" data-target="#myModal">  转账  </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php
require 'footer.php';
?>
