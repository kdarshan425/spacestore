<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $total_amount = $_POST['total_amount'];

    session_start();
    $user_id = $_SESSION['sno'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../img/urllogo.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Abril+Fatface&family=Archivo:wght@300&family=Orbitron:wght@500&display=swap"
        rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@1,700&display=swap" rel="stylesheet">
    <style>
.payment{
    height:100%;
    width:100%;
    text-align:center;
    vertical-align:center;
    justify-content:center;
}

.innerpayment{
    padding:100px 30px 30px 30px;
}

@media screen and (max-width: 800px) {
    .innerpayment{
    padding:130px 30px 30px 30px;
}
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
#disabled{
background:red;
}
input:disabled {
    background-color: -internal-light-dark(rgba(239, 239, 239, 0.3), rgba(59, 59, 59, 0.7));
    border-color: rgba(118, 118, 118, 0.3);
}
.forum-btn{
  position: relative;
  border: 0px solid;
  border-radius: 0px;
  padding: 0rem 1rem;
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
  background-color:black;
  color: white;
  width: 200px;
  box-shadow: 2px 1px 4px 2px rgba(0,0,0,0) !important;
  transition: ease-in-out 1s !important;
}

.forum-btn.btn-f:hover{
  background-color:black;
  color: white;
  width: 200px;
  box-shadow:inset 1px 1px 4px 2px rgba(0,0,0,0) !important;
  text-decoration: none;
  
}
</style>
</head>
<body>
<?php
 
  include '../partials/dbconnect.php';
 
    
?>

<div class="payment">
    <div class="innerpayment">
        <div class="head" style="padding-bottom:50px;">
        <h3 style="font-family: 'Prompt', sans-serif;color: black;">Enter Your Name For Our Further records</h3>
        </div>
     
        <form action="">
            <div>
            <label style="font-weight:bold;font-family: 'Prompt', sans-serif;" for="lname">Your Name:</label><br>
            <input class="input-field" type="text" name="name" id="name" placeholder="Name"  required><br> <br>
            </div>
            <div>
            <label style="font-weight:bold;font-family: 'Prompt', sans-serif;" for="lname">Price In INR:</label><br>
            <input class="input-field" type="text" value="<?php echo $total_amount;?>" name="amt" id="amt" placeholder="<?php echo $price;?>" disabled><br> <br>
            </div>
            <div style="padding-top:30px;"><input class="forum-btn btn-f" type="button" name="btn" id="btn" value="pay" onclick="pay_now()"><br> <br></div>
            
        </form>
    </div>
</div>
<script>
    function pay_now(){
        var name=jQuery('#name').val();
        var amt=jQuery('#amt').val();
        
         jQuery.ajax({
               type:'post',
               url:'payment_process.php',
               data:"amt="+amt+"&name="+name+"&id=",
               success:function(result){
                   var options = {
                        "key": "rzp_test_pzhZYsmMDNrlBu", 
                        "amount": amt*100, 
                        "currency": "INR",
                        "name": "Space Store",
                        "description": "Space store praxis event",
                        
                        "handler": function (response){
                           jQuery.ajax({
                               type:'post',
                               url:'payment_process.php',
                               data:"payment_id="+response.razorpay_payment_id,
                               success:function(result){
                                   window.location.href="../payment_done.php?u_id=<?php echo$user_id;?>";
                               }
                           });
                        }
                    };
                    var rzp1 = new Razorpay(options);
                    rzp1.open();
               }
           });
        
        
    }
</script>

</body>
</html>
<?php } ?>