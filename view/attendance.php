<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <title>Attendance Record</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
    <img src="../assets/images/logo.png" class="logo" />
<div id="main-content">
    <h2>Show Records using Roll</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
            <label>Roll</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showbtn" />
    </form>

<!--Show Records using Roll-->
    <?php
        if(isset($_POST['showbtn'])){
            //Connection
    $conn= mysqli_connect("localhost", "root","", "attendance") or die("Connection failed");

    //Run SQL quary
    $stu_id=$_POST['sid'];
    $sql= "select * from student inner join record on student.Roll= record.Roll where record.Roll={$stu_id}";
    $results= mysqli_query($conn, $sql) or die("Query unseccesful"); 
    if (mysqli_num_rows($results) > 0) { ?>
        <!--if ($row=mysqli_fetch_assoc($results)){
        ?>
            <center><h3>Name: <?php //echo $row['Name']; }?></h3></center>-->
            <table cellpadding="7px">
                <thead>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Time</th>
                </thead>
                <tbody>
                    <?php while ($row=mysqli_fetch_assoc($results)){  ?>
                    
                    <tr>
                        <td><?php echo $row['Name']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td><?php echo $row['Time']; ?></td>
                    </tr>

                    <?php } ?>
                </tbody>
            </table>
        
        <?php
            }
            else{
                echo "<center><h2>No Record Found</h2></center>";
            }
            mysqli_close($conn);
            }?>
    
    <!--Show Records using Date-->

    <h2>Show Records using Date</h2>
    <form class="post-form" action="<?php $_SERVER['PHP_SELF'];?>" method="post">
        <div class="form-group">
            <label>start Date</label>
            <input type="text" name="date1" placeholder= 'yyyyy-mm-dd'/>
            <label>End Date</label>
            <input type="text" name="date2" placeholder= 'yyyyy-mm-dd'/>
           
        </div>
        <input class="submit" type="submit" name="dateshow" />
    </form>

    <?php
        if(isset($_POST['dateshow'])){
            //Connection
    $conn= mysqli_connect("localhost", "root","", "attendance") or die("Connection failed");

    //Run SQL quary
    $start_date=$_POST['date1'];
    $end_date=$_POST['date2'];
    
    $sql= "select * from student inner join record on student.Roll= record.Roll where record.Date between '{$start_date}' and '{$end_date}'";
    $result= mysqli_query($conn, $sql) or die("Date Query unseccesful"); 
    

    if (mysqli_num_rows($result) > 0) { ?>
        <table cellpadding="7px">
            <thead>
                <th>Date</th>
                <th>Roll</th>
                <th>Name</th>
                <th>Time</th>
                
            </thead>
            <tbody>
                <?php
                    while ($row=mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td> <?php echo $row['Date']; ?></td>
                    <td><?php echo $row['Roll']; ?></td>
                    <td> <?php echo $row['Name']; ?></td>  
                    <td><?php echo $row['Time'];?></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
        <?php
            }
            else{
                echo "<h2>No Record Found</h2>";
            }
            mysqli_close($conn);
            }?>
</div>
</body>
</html>
