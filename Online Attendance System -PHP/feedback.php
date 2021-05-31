<?php

$conn = mysqli_connect( 'localhost', 'root', '', 'attendance') or die( 'Database Connect Error' );
$name = mysqli_real_escape_string($conn,$_POST['name']);
$feedback = mysqli_real_escape_string($conn,$_POST['feedback']);

$sql = "INSERT INTO feedback (Name, Comment) VALUES ('$name','$feedback')";

if ( mysqli_query( $conn, $sql ) ) {
    echo"<script type='text/javascript'>window.alert('Thank For Your Feedback ');window.location='index.html';</script>";
} else {
    echo ( 'Something Went Wrong'. mysqli_error( $conn ) );
}
mysqli_close( $conn );
?>

