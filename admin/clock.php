
<?php 
   include '../conn.php';
   include '../session/admin_session.php';
   date_default_timezone_set("Asia/Manila");
   $id =  $_SESSION['id'];
   $fname = $_SESSION['fname'];
   $lname = $_SESSION['lname'];
   $today = date('Y-m-d');
   $now =  date('Y-m-d H:i:s');

   $ftoday = date('m/d/Y');
   $fnow =  date('m/d/Y, g:i:A');


   $intime =  date('Y-m-d H:i:s');
   $bstime =  date('Y-m-d H:i:s');
   $betime =  date('Y-m-d H:i:s');
   $outtime =  date('Y-m-d H:i:s');
  

   echo "Date: ". $ftoday;
   echo "<br>";
   echo "Now ".$fnow;
   echo "<br><br> ";
   echo "User ID: " .$id;
   echo "<br>";
   $fullname = $fname . " " . $lname;
   echo "User Full Name: " .$fullname;
   echo "<br> <br>";

  


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



      if(isset($_POST['val'])){
         $choice = $_POST['val'];


         echo "<br>" . $choice;
         $checking = $conn->query("SELECT * FROM time_records WHERE user_id = $id AND created_at = '$today'");
         if($checking->num_rows > 0){
            $rows = $checking->fetch_assoc();
            $time_id = $rows['id'];
            echo "<br>true<br>";
            

            switch($choice){
               case 'tin':
                  $conn->query("UPDATE time_records SET time_in = '$intime' WHERE id = $time_id");
                  echo "updates time in";
                  break;
               case 'bstart':
                  $conn->query("UPDATE time_records SET break_start = '$bstime' WHERE id = $time_id");
                  echo "updates Break Start";
                  break;
               case 'bend':
                  $conn->query("UPDATE time_records SET break_end = '$betime' WHERE id = $time_id");
                  echo "updates Break end";
                  break;
               case 'tout':
                  $conn->query("UPDATE time_records SET time_out = '$outtime' WHERE id = $time_id");
                  echo "updates time out";
                  break;
               
            }
      }else{
         if($choice == 'tin'){
                        
            // $insert = 'INSERT INTO time_records (user_id, fullname, created_at , time_in) VALUES (?,?,?,?)';
            // $res = $conn->prepare($insert);
            // $res->bind_param("ssss", $id, $fullname, $today, $now);
            // $res->execute();
            $conn->query("INSERT INTO time_records (user_id, fullname, time_in,created_at ) VALUES ('$id', '$fullname', '$now','$today')");
            echo "Inserted another entry in time_records";
            
         }
       
      }

  
     

   }

   // $time_id = $data['id'];
   // $in = $data['time_in'];
   // $out = $data['time_out'];
   
   // $time_in = new DateTime($in);
   // $time_out = new DateTime( $out);
   
   // $formattedIn = $time_in->format('g:i A');
   // $formattedOut = $time_out->format('g:i A');

   // $interval = $time_in->diff($time_out);

   // $days = $interval->days;
   // $hrs = $interval->h;
   // $min = $interval->i;
   // $totalTime = $days."days ". $hrs."hrs ". $min . "min";
   // $totalhrs = $hrs."hrs ". $min . "min";
  
   // echo "<br> Time ID: ".$time_id;
   // echo "<br> Time IN: ".$formattedIn;
   // echo "<br> Time Out: ".$formattedOut;
   // // echo "<br> Over all total: ".$overall;
   // $conn->query("UPDATE time_records SET totalhours = '$totalhrs' WHERE id = '$time_id'");
   // echo "<br>Total " .  $totalTime;

   //HERE 
// ------------------------------------------------------------------------------------------------------------------
   // if($_SERVER['REQUEST_METHOD'] === 'POST') {
   //    $btn = $_POST['val'];
   //    switch($btn){
   //       case 'tin':
   //             date_default_timezone_set("Asia/Manila");
   //             $current = date("Y-m-d H:i:s");

   //             $record = 'INSERT INTO time_records (user_id,fullname,  time_in) VALUES (?,?,?)';
   //             $stmt = $conn->prepare($record);
   //             $stmt->bind_param("sss", $id, $fullname, $current);
   //             $stmt->execute();

   //             $dateTime = new DateTime($current);
   //             $formatted = $dateTime->format('g:i A');

   //             echo $current;
   //             echo '<br> You choosed Time In';
              
   //          break;
   //       case 'bstart':
   //             date_default_timezone_set("Asia/Manila");
   //             $current = date("Y-m-d H:i:s");

   //             $record = "UPDATE time_records SET break_start = ? WHERE user_id = $id";
   //             $stmt = $conn->prepare($record);
   //             $stmt->bind_param("s", $current);
   //             $stmt->execute();

   //             $dateTime = new DateTime($current);
   //             $formatted = $dateTime->format('g:i A');
         
   //             echo $formatted;
   //          echo '<br> You choosed Break Start';
   //          break;
   //       case 'bend':
   //             date_default_timezone_set("Asia/Manila");
   //             $current = date("Y-m-d H:i:s");

   //             $record = "UPDATE time_records SET break_end = ? WHERE user_id = $id";
   //             $stmt = $conn->prepare($record);
   //             $stmt->bind_param("s", $current);
   //             $stmt->execute();

   //             $dateTime = new DateTime($current);
   //             $formatted = $dateTime->format('g:i A');
         
   //             echo $formatted;
   //             echo '<br> You choosed Break End';
   //          break;
   //       case 'tout':
   //             date_default_timezone_set("Asia/Manila");
   //             $current = date("Y-m-d H:i:s");

   //             $record = "UPDATE time_records SET time_out = ? WHERE user_id = $id";
   //             $stmt = $conn->prepare($record);
   //             $stmt->bind_param("s", $current);
   //             $stmt->execute();

   //             $dateTime = new DateTime($current);
   //             $formatted = $dateTime->format('g:i A');
   //             $current = date("Y-m-d H:i:s");
   //             echo $formatted;
   //             echo '<br> You choosed Time out';
           
   //          break;
   //    }
        
         // $in = $data['time_in'];
         // $out = $data['time_out'];
         
         // $time_in = new DateTime($in);
         // $time_out = new DateTime( $out);
         
         // $formattedIn = $time_in->format('g:i A');
         // $formattedOut = $time_out->format('g:i A');

         // $interval = $time_in->diff($time_out);
         // $totalTime = ($interval->h + ($interval->days * 24)) . 'hrs ' . $interval->i . 'min';
