
<?php
$title = 'Modifier Filiere';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';
?>
<div class="container" style="height:640px">
   <div class="home-content"> 

<?php echo "<h1>Un professeur avec cet email existe déjà.</h1>"; ?>

 <a href="./profs.php"><button type="button" class="btn btn-danger mb-3">RETOURNER</button></a>