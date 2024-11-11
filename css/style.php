<?php
include '../conn.php';
include '../session/admin_session.php';
include '../admin/variable.php';


$results = $conn->query("SELECT * FROM tblstatus WHERE status_id = '1'");
$rec = $results->fetch_assoc();



$in = $rec['in_status'];
$bs = $rec['bs_status'];
$be = $rec['be_status'];
$out = $rec['out_status'];




$paddingin = $rec['btnpadin'];
$paddingbs = $rec['btnpadbs'];
$paddingbe = $rec['btnpadbe'];
$paddingout = $rec['btnpadout'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['btnTime'])) {
    $btnVal = $_POST['btnTime'];
    if ($btnVal == 'Time In'){

        $padin = '0';
        $padbs = '8';
        $padbe = '0';
        $padout = '8';


        $btnin = 'none';
        $btnbs = 'inline-block';
        $btnbe = 'none';
        $btnout = 'inline-block';

        $conn->query("UPDATE tblstatus SET in_status = '$btnin', bs_status = '$btnbs', be_status = '$btnbe', out_status = '$btnout'  WHERE status_id = '1'");
        $conn->query("UPDATE tblstatus SET btnpadin = '$padin', btnpadbs = '$padbs', btnpadbe = '$padbe', btnpadout = '$padout'  WHERE status_id = '1'");
       header('location: style.php');

    } else if($btnVal == 'Break Start'){
        $padin = '0';
        $padbs = '0';
        $padbe = '8';
        $padout = '8';
        
        
        $btnin  = 'none';
        $btnbs  = 'none';
        $btnbe  = 'inline-block';
        $btnout  = 'inline-block';

        $conn->query("UPDATE tblstatus SET in_status = '$btnin', bs_status = '$btnbs', be_status = '$btnbe', out_status = '$btnout'  WHERE status_id = '1'");
        $conn->query("UPDATE tblstatus SET btnpadin = '$padin', btnpadbs = '$padbs', btnpadbe = '$padbe', btnpadout = '$padout'  WHERE status_id = '1'");
        header('location: style.php');
    } else if($btnVal == 'Break End'){
        
        $padin = '0';
        $padbs = '0';
        $padbe = '0';
        $padout = '8';

        $btnin = 'none';
        $btnbs = 'none';
        $btnbe = 'none';
        $btnout = 'inline-block';
        $conn->query("UPDATE tblstatus SET in_status = '$btnin', bs_status = '$btnbs', be_status = '$btnbe', out_status = '$btnout'  WHERE status_id = '1'");
        $conn->query("UPDATE tblstatus SET btnpadin = '$padin', btnpadbs = '$padbs', btnpadbe = '$padbe', btnpadout = '$padout'  WHERE status_id = '1'");
        header('location: style.php');
    } else if($btnVal == 'Time Out'){
        $padin = '8';
        $padbs = '0';
        $padbe = '0';
        $padout = '0';
        
        
        
        $btnin = 'inline-block';
        $btnbs = 'none';
        $btnbe = 'none';
        $btnout = 'none';
        $conn->query("UPDATE tblstatus SET in_status = '$btnin', bs_status = '$btnbs', be_status = '$btnbe', out_status = '$btnout'  WHERE status_id = '1'");
        $conn->query("UPDATE tblstatus SET btnpadin = '$padin', btnpadbs = '$padbs', btnpadbe = '$padbe', btnpadout = '$padout'  WHERE status_id = '1'");
        header('location: style.php');
    }
    
    
    
    
    
   
}



?>

<form method="post">
   <button type="submit"  id="in" name="btnTime" value="Time In">Time In</button> 
   <button type="submit"  id="bs" name="btnTime" value="Break Start">Break Start</button> 
   <button type="submit"  id="be" name="btnTime" value="Break End">Break End</button> 
   <button type="submit"  id="out" name="btnTime" value="Time Out">Time Out</button> 
</form>

<style>
    form{
        display: flex;
        flex-direction:column;
       
    }
    button{
        width: 10%;
        /* padding: 8px; */
        border-radius: 10px;
         margin: 3px 0px;
    }
    #in{
        display: <?php echo $in?>;
        padding: <?php echo $paddingin."px"?>;
    }
    #bs{
        display: <?php echo $bs?>;
        padding: <?php echo $paddingbs."px"?>;
    }
    #be{
        display: <?php echo $be?>;
        padding: <?php echo $paddingbe."px"?>;
    }
    #out{
        display: <?php echo $out?>;
        padding: <?php echo $paddingout."px"?>;
    }
</style>