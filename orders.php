<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f7f7f7;
}

.header {
  background-color: #ffffff;
  padding: 20px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.header .logo {
  font-size: 24px;
  font-weight: bold;
  color: #333333;
  text-decoration: none;
}

.header .navbar {
  display: flex;
}

.header .navbar a {
  margin-right: 20px;
  text-decoration: none;
  color: #333333;
  font-size: 16px;
}

.header .icons {
  display: flex;
  align-items: center;
}

.header .icons a {
  margin-right: 10px;
  color: #333333;
  font-size: 18px;
  text-decoration: none;
}

.placed-orders {
  padding: 40px 20px;
}

.placed-orders .title {
  font-size: 28px;
  margin-bottom: 20px;
  color: #333333;
}

.placed-orders .box-container {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
}

.placed-orders .box {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.placed-orders .box p {
  font-size: 16px;
  margin-bottom: 10px;
  color: #555555;
}

.placed-orders .box p span {
  font-weight: bold;
}

.placed-orders .box p:last-child {
  margin-bottom: 0;
}

.placed-orders .empty {
  font-size: 18px;
  color: #555555;
}

@media screen and (max-width: 768px) {
  .header {
    padding: 15px;
  }

  .header .logo {
    font-size: 20px;
  }

  .header .navbar a {
    font-size: 14px;
  }

  .header .icons a {
    font-size: 16px;
  }

  .placed-orders .title {
    font-size: 24px;
  }

  .placed-orders .box {
    padding: 15px;
  }

  .placed-orders .box p {
    font-size: 14px;
  }
}

</style>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
      <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
      <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
      <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>