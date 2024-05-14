<?php

if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
<style>


.header {
    background-color: #fff;
    color: #333;
    padding: 10px 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.header .flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header .logo {
    font-size: 24px;
    font-weight: bold;
    text-decoration: none;
    color: #333;
}

.header .logo span {
    color: #007bff;
}

.header .navbar {
    display: flex;
    align-items: center;
}

.header .navbar a {
    color: #333;
    text-decoration: none;
    padding: 10px;
    margin-right: 20px;
    transition: color 0.3s ease;
}

.header .navbar a:hover {
    color: #007bff;
}

.header .icons .fa {
    font-size: 20px;
    color: #333;
    margin-right: 10px;
    cursor: pointer;
    transition: color 0.3s ease;
}

.header .icons .fa:hover {
    color: #007bff;
}

.header .profile {
    display: flex;
    align-items: center;
}

.header .profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
}

.header .profile p {
    margin: 0;
    font-size: 16px;
    font-weight: bold;
}

.header .profile .btn,
.header .profile .delete-btn,
.header .flex-btn a {
    padding: 8px 16px;
    border: none;
    background-color: #007bff;
    color: #fff;
    font-size: 14px;
    border-radius: 5px;
    margin-right: 10px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.header .profile .btn:hover,
.header .profile .delete-btn:hover,
.header .flex-btn a:hover {
    background-color: #0056b3;
}

</style>

<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Grocery sa gedli<span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
            $count_wishlist_items->execute([$user_id]);
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>