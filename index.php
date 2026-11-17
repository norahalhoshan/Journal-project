<?php

session_start();


require_once "db.php";
require_once "entry.class.php";


$showConfetti=false;

if(isset($_SESSION["just_logged_in"]) && $_SESSION["just_logged_in"] === true){

$showConfetti=true;
unset($_SESSION["just_logged_in"]);

}



if(!isset($_SESSION["user_id"])){

header("Location: login.php");
exit();


}


$userId=$_SESSION["user_id"];
$username=$_SESSION["username"];

$entry=new Entry($conn,$userId);

 $entries=$entry->getEntries();



?>





<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
    integrity="sha384-Bk5cbLkZQ5raZ0+H2/+VbfYx3WpvxvQK4zqXZr7sYODuaX7bKXoSOnipQxkaS8sv" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css" />
  <title>Document</title>
</head>



<body class="d-flex flex-column min-vh-100">
  <header class="container-fluid p-0">
    <img src="imagesAndVideo/pink.jpg" class="banner-img" alt="journal banner" />

    <nav class="navbar nav-color shadow">
      <div class="container">

     <div class="row align-items-center w-100">

         <!--nav icon and website title-->
        <div class="col-4 d-flex align-items-center gap-2">

          <div class="logo">
            <img src="imagesAndVideo/icon2.png" alt="logo">
          </div>

         
            <span class="navbar-brand brandname">
              
              Alchemy & Ink
            </span>
          
        </div>


        <!--nav links-->
        <div class="col-4 d-flex justify-content-center">
          <ul class="navbar-nav flex-row gap-4">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="add.php">Add entry</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="about.php">About</a>
            </li>
          </ul>
        </div>

         <div class="col-4 text-end align-items-center">
          <a href="logout.php" class="nav-link" onclick="return confirm(' Are you sure you want to log out?')"><i class="bi bi-box-arrow-right"></i>
          Logout
          </a>
          
         </div>


     </div>


      </div>
    </nav>
  </header>






  <main class="flex-grow-1">
    <div class="container">

        <span class="sparkle sparkle1">  ⋆˙⟡ </span>
          <span class="sparkle-big sparkle2">  ୨୧ </span>
            <span class="sparkle sparkle3">  ✦ </span>
              <span class="sparkle-big sparkle4"> ♡  </span>
              <span class="sparkle sparkle5">  ⋆˙⟡ </span>
              <span class="sparkle sparkle6">  ⋆˙⟡ </span>
              <span class="sparkle-big sparkle7"> ♡  </span>




      <div class="row ">

        <div class="col-12 text-center mt-5">

      

            <h1 style="font-family: 'copperplate', serif; font-weight: bold; color: #3f201d; ">
              Welcome, <?php  echo htmlspecialchars($username); ?> <i class="bi bi-balloon-heart"></i>
             </h1>


        </div>
      </div>


 

      <div class="row mb-5">


        <!--Journal entries-->
        <div class="col-3">

          

          <div class="card">

          <div class="card-header entry-head">
          <h4 class="text-center"><span style="color: #601e65;">♡</span>
             My entries 
            <span style="color: #601e65;">♡</span></h4>

          </div>
        
          <div class="card-body entry-body">
          
          
          <?php if(empty($entries)): ?>

          <label> No journal entries yet. start writing!   </label>

            <?php else: ?>
              <?php foreach($entries as $items): ?>

            <div class="border-bottom border-dark mb-1 py-2">
          <h5 class="text-center"> <?php echo htmlspecialchars($items["title"]); ?> ♡</h5>
          <br>
          <div class="d-flex gap-2 justify-content-between pt-0">

          <a href="view.php?id=<?php echo $items["id"]; ?>" class="btn entry-btn" >View  </a>
          <a href="edit.php?id=<?php echo $items["id"]; ?>" class="btn entry-btn">Edit  </a>
          
            <form method="POST" action="delete.php" onclick="return confirm(' Are you sure you want to delete this?')" class="delete-form">

            <input type="hidden" name="id" value="<?php echo $items["id"]; ?>">

            <button type="submit" class="btn entry-btn">Delete  </button>


             </form>

         </div>


              </div>
          <?php endforeach; ?>
          <?php endif ?>

          </div>
          
          </div>

     

        </div>


        <!--picture-->
        <div class="col-3">

      <img src="imagesAndVideo/PinkBlueClouds.jpg" alt="cloud picture" class="clouds-img"  >

        </div>



        <!--Flip time-->
        <div class="col-3 mt-5 clock-column">

          <video class="video-loop" autoplay muted loop playsinline>

          <source src="imagesAndVideo/floating-cat.mp4" type="video/mp4">

          </video>





          <div class="mini-clock">

            <div class="flip-card">

              <span id="hours" data-time="00">00</span>

            </div>

            <span class="colon">:</span>

            <div class="flip-card">

              <span id="minutes" data-time="00">00</span>

            </div>

          </div>


        </div>




        <!--cal -->
        <div class="col-3 mt-auto ">

          <div class="calendar">

          <div class="calendar-header">

        <button onclick="changeMonth(-1)" class="direction"><i class="bi bi-caret-left"></i></button>

        <h3 class="monthYear"></h3>

        <button onclick="changeMonth(1)" class="direction"><i class="bi bi-caret-right"></i></button>
          </div>


        <div class="calendar-grid">

          <span> su</span>
          <span> mo</span>
          <span> tu</span>
          <span> we</span>
          <span> th</span>
          <span> fr</span>
          <span> sa</span>

        </div>




          </div>

        </div>

      </div>


    </div>
  </main>


