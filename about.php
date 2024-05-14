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
   <title>about</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

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
      
      
      .about {
         padding: 50px 0;
      }
      
      .about .row {
         display: flex;
         justify-content: space-around;
         align-items: center;
         gap: 20px;
      }
      
      .about .box {
         background-color: #fff;
         padding: 20px;
         border-radius: 10px;
         text-align: center;
         box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      }
      
      .about .box h3 {
         font-size: 24px;
         margin-bottom: 10px;
      }
      
      .about .box p {
         font-size: 16px;
         color: #555;
         margin-bottom: 20px;
      }
      
      .about .box .btn {
         display: inline-block;
         padding: 10px 20px;
         background-color: #333;
         color: #fff;
         text-decoration: none;
         border-radius: 5px;
         transition: background-color 0.3s ease;
      }
      
      .about .box .btn:hover {
         background-color: #555;
      }
      
      .reviews {
         background-color: #f8f8f8;
         padding: 50px 0;
      }
      
      .reviews .title {
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
      
      .box img {
         width: 100px;
         border-radius: 50%;
         margin-bottom: 15px;
      }
      
      .box p {
         font-size: 16px;
         color: #555;
         margin-bottom: 10px;
      }
      
      .box .stars {
         color: #f1c40f;
         margin-bottom: 10px;
      }
      
      .box .stars i {
         font-size: 20px;
      }
      
      .box h3 {
         font-size: 18px;
         font-weight: 600;
         margin-bottom: 5px;
      }
      
      
      footer {
         background-color: #333;
         color: #fff;
         padding: 20px 0;
         text-align: center;
      }
      
      footer p {
         font-size: 16px;
      }
   </style>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

   <div class="row">

      <div class="box">
         <img src="images/about-img-1.png" alt="">
         <h3>why choose us?</h3>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
         <a href="contact.php" class="btn">contact us</a>
      </div>

      <div class="box">
         <img src="images/about-img-2.png" alt="">
         <h3>what we provide?</h3>
         <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
         <a href="shop.php" class="btn">our shop</a>
      </div>

   </div>

</section>

<section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="uploaded_img/due.jpg" alt="">
         <p>Grabe nayan idol, napakasarap ng nabili ko dine!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Daks Baliguat</h3>
      </div>

      <div class="box">
         <img src="uploaded_img/arvie.jpg" alt="">
         <p>Sheesh, sarap pulutanin ng mga nandito!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Dakstine Alcarizz</h3>
      </div>

      <div class="box">
         <img src="uploaded_img/basty.jpg" alt="">
         <p>ENDABOL EDIBOLS!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Daksty Miraflix</h3>
      </div>

      <div class="box">
         <img src="uploaded_img/dave.jpg" alt="">
         <p>Salamat, puro sa protina at sarap ang bilihin dine!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Daks Damon Paraluman</h3>
      </div>

      <div class="box">
         <img src="uploaded_img/irish.jpg" alt="">
         <p>Nako boss mukang dito nalang ako palage, bukod sa mura. Quality pa!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Bairish Dakcinto</h3>
      </div>

      <div class="box">
         <img src="uploaded_img/rhea.jpg" alt="">
         <p>Bakit kasi niring ung fire alarm T_T</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Rhea Daks Buenoventora</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>