<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$email, $pass]);
   $rowCount = $stmt->rowCount();  

   $row = $stmt->fetch(PDO::FETCH_ASSOC);

   if($rowCount > 0){

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

  

</head>
<style>
.form-container {
   max-width: 400px;
   margin: 100px auto;
   padding: 20px;
   text-align: center;
   border-radius: 10px;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   background-color: #f9f9f9;
}

.form-container h2 {
   margin-bottom: 20px;
}

.form-container .box {
   width: 100%;
   margin-bottom: 15px;
   padding: 10px;
   border: 1px solid #ccc;
   border-radius: 5px;
   font-size: 16px;
}

.form-container .btn {
   width: 100%;
   padding: 10px;
   border: none;
   border-radius: 5px;
   background-color: #000;
   color: #fff;
   font-size: 16px;
   cursor: pointer;
   transition: background-color 0.3s ease;
}

.form-container .btn:hover {
   background-color: #333;
}

.form-container p {
   margin-top: 15px;
}

.form-container p a {
   color: #000;
   text-decoration: none;
   font-weight: bold;
}

.form-container p a:hover {
   text-decoration: underline;
}

</style>
<body>

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
   
<section class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>


</body>
</html>