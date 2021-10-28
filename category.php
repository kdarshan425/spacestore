<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | SPACE STORE</title>
    
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
    </style>
</head>
<body>
    
    <?php include 'partials/dbconnect.php' ?>
    <?php include 'partials/header.php';?>
    <?php
    $cat = $_GET['cat'];
    // echo $_SESSION['loggedin'] ;
    // echo $_SESSION['useremail'];
    ?>
    
    <div style="padding-top:100px;">
        <div class="container">
            <div class="container my-4" style="padding-bottom:30px;" id="ques">
            <h1 class="text-center my-6 bar" style="padding:50px;font-family: 'Prompt', sans-serif;">Products</h1>

            <!-- This is for power sources -->
            <div>
            <div>
                <center>
                    <h2 style="padding:30px;font-family: 'Prompt', sans-serif;"><?php echo$cat; ?></h2>
                </center>
            </div>
            <div class="row my-4" data-masonry='{"percentPosition": true }'>
                <?php 
                $sql = "SELECT * FROM `product` WHERE `category`= '$cat' ORDER BY `timestamp` DESC"; 
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
            </div>



            
        </div>
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
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" defer data-deferred="1"></script>
    <script type="text/javascript" src="particles/particles.js"></script>
    <script type="text/javascript" src="particles/demo/js/app.js"></script>
    <script type="text/javascript" src="script.js"></script>
    <script>
        particlesJS("particles-js", {"particles":{"number":{"value":260,"density":{"enable":true,"value_area":800}},"color":{"value":"#ffffff"},"shape":{"type":"circle","stroke":{"width":0,"color":"#000000"},"polygon":{"nb_sides":5},"image":{"src":"img/github.svg","width":100,"height":100}},"opacity":{"value":1,"random":true,"anim":{"enable":true,"speed":1,"opacity_min":0,"sync":false}},"size":{"value":3,"random":true,"anim":{"enable":false,"speed":4,"size_min":0.3,"sync":false}},"line_linked":{"enable":false,"distance":150,"color":"#ffffff","opacity":0.4,"width":1},"move":{"enable":true,"speed":1,"direction":"none","random":true,"straight":false,"out_mode":"out","bounce":false,"attract":{"enable":false,"rotateX":600,"rotateY":600}}},"interactivity":{"detect_on":"canvas","events":{"onhover":{"enable":true,"mode":"bubble"},"onclick":{"enable":true,"mode":"repulse"},"resize":true},"modes":{"grab":{"distance":400,"line_linked":{"opacity":1}},"bubble":{"distance":250,"size":0,"duration":2,"opacity":0,"speed":3},"repulse":{"distance":400,"duration":0.4},"push":{"particles_nb":4},"remove":{"particles_nb":2}}},"retina_detect":true})
    </script>
</body>
</html>