<footer>

<div class="container">



<!--titles-->
<div class="row text-center">


<div class="col-4 mt-4 ">
<h3 class="text-decoration-underline">Alchemy & Ink aim's</h3>

</div>





<div class="col-4 mt-4">

  <h4 class="text-decoration-underline">Explore</h4>

</div>




<div class="col-4 mt-4">

  <h4 class="text-decoration-underline">Contact us</h4>


</div>

</div>


<!--words, links, emails-->
<div class="row text-center">


<div class="col-4 mt-2 ">

<h5 style="font-size: 20px;">A Place of hopes and dreams. Every page 
  holds your story and every thought turns into memories. This is your little corner of 
  the world to let your thoughts wander free <br> <span class="mx-1"style="font-size: 25px;">୨୧</span>. </h5>

</div>



<div class="col-4 mt-2">

<ul class="list-unstyled text-center" >
            <li>
              <a style="font-size: 20px;" href="index.php">Home</a>
            </li>

            <li>
              <a style="font-size: 20px;" href="add.php">Add entry</a>
            </li>

            <li>
              <a style="font-size: 20px;" href="about.php">About</a>
            </li>


            <li class="mt-5" style="font-size: 30px; color:  #824f4d;;">
             ⊹₊˚‧︵‿₊୨ᰔ୧₊‿︵‧˚₊⊹
            </li>


            
          </ul>
        </div>

<div class="col-4 mt-2">

<ul class="list-unstyled mx-auto text-start" style="width: fit-content;">
            <li>
              <h5 class="text-start mb-0">Norah Alhoshan -</h5>
              <a href="mailto:445009404@pnu.edu.sa" class="text-start mb-0"><i class="bi bi-envelope-heart" style="font-size: 20px;"></i> 445009404@pnu.edu.sa</a>
            </li>

            <li>
              <h5 class="text-start mb-0">Raghad Bin Khathlan -</h5>
              <a href="mailto:445008637@pnu.edu.sa" class="text-start mb-0"><i class="bi bi-envelope-heart" style="font-size: 20px;"></i> 445008637@pnu.edu.sa</a>
            </li>

            <li>
              <h5 class="text-start mb-0">Fay Alotaibi -</h5>
              <a href="mailto:445008798@pnu.edu.sa" class="text-start mb-"><i class="bi bi-envelope-heart" style="font-size: 20px;"></i> 445008798@pnu.edu.sa</a>
            </li>

             <li>
              <h5 class="text-start mb-0">Norah Alkamees -</h5>
              <a href="mailto:445008662@pnu.edu.sa" class="text-start mb-0"><i class="bi bi-envelope-heart" style="font-size: 20px;"></i> 445008662@pnu.edu.sa</a>
            </li>



          </ul>
        </div>

</div>



<!--copyright-->

<div class="row border-top border-dark">

<div class="col-12">

<h5>&copy; 2026 Alchemy & Ink | All rights reserved</h5>

</div>



</div>

</div>

















</footer>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>

<script>
<?php if($showConfetti): ?>


window.addEventListener("load", function(){

confetti({

particleCount: 150,
spread:100,
origin: {y: 0.6}


});


});


<?php endif; ?>
</script>

  <script src="script.js"></script>
</body>

</html>