<?php
session_start();

//connect to db
$db=mysqli_connect('localhost','root','','attendance') or die("Can't connect database");
//log in user
if (isset($_POST['submit'])){
    $roll= mysqli_real_escape_string($db, $_POST['roll']);

    $password= mysqli_real_escape_string($db, $_POST['pass']);
}

$query="SELECT * FROM student WHERE Roll='$roll' AND Password='$password'";

//$name ="SELECT Name FROM student WHERE Roll='$roll'";
$result=mysqli_query($db, $query);
//print_r($result);
if (mysqli_num_rows($result)>0){
    
    $_SESSION['roll']=$roll;
    $_SESSION['success']= "You are now logged in successfully";
    echo"<script type='text/javascript'>window.alert('You are now logged in successfully');window.location='../view/Student_view.php';</script>";
    
    //header("location: ../view/Student_view.php");  
}
else{
    echo"<script type='text/javascript'>window.alert('Invalid Username or Password');window.location='../login/login as student.html';</script>";
    
}


?>





