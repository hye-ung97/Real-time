
<?php
    session_start();
    
    $conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
    mysqli_set_charset($conn,'utf8');

    // 2. 로그인 안한 회원은 로그인 페이지로 보내기
    if(!$_SESSION['id']){
        header('Location:real-login.php');
    }

    $Id=$_SESSION['id'];
    $Password=$_POST['password'];
    $Email=$_POST['email'];

     // 4. 회원정보 적기
    $sql = "update membership set password= '".$Password."', email = '".$Email."' where id = '".$Id."'";
    $res = mysqli_query($conn,$sql);

    //  // 5. 첫 페이지로 보내기
    echo "<script>location='mypage.php';</script>";

?>