<?php
include('db.php');
$db=new mysqli($daddr,$duser,$dpass,$dbase);
if(!$db){
    echo "ошибка";
}
$logres="";
session_start();
if(isset( $_POST['login']) && isset( $_POST['pass'])){
     
    $login=$_POST['login'];
    $password=$_POST['pass'];
    $res=$db->query("select * from autorization where login= '$login' and password= '$password' ");
    $res->data_seek(0); 
    $row = $res->fetch_array(MYSQLI_ASSOC); 
    if($row['login']!=$login){
        $logres="неправильный логин или пароль";
    }else{
        $_SESSION['login']=$login;
        $_SESSION['password']=$password;
        $_SESSION['selected']="";
        header("Location: select.html");
        //$logres="Добро пожаловать ".$login;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Chat web edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
   <header>
       <H1>Chat web edition</H1>
   </header> 
   <div id='frm'>
       <form action="index.php" method="post" id="login">
        Логин:  <input type="text" name="login" size="20"  maxlength="25"><br>
        Пароль: <input type="password" name="pass" size="20"  maxlength="25"><br>
        <input type="submit" value="Войти"><br>
       </form>
       <?php
       echo $logres;
       ?>
       <br>
       Нет аккаунта? <a href="register.php">Зарегестрироваться.</a><br>
   </div>
   <footer>
       <a href="">справка</a>
   </footer>
</body>
</html>