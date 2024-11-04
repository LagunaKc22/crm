
<?php 
   include '../conn.php';
   include '../session/admin_session.php';
   
   $id =  $_SESSION['id'];
   $fname = $_SESSION['fname'];
   $lname = $_SESSION['lname'];
   
   echo $id;
   $fullname = $fname . " " . $lname;
   echo $fullname;

  


?>
<!DOCTYPE html>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Time Record</title>
</head>
<body>
   <?php
    $result = $conn->query("SELECT * FROM time_records WHERE user_id = $id");
      $data = $result->fetch_assoc();
   // $result = $conn->query("SELECT * FROM time_records WHERE user_id = $id");
   
   

   // $dbtime = $user['time_in'];
   // $time = new DateTime($dbtime);
   // $dbformatted = $time->format(format: 'g:i A');


   if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $btn = $_POST['val'];
      switch($btn){
         case 'tin':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = 'INSERT INTO time_records (user_id,fullname,  time_in) VALUES (?,?,?)';
               $stmt = $conn->prepare($record);
               $stmt->bind_param("sss", $id, $fullname, $current);
               $stmt->execute();

               $dateTime = new DateTime($current);
               $formatted = $dateTime->format('g:i A');

               echo $current;
               echo '<br> You choosed Time In';
              
            break;
         case 'bstart':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = "UPDATE time_records SET break_start = ? WHERE user_id = $id";
               $stmt = $conn->prepare($record);
               $stmt->bind_param("s", $current);
               $stmt->execute();

               $dateTime = new DateTime($current);
               $formatted = $dateTime->format('g:i A');
         
               echo $formatted;
            echo '<br> You choosed Break Start';
            break;
         case 'bend':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = "UPDATE time_records SET break_end = ? WHERE user_id = $id";
               $stmt = $conn->prepare($record);
               $stmt->bind_param("s", $current);
               $stmt->execute();

               $dateTime = new DateTime($current);
               $formatted = $dateTime->format('g:i A');
         
               echo $formatted;
               echo '<br> You choosed Break End';
            break;
         case 'tout':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = "UPDATE time_records SET time_out = ? WHERE user_id = $id";
               $stmt = $conn->prepare($record);
               $stmt->bind_param("s", $current);
               $stmt->execute();

               $dateTime = new DateTime($current);
               $formatted = $dateTime->format('g:i A');
               $current = date("Y-m-d H:i:s");
               echo $formatted;
               echo '<br> You choosed Time out';
           
            break;
      }
        
         $in = $data['time_in'];
         $out = $data['time_out'];
         
         $time_in = new DateTime($in);
         $time_out = new DateTime( $out);
         
         $formattedIn = $time_in->format('g:i A');
         $formattedOut = $time_out->format('g:i A');

         $interval = $time_in->diff($time_out);
         $totalTime = ($interval->h + ($interval->days * 24)) . 'hrs ' . $interval->i . 'min';


         // $hours = $interval->h + ($interval->days * 24);
         // $minutes = $interval->i;

         // $days = floor($hours / 24);
         // $remainingHours = $hours % 24;

         // $remainingMinutes = $minutes;

         // echo "<br><br>";
         
         // echo "$days days $remainingHours hours $remainingMinutes mins";

         // echo "<br><br>";
         
         // echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min";
         // echo "<br><br>";
         // echo "In: " . $formattedIn . "<br>";
         // echo "Out: " . $formattedOut . "<br>";

         echo "Total Time ".$totalTime . "<br>";
      


       


         $records = "UPDATE time_records SET totalhours = ? WHERE user_id = ?";
         $stmt = $conn->prepare($records);
         $stmt->bind_param("ss", $totalTime, $id);
         $stmt->execute();
         // echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min";

        

   }
   // if($_SERVER['REQUEST_METHOD'] === 'POST') {
   //    $timestring = $_POST['time'];
   //    $dateTime = new DateTime($timestring);

   //    $formatted = $dateTime->format('g:i A');

   //    echo $formatted;
   // }
   //    date_default_timezone_set("Asia/Manila");
   //    $current = date("Y-m-d H:i:s");

         // header("location:clock.php");
         // exit();
   
   ?>


   <form action ="<?php  $_SERVER['PHP_SELF']; ?>" method="post">
      <!-- <input type="text" name="time" value="<?php #echo $user['created_at'] ?>"> -->
      <!-- <input type="text" name="time" value="<?php #echo $current; ?>"> -->
      <!--       
      <input type="submit" name="val" value="Time In" >
      <input type="submit" name="val" value="Break Start" >
      <input type="submit" name="val" value="Break End" >
      <input type="submit" name="val" value="Time Out" >-->

      <button name = "val" value="tin">IN</button>
      <button name = "val" value="bstart">Start</button>
      <button name = "val" value="bend">End</button>
      <button name = "val" value="tout">Out</button>
      <br><br>
      <h3><?php #echo $user['time_in']; ?></h3>
      <h3><?php #echo "Total Time ".$totalTime ?></h3>
      <h3><?php #echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min"; ?></h3>
      <h3><?php #echo $dbformatted; ?></h3>
      <h3><?php #echo $current; ?></h3>
   </form>
   <table>
        <th>ID</th>
        <th>User ID</th>
        <th>Full Name</th>
        <th>Time In</th>
        <th>Break Start</th>
        <th>Break End</th>
        <th>Time Out</th>
        <th>totalhours</th>
        
       
        <?php  
       
        if($result->num_rows > 0){
         while($row = $result->fetch_assoc()){?>
             <tr>
           <td><?php echo $row['id']; ?></td>     
           <td><?php echo $row['user_id']; ?></td>     
           <td><?php echo $row['fullname']; ?></td>     
           <td><?php echo $row['time_in']; ?></td>     
           <td><?php echo $row['break_start']; ?></td>     
           <td><?php echo $row['break_end']; ?></td>     
           <td><?php echo $row['time_out']; ?></td>     
           <td><?php echo $row['totalhours']; ?></td>     
            </tr>
            
            
        <?php } 
            }

        ?>    
        
    </table>
</body>
</html>
