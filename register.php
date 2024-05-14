<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select->execute([$email]);

   if($select->rowCount() > 0){
      $message[] = 'user email already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert = $conn->prepare("INSERT INTO `users`(name, email, password, image) VALUES(?,?,?,?)");
         $insert->execute([$name, $email, $pass, $image]);

         if($insert){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folder);
               $message[] = 'registered successfully!';
               header('location:login.php');
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>

   

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

.form-container .message {
   margin-bottom: 15px;
   padding: 10px;
   border-radius: 5px;
   background-color: #f44336;
   color: #fff;
   position: relative;
}

.form-container .message i {
   position: absolute;
   top: 50%;
   right: 10px;
   transform: translateY(-50%);
   cursor: pointer;
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

   <form action="" enctype="multipart/form-data" method="POST">
      <h3>register now</h3>
      <input type="text" name="name" class="box" placeholder="enter your name" required>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" name="cpass" class="box" placeholder="confirm your password" required>
      <input type="file" name="image" class="box" required accept="image/jpg, image/jpeg, image/png">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</section>


</body>
</html>