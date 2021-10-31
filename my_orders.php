<?php
require("partials/dbconnect.php");
session_start();
if (!isset($_SESSION['sno'])) {
    header('location: admin/login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>My orders | PACE STORE</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">      
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
            h2{
                font-family: 'Prompt', sans-serif;
            }
        </style>
    </head>
    <body>
    <?php include 'partials/dbconnect.php' ?>

    <!--====== header section ======-->
    <?php include 'partials/header.php';?>
    <!--====== header section End ======-->

    <div style="padding-top:20px;">
        <div class="container">
            
        <div class="container my-4" style="padding-bottom:30px;" id="ques">
            <h1 class="text-center my-6 bar" style="padding:50px;font-family: 'Prompt', sans-serif;">My Orders</h1>

        </div>
        
        <!--====== Cart section ======-->
        <div class="container-fluid" id="content">
            <?php include 'partials/dbconnect.php'; ?>
            <div style="padding-bottom:70px;" class="decor_bg">
                <div class="">
                    <table class="table table-striped">
    
                        <!--show table only if there are items added in the cart-->
                        <?php
                        $sum = 0;
                        $user_id = $_SESSION['sno'];
                        $query = "SELECT `product`.`price` AS `Price`, `product`.`id`, `product`.`name` AS `Name` FROM `user_items` JOIN `product` ON `user_items`.`item_id` = `product`.`id` WHERE `user_items`.`user_id`='$user_id' and `user_items`.`status`='complete'";
                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) >= 1) {
                            ?>
                            <thead>
                                <tr>
                                    <th>Item Number</th>
                                    <th>Item Name</th>
                                    <th>Price</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_array($result)) {
                                    $sum+= $row['Price'];
                                    $id = $row['id'];
                                    echo '<tr>
                                    <td>' . '#' . $row['id'] . '</td>
                                    <td>' . $row['Name'] . '</td>
                                    <td>Rs ' . $row['Price'] . '</td>
                                   </tr>';
                                }
                                $id = rtrim($id, ", ");
                                echo "<tr>
                                <td></td>
                                <td>Total</td>
                                <td>Rs " . $sum . "</td>
                                <td>
                                
                                </tr>";
                                ?>
                            </tbody> 
                            <?php
                        } else {
                            echo '
                            <div class="container">
                                <center>
                                
                                    <h2><br><br>Your cart is empty! </h2>
                                    <h2>Brows Items</h2>
                                </center>
                            </div>
                            ';
                        }
                        ?>
                        <?php
                        ?>
                    </table>
                </div>
                
            </div>
        </div>
        </div>
       <!--====== Cart section end ======-->
        
        
        <script>
        AOS.init({
            duration : 1000,
        });
    </script>        
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js" defer data-deferred="1"></script>
    <script type="text/javascript" src="particles/particles.js"></script>
    <script type="text/javascript" src="particles/demo/js/app.js"></script>
    <script type="text/javascript" src="script.js"></script>
    </body>
</html>