<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>      



            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <h3>User ID: <input type="text" name="id"></h3>
                <h3>Your Name: <input type="text" name="name"></h3>
                <h3>Enter Age: <input type="text" name="age"></h3>
                <input type="submit" value="Submit">

            </form>

            <?php
          

            function readXlsxFile($filePath)
            {
                // Open the .xlsx file as a zip archive
                $zip = new ZipArchive;
                if ($zip->open($filePath) === TRUE) {
                    // Try to extract the shared strings XML
                    $sharedStringsXml = $zip->getFromName('xl/sharedStrings.xml');
                    $sharedStrings = [];
                    if ($sharedStringsXml !== false) {
                        // Parse the shared strings XML
                        $sharedStringsXmlObj = simplexml_load_string($sharedStringsXml);
                        foreach ($sharedStringsXmlObj->si as $sharedString) {
                            $sharedStrings[] = (string) $sharedString->t;
                        }
                    }
            
                    // Try to extract the main sheet XML
                    $sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
                    if ($sheetXml === false) {
                        echo "Failed to find the sheet XML.";
                        return;
                    }
            
                    // Close the zip archive
                    $zip->close();
            
                    // Load the XML and parse it
                    $xml = simplexml_load_string($sheetXml);
                    $namespaces = $xml->getNamespaces(true);
            
                    // Register namespaces
                    $xml->registerXPathNamespace('a', $namespaces['']);
            
                    // Start the HTML table
                    echo "<table border='1'>";
            
                    // Iterate over each row
                    foreach ($xml->sheetData->row as $row) {
                        echo "<tr>"; // Start a new table row
            
                        // Iterate over each cell in the row
                        foreach ($row->c as $cell) {
                            $value = (string) $cell->v; // Get the cell value
            
                            // Check if the cell value is a shared string
                            if (isset($cell['t']) && $cell['t'] == 's') {
                                // Convert the value using the shared strings array
                                $value = $sharedStrings[(int) $value];
                            }
            
                            echo "<td>" . htmlspecialchars($value) . "</td>"; // Output the value in a table cell
                        }
                        echo "</tr>"; // End the table row
                    }
            
                    // End the HTML table
                    echo "</table>";
                } else {
                    echo "Failed to open the .xlsx file.";
                }
            }
            
            // Specify the path to your .xlsx file
            $filePath = 'file.xlsx';
            readXlsxFile($filePath);
            
            echo "<br><br><br><br><br><br><br><br><br><br>";
            // $str = readline("Type something:");
            // echo $str;
            
            
            echo "<br><br><br><br><br><br><br><br><br><br>";
            session_start();

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $_SESSION['ID'] = $_POST['id'];
                $_SESSION['Name'] = $_POST['name'];
                $_SESSION['Age'] = $_POST['age'];
            }
                echo"Following Session Variables Created: \n";

                foreach($_SESSION as $key=>$value){
                    echo "<h3>".  $key . "=>". $value . "</h3>";
                    
                }
                echo "<br>". '<a href="msg.php">Click Here</a>';


              
                echo "<br><br><br><br><br><br><br><br><br><br>";

                $u = $_POST['id'];
                setcookie("id", $u);
                echo $u;
            ?>




            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
           
            <!-- <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="cook" id="" value = ""><br><br>
            <input type="submit" value="Set">
            </form>

            <br><br><br><br>
            <form action="" method="post" enctype="multipart/form-data">
            <form action="hello.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="files[]"/>
            <input type="file" name="files[]"/>
            <input type ="submit" value="submit"/>
   </form>
            </form>
            <br><br>
            <button id="files" onclick="Hello()">Hello</button>
            
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="get">
            <input type="text" name="gfname" id="" value = "KAEDE"><br><br>
            <input type="text" name="glname" id="" value="LAGS"><br><br>
            <input type="submit" value="GET">
            </form>
            <br><br><br> -->

            <!-- <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <input type="text" name="fname" id=""><br><br>
            <input type="text" name="lname" id=""><br>
            <input type="submit" value="Submit">
            </form> -->
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
            

<?php       







            





            // $_SESSION[ "address"]="tacloban";

            // echo $_SESSION[ "address"];

            // foreach ($_SESSION as $key=>$val){
            // echo $key . " => " . $val;
            // }


            echo "<br><br><br><br>";
            $h = $_POST['cook'];
            setcookie("cook", $h);
            echo     $_COOKIE["cook"];
            echo "<br><br><br><br>";
           
           

           
            
             echo "<br><br><br><br>";

            echo "Path: " . $_ENV['Path'];
            echo "<br><br><br><br>";

            foreach ($_FILES["files"]["name"] as $key => $val) {       
                echo "File uploaded: $val <br>";

            }
 echo "<br><br><br><br>";
 echo "Filename: " . $_FILES['files']['name']."<br>";
