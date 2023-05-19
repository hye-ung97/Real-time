<?php

    session_start();
        
    $conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
    mysqli_set_charset($conn,'utf8');

    $Id=$_SESSION['id'];
    $selectcheck =$_POST['select'];
    
    if(sizeof($selectcheck)==""){
        echo "<script language='javascript'>alert('선택한 항목이 없습니다!!');history.back();</script>";
 }
 

 //반복실행하면서 체크된 것만 삭제
 for ($i=0; $i<sizeof($selectcheck); $i++){
        $sql = "DELETE from insertword WHERE id='$Id' and keyword='$selectcheck[$i]'";
        $res = mysqli_query($conn,$sql);
        $sql2 = "DELETE from alarm WHERE id='$Id' and keyword like '%$selectcheck[$i]%'";
        $res2 = mysqli_query($conn,$sql2);
    
 }
 echo "<script>location='keyword.php';</script>";
?>
