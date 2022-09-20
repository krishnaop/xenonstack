<?php
require('connection.php');
session_start();
#for login
if(isset($_POST['login']))
{
    $query="SELECT *FROM `register`WHERE `email`='$_POST[email_username]' OR`username`='$_POST[email_username]'";
    $result=mysqli_query($con,$query);

    if($result)
    {
        if(mysqli_num_rows($result)==1)
        {
            $result_fetch=mysqli_fetch_assoc($result);
            $_SESSION['logged_in']=true; 
            $_SESSION['username']=$result_fetch['username']; 
            header("location: index.php");
            
          
           
        }
        else
        {
            echo"<script> alert('Email or Username not registered'); window.location.href='index.php';</script>"; 
        }
    }
    else
    {
        echo"<script> alert('cannot run query'); window.location.href='index.php';</script>";   
    }
}







#for registration
if(isset($_POST['register'])){
    $user_exist_query="SELECT*FROM `register` WHERE `username`='$_POST[username]'OR `email`='$_POST[email]'";
    $result=mysqli_query($con,$user_exist_query);

    if($result)
    { 
        if(mysqli_num_rows($result)>0)
        {
           $result_fetch=mysqli_fetch_assoc($result);
           if($result_fetch['username']==$_POST['username']){
            echo"<script> alert('$result_fetch[username]-change username');
            window.location.href='index.php';
            </script>";
           }

        
            else
            {
            echo"<script> alert('$result_fetch[email]-change email');
            window.location.href='index.php';
            </script>";
            }


        }

    else{
        $password=password_hash($_POST['password'],PASSWORD_BCRYPT);
       $query="INSERT INTO `register`(`Full_Name`, `Username`, `email`, `Password`) VALUES ('$_POST[fullname]','$_POST[username]','$_POST[email]','$password')"; 
        if(mysqli_query($con,$query))
        {
            echo"<script> alert('registration successful'); window.location.href='index.php';</script>"; 
        }
        else
        {
            echo"<script> alert('cannot run query'); window.location.href='index.php';</script>"; 
        }
    }

}
else{
    echo"<script> alert('cannot run query'); window.location.href='index.php';</script>"; 
}
}

?>