//  echo "Type : " . $_FILES['file']['type'] ."<br>";
//  echo "Size : " . $_FILES['file']['size'] ."<br>";
//  echo "Temp name: " . $_FILES['file']['tmp_name'] ."<br>";
//  echo "Error : " . $_FILES['file']['error'] . "<br>";



            
            echo "<br><br><br><br>";




            if($_SERVER['REQUEST_METHOD'] == "POST"){
              echo  $_REQUEST["fname"] . "<br>";
              echo $_REQUEST["lname"];
            }
            echo "<br><br>"; 
            
            echo $_GET['gfname'];
            echo "<br>";
            echo $_GET['glname'];

            // echo "<br><br>"; 
            // echo $_POST['fname'];
            // echo "<br>";
            // echo $_POST['lname'];


           

             echo "<br><br><br><br>";

            $std2 = ["name" => "K", "age" => 24, "gender" => "Male"];
            foreach($std2 as $res =>$val){
                echo $res ."=>" . $val . "<br>";
            }
            echo "<br><br><br><br>";
            
            $std = ["Name", "Age", "Address", "Birthdate"];
            foreach($std as $res =>$val){
                echo $val . "<br>";
            }

            echo "<br><br><br><br>";

            print date("m/d/y G.i:s \n", time()) . PHP_EOL;
            print "<br>Today is ";
            echo "<br>";
            print date("j of F Y, \a\\t g.i a \n", time());

           echo "<br><br><br><br>";

           $a = 1234; 
           echo "1234 is an Integer in decimal notation: $a\n";
        
           $b = 0123; 
           echo "0o123 is an integer in Octal notation: $b\n";
        
           $c = 0x1A; 
           echo "0xaA is an integer in Hexadecimal notation: $c\n";
        
           $d = 0b1111;
           echo "0b1111 is an integer in binary notation: $d";


           
            echo "<br><br><br><br>";


           echo strpos("Hello!","lo");
           echo "<br><br><br><br>";
          

           
            echo strlen("Hello world!");
             echo "<br><br><br><br>";

            $str = 'This is a \'simple\' string';
            $str2 = "I have a \$100k in my bank account";
            echo $str2;
            echo "<br><br><br><br>";
 
            $x="Hello World";
            echo "$x. Current PHP script name is " . __FILE__ . ". <br>";
            $x="Hello World";
            echo "$x. Current PHP script line is " . __LINE__ . ".<br>";
            $x="Hello World";
            echo "$x. Directory of the Current PHP script name is " . __DIR__ . ".<br>";
            // function hello(){    
            //     $x="Hello World";  
            //     echo "$x. The function name is ". __FUNCTION__ . "";   
            //  } 
            //  hello();   

            echo "<br><br><br><br>";

            $names = array("KEN", "JAMES", "LENI", "KATY", "CLARK");       
            $revnames =  array_reverse($names);
            $food = ["Chocolate", "Chicken", "Fish", "Dog", "Pork"];
            $age = array(28, 12, 43, 34, 45);
            
            $choice = 3;





            for($i = 0; $i < count($age); $i++){
                $agen = (double)$age[$i];
                echo $agen. "<br>"; 
            }
        echo "<br><br><br><br>";
        // var_dump($names);

        // echo count($names) . "<br/>";
        array_reverse($names);

         for($i = 0; $i<count($names); $i++){
            echo $age[$i] . "&nbsp&nbsp&nbsp&nbsp";
            // echo $revnames[$i] . "&nbsp&nbsp&nbsp&nbsp";
            printf("%s\t\t", $revnames[$i]);
            // echo $names[$i] . "&nbsp&nbsp&nbsp&nbsp"; 
            echo"<br>";
        }

        echo "<br><br><br><br>";

        switch($choice){
            case 1:
                echo "Displays All Information <br>";
                for($i = 0; $i<count($names); $i++){
                    echo $i . "==> " . $age[$i] . "&nbsp&nbsp&nbsp&nbsp";
                    echo $names[$i] . "&nbsp&nbsp&nbsp&nbsp"; 
                    echo"<br>";
                }
                break;
                
            case 2:
                echo "Displays Age Only <br>";
                for($i = 0; $i<count($age); $i++){
                    echo $i . "==> " . $age[$i] . "&nbsp&nbsp&nbsp&nbsp";
                    echo"<br>";
                }
                break;
            
            case 3:
                echo "Displays Names Only <br>";
                for($i = 0; $i<count($names); $i++){
                    echo $i . "==> " . $names[$i] . "&nbsp&nbsp&nbsp&nbsp"; 
                    echo"<br>";
                }
                break;
        
        }


    
        // for($i = 0; $i<count($names); $i++){
        //     echo $age[$i] . "&nbsp&nbsp&nbsp&nbsp";
        //     echo $names[$i] . "&nbsp&nbsp&nbsp&nbsp"; 
        //     echo"<br>";
        // }
 ?>
</body>
</html>
<style>
    *{
        color: limegreen;
    }
    body{
        background: black;

    }
</style>
<script>
                    function Hello() {
                    document.getElementById("files").innerHTML = "Kupal";
                    document.getElementById("files").style.color = 'black';
                    document.getElementById("files").style.borderRadius = '12px';
                    document.getElementById("files").style.padding = '12px';
                    
                    }
            </script>