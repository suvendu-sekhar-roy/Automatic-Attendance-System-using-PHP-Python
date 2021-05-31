<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/style.css">
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
    <div id="main-content">
        <h2>Student Records</h2>

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

            ?>
                <tr>
                    <td><?php echo $row['Roll']; ?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['dept'];?></td>
                    <td><?php echo $row['Year'];?></td>
                    <td><?php echo $row['email'];?></td>
                    <td><img src="C:/xampp/htdocs/Online Attendance System -PHP/uploads/<?php echo $row['image'];?>" style="width: 50px"></td>
                
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