// -----------------------------------------------------------------------------------------------------------

         // $hours = $interval->h + ($interval->days * 24);
         // $minutes = $interval->i;

         // $days = floor($hours / 24);
         // $remainingHours = $hours % 24;

         // $remainingMinutes = $minutes;

       
       
         
         

         // echo "Total Time ".$totalTime . "<br>";
      


       


         // $records = "UPDATE time_records SET totalhours = ? WHERE user_id = ?";
         // $stmt = $conn->prepare($records);
         // $stmt->bind_param("ss", $totalTime, $id);
         // $stmt->execute();
         // echo "Total Time with separate variable: " . $hours . "hrs " . $minutes . "min";

        

   // }

   ?>


   <!-- <form action ="<?php  #$_SERVER['PHP_SELF']; ?>" method="post"> -->
    
      <!-- <button name = "val" value="tin">IN</button>
      <button name = "val" value="bstart">Start</button>
      <button name = "val" value="bend">End</button>
      <button name = "val" value="tout">Out</button> -->
      <br><br>
      
   <!-- </form> -->
      
      <!-- button -->
      <button id="btn" onclick="btnRes(this)" value="btnin">Time In</button>
      <button id="btn" onclick="btnRes(this)" value="btnbs">Break Start</button>
      <button id="btn" onclick="btnRes(this)" value="btnbe">Break End</button>
      <button id="btn" onclick="btnRes(this)" value="btnout">Time Out</button>
      <h3 id="display"></h3>

      <script>
         

               function btnRes(button){
                let val = button.value;

                  switch(val){
                     case "btnin":
                         <?php # $conn->query("UPDATE time_records SET time_in = '$intime' WHERE id = $time_id"); ?>
                        <?php $conn->query("INSERT INTO time_records (user_id, fullname, time_in,created_at ) VALUES ('$id', '$fullname', '$now','$today')");
                     //   header("location:clock.php");?>
                        alert("Time In");
                        break;
                     case "btnbs":
                        alert("Break Start");
                        break;
                     case "btnbe":
                        alert("Break End");
                        break;
                     case "btnout":
                        alert("Time Out");
                        break;
                  }
               }
             
                //     btn = document.getElementById("btn");

        
            

      </script>





   <table border="1">
        <th>ID</th>
        <th>User ID</th>
        <th>Full Name</th>
        <th>Time In</th>
        <th>Break Start</th>
        <th>Break End</th>
        <th>Time Out</th>
        <th>totalhours</th>
        
       
        <?php  
       $results = $conn->query("SELECT * FROM time_records WHERE user_id = $id");
        if($results->num_rows > 0){
         while($rec = $results->fetch_assoc()){?>
            <?php
            $in = $rec['time_in'];
            $bs = $rec['break_start'];
            $be = $rec['break_end'];
            $out = $rec['time_out'];
            // $ttime = $rec['totalhours'];

            $time_in = new DateTime($in);
            $time_bs = new DateTime($bs);
            $time_be = new DateTime($be);
            $time_out = new DateTime( $out);
   
            $formattedIn = $time_in->format('g:i A');
            $formattedbs = $time_bs->format('g:i A');
            $formattedbe = $time_be->format('g:i A');
            $formattedOut = $time_out->format('g:i A');
            
            $interval = $time_in->diff($time_out);

            $days = $interval->days;
            $hrs = $interval->h;
            $min = $interval->i;
            $totalTime = $days."days ". $hrs."hrs ". $min . "min";
            $totalhrs = $hrs."hrs ". $min . "min";
            
            // calculating the total time without seconds
            // $conn->query("UPDATE time_records SET totalhours = '$totalhrs' WHERE id = '$time_id'");
            // echo "<br>Total " .  $totalTime;
            // echo "<br>Total hrs " .  $totalhrs;
            
            
            ?>
         <tr>
            <td><?php echo $rec['id']; ?></td>     
            <td><?php echo $rec['user_id']; ?></td>     
            <td><?php echo $rec['fullname']; ?></td>     
            <!-- <td><?php #echo $rec['time_in']; ?></td>      -->
            <td><?php echo $formattedIn; ?></td>     
            <td><?php echo $formattedbs ; ?></td>     
            <td><?php echo $formattedbe ; ?></td>     
            <!-- <td><?php #echo $rec['break_end']; ?></td>      -->
            <td><?php echo $formattedOut; ?></td>     
            <td><?php echo $rec['totalhours']; ?></td>     
         </tr>
            
            
        <?php } 
            }

        ?>    
        
    </table>
</body>
</html>
