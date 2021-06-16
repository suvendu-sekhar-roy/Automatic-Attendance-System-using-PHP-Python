<?php
//start session
session_start();

//connect to db
$db=mysqli_connect('localhost','root','','attendance') or die("Can't connect database");

//Registered users
$name=mysqli_real_escape_string($db, $_POST['name']);
$email=mysqli_real_escape_string($db, $_POST['mail']);
$phone=mysqli_real_escape_string($db, $_POST['phone']);
$qualification=mysqli_real_escape_string($db, $_POST['qualification']);
$dept=mysqli_real_escape_string($db, $_POST['dept']);
$password=mysqli_real_escape_string($db, $_POST['pass']);
$repassword=mysqli_real_escape_string($db, $_POST['repass']);

//form validation

if ($password != $repassword) {
echo"<script type='text/javascript'>window.alert('Password Does Not Match,Please Try Again');window.location='../signup/signup as teacher.html';</script>";
}

//Check db for existing user with same username

//$user_check_query="SELECT * FROM teacher WHERE name='$name' or email='$email' LIMIT 1"; 
$user_check_query="SELECT * FROM teacher WHERE email='$email' or phone='$phone' LIMIT 1"; 

$results = mysqli_query($db, $user_check_query) or die("Query unseccesful"); 
$user = mysqli_fetch_assoc($results);


if($user){
    if ($user['email']===$email){ 
        echo"<script type='text/javascript'>window.alert('Email Alraedy exists');window.location='../signup/signup as teacher.html';</script>";
    }

    if ($user['phone']===$phone){ 
        echo"<script type='text/javascript'>window.alert('Phone Number Alraedy exists');window.location='../signup/signup as teacher.html';</script>";
    }
}
//Register the user if no error


//$password=md5($password_1); //md5 will encrypt the password
$query= "INSERT INTO teacher (name, email, phone, qualification, dept, password) VALUES ('$name','$email','$phone','$qualification','$dept','$password')";

mysqli_query($db,$query);

// $_SESSION['username']=$username;

//header('location: login.html');  
$_SESSION['success']= "You have registered successfully";
echo"<script type='text/javascript'>window.alert('You have registered succesfully');window.location='../login/login as teacher.html';</script>";


?>



