<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:admin_contacts.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

  
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

header {
    background-color: #333;
    color: #fff;
    padding: 20px 0;
}

.logo {
    text-align: center;
    font-size: 24px;
}


.messages {
    padding: 50px 0;
}

.messages .title {
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

.delete-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f44336;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #d32f2f;
}

.empty {
    text-align: center;
    font-size: 18px;
    color: #555;
}

</style>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">messages</h1>

   <div class="box-container">

   <?php
      $select_message = $conn->prepare("SELECT * FROM `message`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> user id : <span><?= $fetch_message['user_id']; ?></span> </p>
      <p> name : <span><?= $fetch_message['name']; ?></span> </p>
      <p> number : <span><?= $fetch_message['number']; ?></span> </p>
      <p> email : <span><?= $fetch_message['email']; ?></span> </p>
      <p> message : <span><?= $fetch_message['message']; ?></span> </p>
      <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
   ?>

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>