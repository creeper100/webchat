<?php
session_start();
if(isset($_POST['askdata'])){
    switch($_POST['askdata']){
        case(1):
        echo $_SESSION['login'];
        break;
        case(2):
        echo $_SESSION['password'];
        break;
        case(3):
        echo '<img src=\'avatars\\'.$_SESSION['login'].'.jpg\' wight=300 height=300>';
        break;
        case(4):
        if ($_FILES){
        move_uploaded_file($_FILES['file']['tmp_name'], 'avatars\\'.$_SESSION['login'].'.jpg');
        echo '<img src=\'avatars\\'.$_SESSION['login'].'.jpg\' wight=300 height=300>';
        }
        break;
    }
}
?>