<?php 

$showError = "false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include '../partials/dbconnect.php';   
   
    $email = $_POST['loginEmail'];
    $pass = $_POST['loginPass'];
    
    $existsql = "select * from `users` where `user_email` = '$email'";
    $result = mysqli_query($conn, $existsql);
    $numRows = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);
    $dno = $row['sno'];
    $acc_status = $row['acc_status'];
    
    if($numRows==1){
        if($acc_status=='Active'){
            while($row){
                if(password_verify($pass, $row['user_pass'] )){
                
                
                    $_SESSION['loggedin'] = true;
                    $_SESSION['useremail'] = $email;
                    $_SESSION['sno'] = $dno;
                    
                    echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/index.php?signinsuccess=true';</script>";
                    exit;
                }
                else{
                    $showError = "Password does not matched";
                    echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/admin/login.php?signinsuccess=false && error=$showError';</script>";
                    exit;
                }
            }
        }
        else{
            $showError = "Your Email Verification is not completed, <a href='http://fork/admin/_varification.emailsent.php?email=$email'>Visit to complete</a>";
            echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/admin/_varification.emailsent.php?email=$email';</script>";
            exit;
        }  

    }
    else{
            $showError = "Email not found!";
            echo "<script>window.location.href='https://spacestorepraxis.herokuapp.com/admin/signup.php?signinsuccess=false && error=$showError';</script>";
            exit;
        }   

}
?>