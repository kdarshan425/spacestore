<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail | SPACE STORE</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
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
    <style>
        
        .card-title{
            font-family: 'Raleway', sans-serif;
            font-weight:bold;
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
    
    <?php include 'partials/dbconnect.php' ?>
    <?php include 'partials/header.php';?>
    <?php
    
    $pr_id =  $_GET['pr_id'];
    
    ?>
    
    <div style="padding-top:100px;">
        <div class="container">
            <div class="container my-4" style="padding-bottom:30px;" id="ques">
            <h1 class="text-center my-6 bar" style="padding:50px;font-family: 'Prompt', sans-serif;">Product Details</h1>

            <!-- This is for power sources -->
            <div class="row">
            <?php 
                $sql = "SELECT * FROM `product` WHERE `id`= '$pr_id' ORDER BY `timestamp` DESC"; 
                $result = mysqli_query($conn, $sql);
                while($row = mysqli_fetch_assoc($result)){
                // echo $row['category_id'];
                // echo $row['category_name'];
                $id = $row['id'];
                $cat = $row['category'];
                $name = $row['name'];
                $desc = $row['product_desc'];
                $price = $row['price'];
                $image = $row['image'];
                $timestamp = $row['timestamp'];


                echo '
                <div class="col-md-4">
                    <center>
                        <img style="max-width:100%;height:auto;" src="img/products/'.$image.'" alt="">
                    </center>
                </div>
                <div class="col-md-8">
                    <div class="container">
                        <center>
                            <div style="max-width:500px;text-align:start;padding-top:40px;">
                                <h5 style="color:black;" class="card-title" ><strong style="color:gray">Name</strong> :<br> ' . $name . '</h5> <br>
                                <h5 style="color:black;" class="card-title" ><strong style="color:gray">Description</strong> : <br> ' . $desc . '</h5> <br>  
                                <h5 style="color:black;" class="card-title" ><strong style="color:gray">Price</strong> :' . $price . 'INR</h5>  <br> 
                                <center>
                                <div style="padding-top:10px;">';
                                
                                    
                                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                                    $sql2 = "SELECT * FROM `user_items` WHERE `user_id`='".$_SESSION['sno']."' AND`item_id`='$id' AND`status`= 'Added to cart'"; 
                                    $result2 = mysqli_query($conn, $sql2);
                                    $numRows2 = mysqli_num_rows($result2);
                                                                
                                    if($numRows2<1){?>
                                        <a href="add_cart.php?id=<?php echo$id?>"><button style="background:black;color:white;padding:15px;width:200px;border:1px solid white;border-radius:0px;">Add Cart</button></a>
                                    <?php
                                    }
                                    else{
                                        ?>
                                        <a href="#"><button style="background:black;color:white;padding:15px;width:200px;border:1px solid white;border-radius:0px;">Added to Cart</button></a>
                                    <?php 
                                    }                                                              
                                        
                                } else {?>
                                        <a href="admin/login.php" ><button style="background:black;color:white;padding:15px;width:200px;border:1px solid white;border-radius:0px;">Add Cart</button></a>
                                    <?php 
                                }
                                    ?>

                                 <?php echo'
                                </div>
                                </center>
                            </div>
                        </center>
                    </div>
                </div>
                
                ';
                }
            ?>
                
            </div>
            
        </div>
    </div>

    <div>
    <center>
<div style="padding-top:20px;padding-bottom:70px;max-width:900px;text-align: left;">
    <div class="container">
        <div  style="padding:30px;">
        <h3 class="prompt"><b>Comments</b></h3>
        </div>
    </div>
    <div class="container">
    <?php
    $noResult = true;
        $sql = "SELECT * FROM `threads` where `th_product_id`='$id' "; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
            $noResult = false;
            $thread_id = $row['th_id'];
            $desc = $row['th_desc'];
            $th_by = $row['th_by'];
            $timestamp = $row['timestamp'];  

            $sql2 = "SELECT * FROM `users` WHERE `sno`='$th_by '";
            $result2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($result2);
            $posted_by_email = $row2['user_email'];  
            $posted_by_username = $row2['user_name'];  

            echo'
            <div class="container">
                <div class="media my-3">
                    <img src="img/user.png" width="54px" class="mr-3" alt="...">
                    <div class="media-body">
                        <p class="font-weight-bold my-0 raleway">'. $posted_by_username .' <br> <i style="color:#80808070;">'. $timestamp . ' <a href="https://spacestorepraxis.herokuapp.com/reply.php?threadid='.$thread_id.'">   Reply</a></i> <br> '. $desc . ' </p> 
                    </div>
                </div>
            </div>
            ';

        }
        if($noResult){
            echo '<div class="jumbotron jumbotron-fluid">
                    <div style="padding-left:20px;padding-right:20px;">
                    <div class="container">
                        <p class="raleway" style="font-size:30px;">No Comments Found</p>
                        <p class="raleway lead"> Be the first person to comment</p>
                    </div>
                    </div>
                 </div> ';
        }?>
    </div>
</div>
</center>
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

         
        $sql = "INSERT INTO `threads` (`th_id`, `th_desc`, `th_product_id`, `th_by`, `timestamp`) VALUES (NULL, '$comment', '$id', '$thname', current_timestamp())";
        $result = mysqli_query($conn, $sql);
        
        $showAlert = true;
        if($showAlert){
            
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your comment has been added!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                  </div>';
                  ?>
                  <script>window.history.go(-1)</script>                  
                  <?php
                  exit();
        } 
    }
?>



<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
    $blog_owner = $_SESSION['sno'];
?>
<div class="container">
       <center>
       <div  style="padding:30px;max-width:900px">
            <h3  class="prompt"><b>Add Comment</b></h3>
        </div>
       </center>
    </div>
<?php
echo'
        <div class="container">            
        <center>
        <div style="max-width:900px;padding-bottom:90px;">
        <form action= "'. $_SERVER['REQUEST_URI'] . '" method="post"> 
                <div class="form-group">
                    <div class="form-group" style="margin-top:0px;margin-bottom:20px;">
                    <input type="hidden" id="heading" name="heading" value="'. $blog_owner. '">
                    </div>
                    <!-- <label for="exampleFormControlTextarea1">Post comment</label> -->
                    <textarea class="form-control" placeholder="Enter Comment" id="comment" name="comment" rows="3" required ></textarea>                    
                </div>
                <center>
                <button style="background:black;border-radius:0px;color:white;" type="submit" class="btn btn-success">Post Comment</button>
                </center>
        </form> 
        </div>
        </center>
        </div>';
}
        ?>
    </div>
    <footer class="footer" style="margin-top:0px;background: black;padding-top: 24px;padding-bottom: 24px; width: 100%">
        <center>
            <div>
                <p style="color: #c7c5c5;font-weight: 300;font-family: 'Raleway', sans-serif;">All rights reserved <br> Engineered by <a target="_blank" href="https://www.linkedin.com/in/darshan-khope-9400571a2/">Darshan Khope</a> </p>
            </div>
        </center>      
    </footer>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration : 1000,
        });
    </script>   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
     
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" defer data-deferred="1"></script>
    <script type="text/javascript" src="particles/particles.js"></script>
    <script type="text/javascript" src="particles/demo/js/app.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script>
        particlesJS("particles-js", {"particles":{"number":{"value":260,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":true,"speed":1,"opacity_min":0,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":4,"size_min":0.3,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":1,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":600}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":250,"size":0,"duration":2,"opacity":0,"speed":3},"repulse":{"distance":400,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true})
    </script>
</body>
</html>