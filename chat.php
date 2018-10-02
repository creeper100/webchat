<?php
/*
<form action="chat.php" method="post" id="input">
<textarea name="enter" cols="20" rows="1" wrap="off"> </textarea> 
<input type="submit" value="Отправить"><br>
</form>
*/
function update($ress){
    $history="";
    for($r=0;$r<$ress->num_rows;$r++){
        $ress->data_seek($r); 
        $history=$history.$ress->fetch_assoc()['log']."<br>";
    } 
    return $history;
}
session_start();
include('db.php');
$db=new mysqli($daddr,$duser,$dpass,$dbase);
if(!$db){
    echo "ошибка";
}
//
//update
//
    if($_POST['op']==1){
    if($_POST['frst']==1){
    $dname=$_SESSION['login'].$_SESSION['selected'];
    $res=$db->query("select * from ".$dname);
    $ress=$db->query("select * from ".$_SESSION['selected'].$_SESSION['login']);
    if(!$res){
        if(!$ress){
            $_SESSION['db']=$dname;
            $res=$db->query("create table $dname (log varchar (128))engine $engine");
        }else{
        $dname=$_SESSION['selected'].$_SESSION['login'];
        $_SESSION['db']=$_SESSION['selected'].$_SESSION['login'];
        $history=update($ress);
    }
    }else{
        $_SESSION['db']=$_SESSION['login'].$_SESSION['selected'];
       $history=update($res);
    }
    echo $history;
}else{
    $history=update($db->query("select * from ".$_SESSION['db']));
    echo $history;
}
}
//
//new message
//
if(isset($_POST['enter'])){
    $dname=$_SESSION['db'];
    $add=$_SESSION['login'].": ";
    switch($_POST['enter']){
        case "smile_funny":
        $add=$add.'<img src="smiles/smile.jpg" wight=10 height=10>';
        break;
        default:
    $add=$add.$_POST['enter'];
    break;
    }
    $res=$db->query("insert into ".$dname." values('$add')");
    echo $db->error;
    echo $add;
}
?>
