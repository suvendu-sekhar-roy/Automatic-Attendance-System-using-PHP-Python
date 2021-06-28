<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/css/style.css" />
    
    <style>
       /* table, th, tr{
            style="font-size: 24px;
            padding: 3px 7px;
            color: black;
            background-color: #e67e22;
            border: 3px solid black;}*/
    </style>
</head>
<body>
    
    <img src="../assets/images/logo.png" class="logo" />

    <nav style="font-size: 6mm; position">
        <a href="../logout.php">Log Out</a>
    </nav>
    <div id="main-content">
        <center><h1>WELCOME</h1></center>
        <?php 
            //Connection
            $conn= mysqli_connect("localhost", "root","", "attendance") or die("Connection failed");

            //Run SQL quary
            $sql= "select * from student";
            $result= mysqli_query($conn, $sql) or die("Query unseccesful"); 
            if (mysqli_num_rows($result) > 0) {
        ?>
            
        <table>
            <thead>
                <th>Roll</th>
                <th>Name</th>
                <th>Dept</th>
                <th>Year</th>
                <th>Email</th>
                <th>Photo</th>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_assoc($result)){
                        if ($row['Roll']== $_SESSION['roll']){ 

                ?>
                <tr>
                    <td><?php echo $row['Roll']; ?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['dept'];?></td>
                    <td><?php echo $row['Year'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><img src="../uploads/<?php echo $row['image'];?>" style="width: 100px"></td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        <?php }
        
         $sql2= "select * from student inner join record on student.Roll= record.Roll where record.Roll= {$_SESSION['roll']}";
         $result2= mysqli_query($conn, $sql2) or die("Date Query unseccesful"); 
        
        ?> 
        <center><h1>Your Attendance sheet</h1></center>
     <?php
         if (mysqli_num_rows($result2) > 0) { ?>
         
             <table cellpadding="7px">
                 <thead>
                     <th>Date</th>
                     <th>Time</th>  
                 </thead>
                 <tbody>
                     <?php
                         while ($row2=mysqli_fetch_assoc($result2)){
                     ?>
                     <tr>
                         <td><?php echo $row2['Date']; ?></td> 
                         <td><?php echo $row2['Time']; ?></td>
                     </tr>
    
                     <?php } ?>
                 </tbody>
             </table>
        <?php }
        else{
            echo "<h2> No record Found</h2>";
        }
        //Close sql connection
        mysqli_close($conn);
        ?>
    </div>

</body>
</html>
