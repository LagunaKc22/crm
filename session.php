<?php 
  session_start();
  if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true){

    if($_SESSION['usertype'] === 'admin'){
         header('Location: admin/dashboard.php');
    }else{
         header('Location: user/dashboard.php');
    }
 
    exit();
  }
?>