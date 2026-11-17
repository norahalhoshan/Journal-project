<?php
session_start();

require_once "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["username"]) && isset($_POST["password"])){


$username=$_POST["username"];
$password=$_POST["password"];


$emptyField="";
$errorNameandPass="";

if(empty($username) || empty($password)){

$emptyField= "empty field!";
}else{


$sql="SELECT * from users where username=?";

$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();

$result=$stmt->get_result();

if($result->num_rows ==1){
$user=$result->fetch_assoc();

if(password_verify($password,$user["password"])){

$_SESSION["user_id"]=$user["id"];
$_SESSION["username"]=$user["username"];
$_SESSION["just_logged_in"]=true;

header("Location: index.php");
exit();


}else{

$errorNameandPass= "Incorrect username or password!";

}

}else{

$errorNameandPass= "Incorrect username or password!";
}

}
}

}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
    <title>Document</title>
</head>
<body class="register-page">




<div class="container min-vh-100 d-flex justify-content-center align-items-center">

    <div class="card shadow p-4" style="max-width: 450px; width: 100%; height: 450px;">

        <form method="POST" action="login.php">

           <ul class="list-unstyled gap-3 ">

<h3 class="mb-3"> Login</h3>

<li class="mb-2">
    <label for="username" class="form-label"> username:  </label>
<input type="text" name="username" placeholder="username" class="form-control">
</li>


<li class="mb-2">
    <label for="password" class="form-label"> password:  </label>
<input type="password" name="password" placeholder="password" class="form-control">
</li>

</ul>




<button type="submit"  class="loginReg"> Login </button>

<br>


<p id="loginWarning" class="loginerror">

<?php echo $emptyField ?? ""; ?>
<?php echo $errorNameandPass ?? ""; ?>

</p>

<br>

<label>Don't have an account? </label>
<a href="register.php" class="login"> Sign up </a>
      
</form>

    </div>

</div>












    
</body>
</html>