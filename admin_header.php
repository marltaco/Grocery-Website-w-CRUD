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
         background-color: #333;
         color: #fff;
         padding: 10px 20px;
      }

      .header .flex {
         display: flex;
         justify-content: space-between;
         align-items: center;
      }

      .header .logo {
         font-size: 24px;
         text-decoration: none;
         color: #fff;
         margin-right: 20px;
      }

      .header .logo span {
         font-weight: bold;
      }

      .header .navbar {
         flex: 1;
         display: flex;
         justify-content: center;
      }

      .header .navbar a {
         color: #fff;
         text-decoration: none;
         margin: 0 10px;
         font-size: 16px;
      }

      .header .icons .fa-bars,
      .header .icons .fa-user {
         font-size: 24px;
         color: #fff;
         cursor: pointer;
         margin-right: 10px;
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

      .header .btn,
      .header .delete-btn,
      .header .option-btn {
         background-color: #fff;
         color: #333;
         padding: 5px 10px;
         border: none;
         border-radius: 5px;
         text-decoration: none;
         margin-right: 10px;
         cursor: pointer;
      }

      .header .flex-btn {
         display: flex;
         align-items: center;
      }
</style>
<header class="header">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="admin_update_profile.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>