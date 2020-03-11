<?php
header('content-type:text/html;charset=utf-8');

//连接数据库,设置字符集
function connect()
{
    $dsn = "mysql:host=localhost;dbname=mysqldemo";
    $pdo = new PDO($dsn,'root','root');
    $pdo->exec('set names utf8');
    return $pdo;
}

//查询单条数据
function queryOne($sql)
{
    $pdo = connect();
    $stmt = $pdo->query($sql);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
}

//查询多条数据
function query($sql)
{
    $pdo = connect();
    $stmt = $pdo->query($sql);
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}

//修改更新删除数据
function execute($sql)
{
    $pdo = connect();
    $stmt =$pdo->exec($sql);
    return $stmt;
}

//PDO事务处理
function executePDO($sql1,$sql2)
{
    $pdo = connect();
    $pdo->beginTransaction();
    $val1 = $pdo->exec($sql1);
    $val2 = $pdo->exec($sql2);
    if ($val1 > 0 && $val2 > 0){
        $pdo->commit();
        return true;
    }else {
        $pdo->rollBack();
        return false;
    }
    $pdo->setAttribute(PDO::ATTR_AUTOCOMMIT,1);
}
