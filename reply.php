<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reply | SPACE STORE</title>    
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://use.fontawesome.com/9fc82f32ca.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abhaya+Libre&family=Abril+Fatface&family=Quantico:ital@1&family=Raleway:wght@200&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Raleway:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <style>
        #ques{
            min-height: 433px;
        }

        .raleway{
            font-family: 'Raleway', sans-serif;
        }

        .prompt{
            font-family: 'Prompt', sans-serif;
        }
    </style>
    
</head>

<body>
    <div > 
        
    <?php include 'partials/dbconnect.php';?>
    
    <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `threads` WHERE `th_id`='$id'"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $product_id = $row['th_product_id'];
        $desc = $row['th_desc'];
        $th_by = $row['th_by'];
        

        // Query the users table to find out the name of OP
        
    }
    
    ?>
    

    <?php
    
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST'){
        //Insert into comment db
        $comment = $_POST['comment']; 
        $thname = $_POST['heading']; 

        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
        $comment = str_replace("'", "\\'", $comment);

        $thname = str_replace("<", "&lt;", $thname);
        $thname = str_replace(">", "&gt;", $thname); 
        $thname = str_replace("'", "\\'", $thname);

         
        $sql = "INSERT INTO `reply` (`re_id`, `re_content`, `th_id`, `product_id`, `reply_by`, `timestamp`) VALUES (NULL, '$comment', '$id', '$product_id', '$thname', current_timestamp());";
        $result = mysqli_query($conn, $sql);
        
        $showAlert = true;
        
        if($showAlert){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
        } 
    }
    ?>


    <!-- Category container starts here -->
    <div style="margin:auto;max-width:900px;padding-top:70px;">
    <div class="container my-4">
        <div class="jumbotron">            
            <p class="lead">  <?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post questions. Remain respectful of other members at all times.</p>
            <p>Posted by: <em><?php echo $th_by; ?></em></p>
        </div>
    </div>
    </div>

    <?php
    session_start(); 
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
        $blog_owner = $_SESSION['sno'];
    ?>
     <?php 
     
        echo '<div class="container">
           <center>
           <div style="max-width:900px;">
           <center>
           <div  style="padding:30px;max-width:900px">
               <h3 class="prompt"><b>Add Comment</b></h3>
           </div>
           <form action= "'. $_SERVER['REQUEST_URI'] . '" method="post"> 
               <div class="form-group">
                   <div class="form-group" style="margin-top:0px;margin-bottom:20px;">
                       <input type="hidden" id="heading" name="heading" value="'. $blog_owner. '">                        
                   </div>
                   <!-- <label for="exampleFormControlTextarea1">Post comment</label> -->
                   <textarea class="form-control" placeholder="Enter Comment" id="comment" name="comment" rows="3" required ></textarea>                    
               </div>
               <center>
               <button style="background:black;color:white;border-radius:0px;" type="submit" class="btn btn-success">Post Comment</button>
               </center>
           </form> 
           </center>
           </div>
           </center>
        </div>';       
    
    }
    else{    
        
        echo'
        <div style="padding-bottom:70px;">
            <div class="container">
                <center><p class="lead">You are not logged in. Please login to  start a Discussion</p></center>          
            </div>
        </div>
        ';
    }
    
    ?>


    <div class="container mb-5" id="ques">
    <div  style="padding:30px;max-width:900px">
            <h3 class="raleway"><b>Comments</b></h3>
        </div>
       <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `reply` WHERE `th_id`='$id'"; 
    $result = mysqli_query($conn, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $re_id = $row['re_id'];
        $content = $row['re_content']; 
        $product_id = $row['product_id']; 
        $reply_by = $row['reply_by']; 
        $comment_time = $row['timestamp'];
        
        $sql2 = "SELECT * FROM `users` WHERE `sno`='$reply_by'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by_email = $row2['user_email'];  
        $posted_by_username = $row2['user_name'];  

        echo '<div class="media my-3">
            <img src="img/user.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
               <p class="raleway font-weight-bold my-0">'. $posted_by_username .' <br> <i style="color:#80808070;"> '. $comment_time. ' </i></p> '. $content . '
            </div>
        </div>';

        }
        // echo "this is good";
        // echo var_dump($noResult);
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div class="container">
                        <p class="lead">No Comments Found</p>
                        <p class="lead"> Be the first person to comment</p>
                    </div>
                 </div> ';
        }
    
    ?> 

    </div>

    </div>
    <script type="text/javascript" src="script.js"></script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
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
