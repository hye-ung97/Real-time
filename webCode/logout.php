<?php
    session_start();
    $res = session_destroy();
    if($res){
        header("Location:real-login.php");
    }
?>