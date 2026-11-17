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
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon|outline|emboss|shadow-multiple">
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




<main class="container my-5 about-con">

    <!-- About heading -->
    <h1 class="text-center about-title font-effect-shadow-multiple mb-1">
        About 
    </h1>

    <p class="about-text text-center mb-5 w-100">
       

Alchemy & Ink is a personal journaling platform designed to give users a comfortable and creative space to express their thoughts, capture meaningful moments, and reflect on their everyday experiences. We believe that every thought has a story worth keeping, whether it is a small daily memory, a personal reflection, or an idea waiting to be explored.

Our website allows users to create their own personal journal entries, revisit previous memories, and make changes whenever they wish. With simple and accessible features, users can easily add, view, edit, and delete their entries while keeping their writing organized in one place.

More than just a place to write, Alchemy & Ink encourages creativity, self-expression, and the habit of documenting life’s little moments. We wanted to create a welcoming experience where writing feels personal, simple, and enjoyable.

Every page holds a thought, every entry tells a story, and every story deserves a place to stay.
    </p>


     <!-- line seperator -->
    <div class="w-100">

        <hr>


    </div>


    <!-- Meet the team -->
    <h2 class="text-center mb-4 mini-titles">
        Meet Our Team ♡
    </h2>

    <div class="row justify-content-center g-4 mb-5">

        <!-- Norah Alhoshan -->
        <div class="col-6 col-md-3 text-center">

           <img  src="imagesAndVideo/profile6.jpg " alt="profile 6" class="rounded-circle" width="200px" heigth="200px" name="img1">

            <h5 class="about-names mt-2">Norah Alhoshan</h5>

            <p class="strong">
                Homepage & User Authentication
            </p>

            <p class="strong">
                Developed the homepage, login, and registration pages.
            </p>

        </div>


        <!-- Raghad -->
        <div class="col-6 col-md-3 text-center">


            <img  src="imagesAndVideo/profile4.jpg " alt="profile 4" class="rounded-circle" width="200px" heigth="200px" name="img2">

            <h5 class="about-names mt-2">Raghad Bin Khathlan</h5>

            <p class="strong">
                JavaScript & View Page
            </p>

            <p class="strong">
                Worked on JavaScript functionality and the journal viewing page.
            </p>

        </div>


        <!-- Fay -->
        <div class="col-6 col-md-3 text-center">

           <img  src="imagesAndVideo/profile7.jpg " alt="profile 7" class="rounded-circle" width="200px" heigth="200px" name="img3">

            <h5 class="about-names mt-2">Fay Alotaibi</h5>

            <p class="strong">
                Entry Management & Logout
            </p>

            <p class="strong">
                Developed the entry class and logout functionality.
            </p>

        </div>


        <!-- Norah Alkamees -->
        <div class="col-6 col-md-3 text-center">

          <img  src="imagesAndVideo/profile8.jpg " alt="profile 3" class="rounded-circle" width="200px" heigth="200px" name="img4">

            <h5 class="about-names mt-2">Norah Alkamees</h5>

            <p class="strong">
                Journal Entry Management
            </p>

            <p class="strong">
                Developed the add, edit, and delete entry pages.
            </p>

        </div>

    </div>



     <!-- line seperator -->
    <div class="w-100">

        <hr>

    </div>


    <!-- About the website -->
    <div class="text-center my-5">

        <h2 class="mb-2 mini-titles">What We Created ♡</h2>

        <p class="about-text w-100">
            Our website allows users to create personal journal
            entries and manage them whenever they want.
            From writing new entries to editing and viewing
            saved ones, Alchemy & Ink brings everything
            together in one place.
        </p>

    </div>


    <!-- Website features -->
    <div class="row g-3 text-center mb-5">

        <div class="col-md-3 col-6">
            <div class="p-3 rounded-3 h-100"
                 style="background-color: #f2e4df;">
                <h5>♡</h5>
                <h6>Write</h6>
                <p class="small mb-0">Create new journal entries.</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="p-3 rounded-3 h-100"
                 style="background-color: #e8e6f0;">
                <h5>♡</h5>
                <h6>View</h6>
                <p class="small mb-0">Read saved memories and thoughts.</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="p-3 rounded-3 h-100"
                 style="background-color: #f0e8d8;">
                <h5>♡</h5>
                <h6>Edit</h6>
                <p class="small mb-0">Update existing entries.</p>
            </div>
        </div>

        <div class="col-md-3 col-6">
            <div class="p-3 rounded-3 h-100"
                 style="background-color: #e3eade;">
                <h5>♡</h5>
                <h6>Manage</h6>
                <p class="small mb-0">Delete entries when needed.</p>
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
              <a style="font-size: 20px;" href="index.html">Home</a>
            </li>

            <li>
              <a style="font-size: 20px;" href="add.html">Add entry</a>
            </li>

            <li>
              <a style="font-size: 20px;" href="about.html">About</a>
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


</body>

</html>