<?php
    session_start();
        
    $conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
    mysqli_set_charset($conn,'utf8');

    // 2. 로그인 안한 회원은 로그인 페이지로 보내기
    if(!$_SESSION['id']){
        header('Location:real-login.php');
    }
    $Id=$_SESSION['id'];
    $Keyword=$_POST['keyword'];

    $sql2 ="SELECT * FROM insertword WHERE keyword='$Keyword' and id='$Id'";
    $res2 = mysqli_query($conn,$sql2);

    $row =$res2->fetch_array(MYSQLI_ASSOC);
    if($row['keyword']==$Keyword){
        echo "<script language='javascript'>";
        echo "alert('keyword가 중복되었습니다!!');";
        echo "history.back();";
        echo "</script>";
        return;
    }
    $time = date("Y-m-d H:i:s");
    $sql= "INSERT INTO insertword (id, keyword, time) VALUES ('".$Id."','".$Keyword."','".$time."')";
    $res = mysqli_query($conn,$sql);
    

    //  // 5. 첫 페이지로 보내기
      echo "<script>location='keyword.php';</script>";
?>