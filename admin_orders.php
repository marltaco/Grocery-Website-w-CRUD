<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->execute([$update_payment, $order_id]);
   $message[] = 'payment has been updated!';

};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->execute([$delete_id]);
   header('location:admin_orders.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   </head>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f8f8f8;
}

.container {
    max-width: 1100px;
    margin: auto;
    padding: 0 20px;
}

.header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

.flex {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.logo {
    text-decoration: none;
    color: #fff;
    font-size: 24px;
}

.logo span {
    font-weight: bold;
}

.navbar {
    display: flex;
}

.navbar a {
    color: #fff;
    text-decoration: none;
    padding: 0 15px;
}

.icons {
    display: flex;
    align-items: center;
}

.icons i {
    color: #fff;
    font-size: 24px;
    cursor: pointer;
    margin-left: 10px;
}

.placed-orders {
    padding: 50px 0;
}

.placed-orders .title {
    text-align: center;
    font-size: 36px;
    margin-bottom: 30px;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    justify-items: center;
}

.box {
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.box p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

.box span {
    font-weight: bold;
}

.drop-down {
    margin-bottom: 10px;
    padding: 8px;
    font-size: 16px;
}

.option-btn, .delete-btn {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
}

.option-btn {
    background-color: #007bff;
    color: #fff;
    margin-right: 5px;
}

.delete-btn {
    background-color: #dc3545;
    color: #fff;
}

.delete-btn:hover, .option-btn:hover {
    opacity: 0.8;
}

.empty {
    text-align: center;
    font-size: 18px;
    color: #555;
}

</style>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->prepare("SELECT * FROM `orders`");
         $select_orders->execute();
         if($select_orders->rowCount() > 0){
            while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <p> user id : <span><?= $fetch_orders['user_id']; ?></span> </p>
         <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
         <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
         <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
         <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
         <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
         <p> total products : <span><?= $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?= $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="udate">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
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