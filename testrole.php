<?php
  if($_SESSION['prof_role']==="Prof")
     {
      include_once './includes/sidebar/sidProf.php';

     }
     else if($_SESSION['prof_role']==="coordinateur")
     {
        include_once './includes/sidebar/sidebarcoordinateur.php';
       
     }
   
     else if($_SESSION['prof_role']==="chefdepart")
     {
        include_once './includes/sidebar/sidebarRepoFilier.php';
        include_once './includes/sidebar/sidebarProf.php';
     }
     else if($_SESSION['prof_role']==="admin")
     {
      include_once './includes/sidebar/sidebarAdministrateu.php';

   }
     ?>
