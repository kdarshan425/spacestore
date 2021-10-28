<?php
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    header("Location: https://spacestorepraxis.herokuapp.com/index.php?resumeadmin=true"); 
}
else{
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../img/urllogo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN | PCCOE BLOGSPOT</title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="icon" href="../img/pccoe.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Archivo:wght@300&family=Orbitron:wght@500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        .admin{
    height:100%;
    width:100%;
    display:flex;
    text-align:center;
    vertical-align:center;
    justify-content:center;
}

.inneradmin{
    padding:100px 30px 30px 30px;
}

@media screen and (max-width: 800px) {
    .inneradmin{
    padding:130px 30px 30px 30px;
}
}

.input-field {
  max-width: 380px;
  width: 100%;
  margin: 10px ;
  height: 35px;
  border-radius: 0px;  
  grid-template-columns: 15% 85%;
  padding: 0 0.4rem;
  position: relative;
}
.input-field input::placeholder {
  color: #aaa;
  font-weight: bold;
}

.input-field {
    max-width: 380px;
    width: 100%;
    margin: 10px 0;
    height: 35px;
    border-radius: 0px;
    grid-template-columns: 15% 85%;
    padding: 0 0.4rem;
    position: relative;
    font-weight: bold;
}
.forum-btn{
  position: relative;
  border: 0px solid;
  border-radius: 0px;
  padding: 0rem 0rem;
  font-size: 1rem;
  font-weight: 500;
  letter-spacing: 0.25px;
  line-height: 3.5rem;
  cursor: pointer;
  overflow: hidden;
  width: 100px;
  font-family: 'Orbitron', sans-serif;
}


.forum-btn.btn-f{
  background-color:#6c63ff;
  color: white;
  width: 100px;
  
  transition: ease-in-out 1s !important;
}

.forum-btn.btn-f:hover{
  background-color:#6c63ff;
  color: white;
 
  text-decoration: none;
  
}

.prompt{
            font-family: 'Prompt', sans-serif;
        }

        .raleway{
            font-family: 'Raleway', sans-serif;
        }
    </style>
</head>
<body>
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
                    session_start();
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
            $showError = "Your Email Verification is not completed, <a href='https://spacestorepraxis.herokuapp.com/admin/_varification.emailsent.php?email=$email'>Visit to complete</a>";
            echo "<script>window.location.href='/fork/admin/_varification.emailsent.php?email=$email';</script>";
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
    <div class="admin">        
        <div class="inneradmin">
            <div class="head" style="padding-bottom:50px;">
            <h3 style="font-family: 'Prompt', sans-serif;color: black;">Hi, Welcome!</h3>
            </div>
            <form action="<?php $_SERVER["REQUEST_URI"]?>" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"><b>Email address</b></label>
                    <center> <input name="loginEmail" type="email" class="form-control input-field" id="exampleInputEmail1" aria-describedby="emailHelp" required></center>
                   
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label"><b>Password</b></label>
                    <center><input name="loginPass" type="password" class="form-control input-field" id="exampleInputPassword1" required></center>
                </div>

                <div style="padding-top:30px;"><button type="submit" style="background:Black" class="forum-btn btn-f">Submit</button></div>                                
            </form>
            <div style="padding-top:30px;">
                <center>
                <h5 class="raleway" ><a class="raleway" style="color:black" href="forgotpassword.php"> Forgot password?</a> </h5> <br>
                <h5 class="raleway" >Not registered yet?<a style="color:black" href="signup.php"> register</a> </h5>
                </center>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
        integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>
</html>
<?php }
?>