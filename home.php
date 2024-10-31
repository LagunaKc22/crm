<?php

    include 'tailwind.php';
    session_start();
    if(!isset($_SESSION['username']) || $_SESSION['username'] == !true){
        header("location: index.php");
        exit();
    }
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>

<?php include 'components/topnav.php'; ?>
<?php include 'components/sidenav.php'; ?>


    <?php echo $_SESSION["username"]; ?>
    <a href="logout.php">Logout</a>

    
</body>
</html>

<style>
    .con{
        border: 1px solid ;

    }
    .grid-container {
        display: grid;
        grid-template-columns: 4fr 2fr 1fr 1fr;
        grid-template-rows: 150px 150px;
    }
    .container-0{
        grid-column: 1/3;
        grid-row: 1;
    }
</style>