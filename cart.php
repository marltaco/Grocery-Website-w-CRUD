<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$delete_id]);
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$p_qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<style>
    body {
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
         background-color: #f4f4f4;
      }

      .container {
         max-width: 1200px;
         margin: 0 auto;
         padding: 20px;
      }

      .title {
         font-size: 24px;
         margin-bottom: 20px;
      }

      .box {
         background-color: #fff;
         padding: 20px;
         margin-bottom: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .box img {
         max-width: 100px;
         height: auto;
         margin-bottom: 10px;
      }

      .box .name {
         font-weight: bold;
         margin-bottom: 10px;
      }

      .box .price {
         color: #00aaff;
         margin-bottom: 10px;
      }

      .box .flex-btn {
         display: flex;
         align-items: center;
         margin-bottom: 10px;
      }

      .box input[type="number"] {
         width: 50px;
         padding: 5px;
         margin-right: 10px;
         border: 1px solid #ccc;
         border-radius: 3px;
         text-align: center;
      }

      .box .sub-total {
         font-size: 14px;
         color: #888;
      }

      .box .option-btn {
         background-color: #00aaff;
         color: #fff;
         border: none;
         padding: 5px 10px;
         border-radius: 3px;
         cursor: pointer;
      }

      .box .delete-btn {
         background-color: #ff0033;
         margin-left: auto;
      }

      .cart-total {
         background-color: #fff;
         padding: 20px;
         margin-top: 20px;
         border-radius: 5px;
         box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .cart-total p {
         font-weight: bold;
         margin-bottom: 10px;
      }

      .cart-total .option-btn,
      .cart-total .delete-btn,
      .cart-total .btn {
         background-color: #00aaff;
         color: #fff;
         border: none;
         padding: 10px 20px;
         border-radius: 3px;
         text-decoration: none;
         cursor: pointer;
         margin-right: 10px;
      }

      .cart-total .disabled {
         pointer-events: none;
         opacity: 0.5;
      }

      .cart-total .disabled:hover {
         background-color: #00aaff;
      }

      footer {
         background-color: #333;
         color: #fff;
         text-align: center;
         padding: 20px 0;
         position: fixed;
         bottom: 0;
         left: 0;
         width: 100%;
      }

      footer p {
         margin: 0;
      }
</style>
<body>
   
<?php include 'header.php'; ?>

<section class="shopping-cart">

   <h1 class="title">products added</h1>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
      $select_cart->execute([$user_id]);
      if($select_cart->rowCount() > 0){
         while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="POST" class="box">
      <a href="cart.php?delete=<?= $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
      <a href="view_page.php?pid=<?= $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
      <div class="name"><?= $fetch_cart['name']; ?></div>
      <div class="price">$<?= $fetch_cart['price']; ?>/-</div>
      <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
      <div class="flex-btn">
         <input type="number" min="1" value="<?= $fetch_cart['quantity']; ?>" class="qty" name="p_qty">
         <input type="submit" value="update" name="update_qty" class="option-btn">
      </div>
      <div class="sub-total"> sub total : <span>$<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</span> </div>
   </form>
   <?php
      $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">your cart is empty</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>grand total : <span>$<?= $grand_total; ?>/-</span></p>
      <a href="shop.php" class="option-btn">continue shopping</a>
      <a href="cart.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>">delete all</a>
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
   </div>

</section>










<script src="js/script.js"></script>

</body>
</html>