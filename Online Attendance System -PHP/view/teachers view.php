
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Teachers Home</title>
  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <img src="../assets/Images/logo.png" class="logo" />
    <div id="wrapper">
        <div id="header">
            <h1>All Teachers</h1>
        </div>
        <div id="menu">
            <ul>
                
                <li>
                    <a href="../view/Attendance_view.php">Check Attendance</a>
             
                </li>
                <li>
                    <a href="../videoStream.html">on camera</a>
             
                </li>
            </ul>
        </div>
	</div>


<div id="main-content">
    <h2>All Records</h2>

    <?php 
        //Connection
        $conn= mysqli_connect("localhost", "root","", "attendance") or die("Connection failed");

        //Run SQL quary
        $sql= "select * from teacher";
        $result= mysqli_query($conn, $sql) or die("Query unseccesful"); 
        if (mysqli_num_rows($result) > 0) {
    ?>
        
    <table cellpadding="7px">
        <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Depertment</th>
            <!--<th>Action</th>-->
        </thead>
        <tbody>
        <?php
            while($row = mysqli_fetch_assoc($result)){

        ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['email'];?></td>
                <td><?php echo $row['phone'];?></td>
                <td><?php echo $row['dept'];?></td>
                <!--
                <td>
                    <a href='edit.php?id=<?php echo $row['id'];?>'>Edit</a>
                    <a href='delete-inline.php?id=<?php echo $row['id'];?>'>Delete</a>
                </td>
            -->
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
</div>
</body>
</html>
