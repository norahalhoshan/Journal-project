<?php
session_start();


require_once "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

if(isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])){


$username=$_POST["username"];
$email=$_POST["email"];
$password=$_POST["password"];


$passLenError="";
$emptyField="";
$emailError="";
$usernameError="";
$error="";

if(empty($username) || empty($email) || empty($password)){

$emptyField= "please fill in the form!";

} elseif(strlen($password) < 8){

$passLenError= " Password must be at least 8 characters";

}else{


$sql="SELECT * from users where email=?";

$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$email);
$stmt->execute();

$result=$stmt->get_result();


if($result->num_rows>0){
    $emailError= "this email was already registered!";
}else{


$sql="SELECT * from users where username=?";

$stmt=$conn->prepare($sql);
$stmt->bind_param("s",$username);
$stmt->execute();

$result=$stmt->get_result();


if($result->num_rows > 0){
    $usernameError= " This username already exists. Choose another one";
}else{



$hashedpassword= password_hash($password, PASSWORD_DEFAULT);



$sql="INSERT into users(username, email, password) values (?,?,?)";

$stmt=$conn->prepare($sql);
$stmt->bind_param("sss", $username, $email, $hashedpassword);

if($stmt->execute()){
    
$_SESSION["user_id"] = $conn->insert_id;
$_SESSION["username"]=$username;
header("Location: index.php");
exit();

} else{
    $error= "Registration failed!";
}

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

    <div class="card shadow p-4" style="max-width: 450px; width: 100%;">

        <form method="POST" action="register.php">

           <ul class="list-unstyled gap-3 ">

<h3 class="mb-3"> Create account</h3>

<li class="mb-2">
    <label for="username" class="form-label"> username:  </label>
<input type="text" name="username" placeholder="username" class="form-control">
</li>

<p id="usernameRegistered">

<?php echo $usernameError ?? ""; ?>

</p>

<li class="mb-2">
    <label for="email" class="form-label"> email:  </label>
<input type="email" name="email" placeholder="email" class="form-control">
</li>

<p id="emailRegistered">

<?php echo $emailError ?? ""; ?>

</p>

<li class="mb-2">
    <label for="password" class="form-label"> password:  </label>
<input type="password" name="password" placeholder="password" class="form-control">
</li>

<p id="passwordLen">

<?php echo $passLenError ?? ""; ?>

</p>

</ul>


<label class="mb-2">
<input type="checkbox" name="agreeTerms" required>
I agree to the terms and conditions

</label>


<button type="submit" class="loginReg" id="regbtn" disabled> sign up </button>

<br>



<p id="emptyField">

<?php echo $emptyField ?? ""; ?>

</p>

<p id="error">

<?php echo $error ?? ""; ?>

</p>


<label>already have an account? </label>
<a href="login.php" class="login"> login </a>
      
</form>

    </div>

</div>










<script src="script.js"></script>

    
</body>
</html>