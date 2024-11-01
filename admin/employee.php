<?php

    include '../conn.php';  



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <th>ID</th>
        <th>User Type</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Username</th>
        <th>Contact</th>
        
       
        <?php include '../php/query.php'; 
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){?>
             <tr>
           <td><?php echo $row['id']; ?></td>     
           <td><?php echo $row['user_type']; ?></td>     
           <td><?php echo $row['fname']; ?></td>     
           <td><?php echo $row['lname']; ?></td>     
           <td><?php echo $row['username']; ?></td>     
           <td><?php echo $row['contact']; ?></td>     
            </tr>
            
            
        <?php } 
            }
        ?>    
        
    </table>
</body>
</html>

