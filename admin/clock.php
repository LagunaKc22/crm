

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Time Record</title>
</head>
<body>
   <?php
   include '../conn.php';
   $result = $conn->query("SELECT * FROM time_record WHERE id = '1'");
   $user = $result->fetch_assoc();

   $dbtime = $user['time_in'];
   $time = new DateTime($dbtime);
   $dbformatted = $time->format(format: 'g:i A');


   if($_SERVER['REQUEST_METHOD'] === 'POST') {
      $btn = $_POST['val'];
      switch($btn){
         case 'tin':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = 'INSERT INTO time_record (time_in) VALUES (?)';
               $stmt = $conn->prepare($record);
               $stmt->bind_param("s", $current);
               $stmt->execute();

               $dateTime = new DateTime($current);
               $formatted = $dateTime->format('g:i A');

               echo $current;
               echo '<br> You choosed Time In';
              
            break;
         case 'bstart':
               date_default_timezone_set("Asia/Manila");
               $current = date("Y-m-d H:i:s");

               $record = "UPDATE time_record SET break_start = ? WHERE id = '1'";
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

               $record = "UPDATE time_record SET break_end = ? WHERE id = '1'";
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

               $record = "UPDATE time_record SET time_out = ? WHERE id = '1'";
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
        
         $in = $user['time_in'];
         $out = $user['time_out'];
         
         $time_in = new DateTime($in);
         $time_out = new DateTime( $out);
         
         $formattedIn = $time_in->format('g:i A');
         $formattedOut = $time_out->format('g:i A');



         $interval = $time_in->diff($time_out);

         
         $totalTime = ($interval->h + ($interval->days * 24)) . 'hrs ' . $interval->i . 'min';
         $hours = $interval->h + ($interval->days * 24);
         $minutes = $interval->i;

         $days = floor($hours / 24);
         $remainingHours = $hours % 24;

         $remainingMinutes = $minutes;

         echo "<br><br>";
         
         echo "$days days $remainingHours hours $remainingMinutes mins";

         echo "<br><br>";
         
         echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min";
         echo "<br><br>";
         echo "In: " . $formattedIn . "<br>";
         echo "Out: " . $formattedOut . "<br>";

         echo "Total Time ".$totalTime . "<br>";
      





               $records = "UPDATE time_record SET totaltime = ? WHERE id = '1'";
               $stmt = $conn->prepare($records);
               $stmt->bind_param("s", $totalTime);
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


   <form action ="<?php $_SERVER['PHP_SELF']; ?>" method="post">
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
      <!-- <h3><?php #echo $user['time_in']; ?></h3> -->
      <h3><?php #echo "Total Time ".$totalTime ?></h3>
      <h3><?php #echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min"; ?></h3>
      <h3><?php #echo $dbformatted; ?></h3>
      <h3><?php #echo $current; ?></h3>
   </form>
</body>
</html>
