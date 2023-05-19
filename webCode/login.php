<?php
    session_start();
    $conn=mysqli_connect("localhost","capruby07","fnql0707!","capruby07");
    mysqli_set_charset($conn,'utf8');
        
    $Id=$_POST['id'];
    $Password=$_POST['password'];
        
    $sql ="SELECT * FROM membership WHERE id='$Id'";
    // echo "<script>alert(\"".$sql."\");</script>";
    $result = $conn->query($sql);
    if($result-> num_rows==1){
        $row =$result->fetch_array(MYSQLI_ASSOC);
        if($row['password']==$Password){
            $_SESSION['id']=$Id;
            if(isset($_SESSION['id']))
            {
                header('Location:home.php');
            }
            else{
                echo "세션 저장 실패";
            }
        }
        else{
            echo "<script>alert('ID와 Password가 일치하지 않습니다'); history.back();</script>";
        }
    }else{
        echo "<script>alert('ID와 Password가 일치하지 않습니다'); history.back();</script>";
    }
    // mysqli_free_result(res);
    // mysqli_close($conn2);
?>