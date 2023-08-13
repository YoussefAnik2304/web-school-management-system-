<?php


//    var_dump($_POST);
   if(!empty($_POST) && !empty($_POST['module1'])){
   include_once './connexion2.php';
   $query=$bd->prepare("INSERT INTO semester (id,semester_number,start_date,end_date,module1,module2,module3,module4,module5,module6,module7,filliere_id) VALUES (null,?,?,?,?,?,?,?,?,?,?,?)");     
     $query->execute([$_POST['semester_number'],$_POST['start_date'],$_POST['end_date'],$_POST['module1'],$_POST['module2'],$_POST['module3'],$_POST['module4'],$_POST['module5'],$_POST['module6'],$_POST['module7'],$_GET['filliere_id']]);
  $id=$_GET['filliere_id'];
   header("location:./semester.php?id=$id");
   exit();
   }
   else{
   // header('location:erreur.html');
   }
?>
>