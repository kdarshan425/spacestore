<?php
if(isset($_GET['search'])){
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    
    <meta charset="utf-8">    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>SEARCH | Space Store </title>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Archivo:wght@300&family=Orbitron:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bree+Serif&family=Raleway:wght@200&display=swap" rel="stylesheet">
    
    
</head>
    
    <style>
    



.blog-search{
    max-width:600px;
    
   
}
@media (max-width: 768px){
    .blog-search{
    max-width:500px;
}
}

@media (max-width: 568px){
    .blog-search{
    max-width:200px;
}
}
</style>
</head>

<body>
    <?php include 'partials/dbconnect.php';?>
    <?php include 'partials/header.php';?>
    
    <div class="container my-4" style="padding-bottom:30px;" id="ques">
                <h1 class="text-center my-6 bar" style="padding:50px;font-family: 'Prompt', sans-serif;">Products</h1>

            <!-- This is for power sources -->
            <div>

    <div>
        <div style="width:100%;height:100%;">
            <div style="padding-top:10px;">
                <div class="container ch-head" style="text-align: center;">
                    <div style="padding:10px 20px 10px 20px;">                        
                       
                        <div>
                            <form action="search.php" method="get">
                                <center>
                                <div class="blog-search"> 
                                    <center>
                                    <div class="row">
                                        <div style="padding-left:0px;padding-right:0px;" class="col-lg-11 col-md-11 col-10"><input style="height: calc(1.5em + .75rem + 2px);box-shadow: 0px 10px 20px -5px rgb(73 93 207 / 20%);border-radius: 0px" class="form-control " type="search" name="search" placeholder="     Search " aria-label="Search" ></div>
                                        <div style="padding-left:0px;padding-right:0px;text-align:start;" class="col-lg-1 col-md-1 col-2"><button style="height: calc(1.5em + .75rem + 2px);box-shadow: 2px 2px 5px rgba(0,0,0,0.2);border:none;background-color:black;color:white;border-radius:0;width:100%;" class="btn1" type="submit">Q</button></div>
                                    </div>
                                    </center>
                                </div>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    
    <!-- echo $_SESSION['useremail'];
         echo $_SESSION['sno'];
    -->
    <div style="padding-top:20px;">
    <h5 style="font-family: 'Orbitron', sans-serif; color:#4d6570a3;padding:20px;" class="py-3">
    <center>Search Results For<em>"<?php echo $_GET['search']?>" <a href="index.php">home</a></center>
    </h5>
    </div>
    <div class="container my-4" style="padding-bottom:100px;">
        <div class="row ">

        <?php
            $query = $_GET['search'];
            $query = str_replace("<", "&lt;", $query);
            $query = str_replace(">", "&gt;", $query);         
            $query = str_replace("'", "\\'", $query);
            
            $sql = "SELECT * FROM `product`  WHERE MATCH (`name`,`category`) against ('$query') ORDER BY `timestamp` DESC";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)){                       
                $id = $row['id'];
                $cat = $row['category'];
                $name = $row['name'];
                $desc = $row['product_desc'];
                $price = $row['price'];
                $image = $row['image'];
                $timestamp = $row['timestamp'];
                

                echo '<div class="col-md-4" style="padding:25px;">
                            <a style="text-decoration:none;" href="detail.php?pr_id='.$id.'">
                                <div class="card" style="width: 100%;box-shadow: 0px 10px 20px -5px rgb(73 93 207 / 20%);">
                                    <img style="padding: 20px;height:300px;width:auto;" src="img/products/'.$image.'" class="cimg card-img-top" alt="image for this category">
                                    <div class="card-body">
                                        <center>
                                            <div style="padding:20px;>
                                                <h5 style="color:black;" class="card-title" >' . $name . '</h5>      
                                                <h5 style="color:black;" class="card-title" >Price : '.$price.' INR</h5>                 
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </a>                  
                        </div>';         
            }
         ?>
        
        
         </div>
    </div>
   
    <script type="text/javascript" src="script.js"></script>
    <script src="abc.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async></script>
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
<?php } ?>