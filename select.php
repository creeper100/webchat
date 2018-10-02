<?php
session_start();
if($_POST['op']!=0){
if(isset($_POST['selected'])){
    $slc=$_POST['selected'];
    $_SESSION['selected']=$slc;
    echo 1;
}
}else{
    include('db.php');
    $db=new mysqli($daddr,$duser,$dpass,$dbase);
   if(!$db){
       echo "ошибка";
   }
   $res=$db->query("select * from autorization");
   for($i=0;$i<$res->num_rows;$i++){
   $res->data_seek($i);
   $lgn=$res->fetch_assoc()['login'];
   $find=$_POST['find'];
   if(preg_match(".$find.",$lgn)){
   echo $lgn;
   echo "<button id='$lgn' class='usrs'>выбрать</button><br>";
   }
   }
}
?>
