<?php

session_start();

$db=mysqli_connect("localhost", "root", "", "attendance") or die("Database Connect Error");
$name=mysqli_real_escape_string($db,$_POST['name']);
$roll=mysqli_real_escape_string($db,$_POST['roll']);
$dept=mysqli_real_escape_string($db,$_POST['dept']);
$year=mysqli_real_escape_string($db,$_POST['year']);
$email=mysqli_real_escape_string($db,$_POST['email']);
$pass=mysqli_real_escape_string($db,$_POST['pass']);
$rpass=mysqli_real_escape_string($db,$_POST['repass']);

//form validation

if ($pass != $rpass) {
    echo"<script type='text/javascript'>window.alert('Password Does Not Match,Please Try Again');window.location='../signup/signup as student.html';</script>";
    }

//Check db for existing user with same username

$user_check_query="SELECT * FROM student WHERE Roll='$roll' or email='$email' LIMIT 1"; 
     
$results = mysqli_query($db, $user_check_query) or die("Query unseccesful"); 
$user = mysqli_fetch_assoc($results);

if($user){
    if ($user['Roll']===$roll){
        echo"<script type='text/javascript'>window.alert('Roll no already exist,Please Try Again');window.location='../signup/signup as student.html';</script>";
        }
    if ($user['email']===$email){
        echo"<script type='text/javascript'>window.alert('Email alreaday exist,Please Try Again');window.location='../signup/signup as student.html';</script>";
        }
}

if (isset($_FILES['image'])){
	
	echo "<pre>";
	print_r($_FILES['image']);
	echo "</pre>";
    
    $img_name = $_FILES['image']['name'];
	$img_size = $_FILES['image']['size'];
	$tmp_name = $_FILES['image']['tmp_name'];
	$error = $_FILES['image']['error'];

    if ($error === 0) {
		if ($img_size < 12500) {
		    {
                echo "<script type='text/javascript'>window.alert('Sorry, your file is too large');
                window.location='../signup/signup as student.html';
                </script>";
            }
        }
        else{
                echo 'File size is ok';
                $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
    
                    //$new_img_name=$img_name ;
                    $new_img_name=$roll.'.'.$img_ex;
                    //To copy uploaded images in a folder
                    $img_upload_path = '../uploads/'.$new_img_name;
				    move_uploaded_file($tmp_name, $img_upload_path);


                    $query= "INSERT INTO student (Roll,Name,dept,Year,email,Password,image) VALUES ('$roll','$name','$dept','$year','$email','$pass','$new_img_name')";
                    mysqli_query($db,$query);
                    
                    echo"<script type='text/javascript'>window.alert('You have registered successfully');window.location='../login/login as student.html';</script>";

                } 
                else{
						echo "<script type='text/javascript'>window.alert('Can't upload file of this type');
						window.location='../signup/signup as student.html';
						</script>";
                }
            }
    }
    else{
        	echo "<script type='text/javascript'>window.alert('Unknown error occured!');
				window.location='../signup/signup as student.html';
				</script>";
        }
    }
else{
    echo "<script type='text/javascript'>window.alert('What happend!');
	window.location='../signup/signup as student.html';
	</script>";
}

//Register the user if no error

//$password=md5($password_1); //md5 will encrypt the password


// $_SESSION['username']=$username;
$_SESSION['success']= "You have registered successfully";
?>




