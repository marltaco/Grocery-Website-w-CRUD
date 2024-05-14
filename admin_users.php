<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
   $delete_users->execute([$delete_id]);
   header('location:admin_users.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>



</head>
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.box-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    grid-gap: 20px;
}

.box {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: px; 
}

.box img {
    width: 100%;
    height: auto;
    border-radius: 5px;
    margin-bottom: 15px;
}

.box p {
    margin: 0;
    font-size: 16px;
    color: #333;
}

.box span {
    font-weight: bold;
    color: #00aaff;
}

.delete-btn {
    background-color: #ff0033;
    color: #fff;
    border: none;
    padding: 6px 10px; 
    border-radius: 3px;
    text-decoration: none;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #cc0000;
}

</style>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <div class="box-container">

      <?php
         $select_users = $conn->prepare("SELECT * FROM `users`");
         $select_users->execute();
         while($fetch_users = $select_users->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box" style="<?php if($fetch_users['id'] == $admin_id){ echo 'display:none'; }; ?>">
         <img src="uploaded_img/<?= $fetch_users['image']; ?>" alt="">
         <p> user id : <span><?= $fetch_users['id']; ?></span></p>
         <p> username : <span><?= $fetch_users['name']; ?></span></p>
         <p> email : <span><?= $fetch_users['email']; ?></span></p>
         <p> user type : <span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; }; ?>"><?= $fetch_users['user_type']; ?></span></p>
         <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
      }
      ?>
   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>