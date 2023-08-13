<?php $title = 'Coordinateur' ?>
<?php require_once './includes/head.php'; ?>
<body>
<?php include_once './sidebar.php'; ?>
<?php  include './db_conn.php'; ?>
<?php 
    
    $query= "SELECT `id_coordonnateur`, `id_filiere`, `id_professeur` FROM `coordonnateur`";
  $query=$pdo->query($query);
    $data= $query->fetchAll(PDO::FETCH_ASSOC);

?>
<div class="main-block container">
<div class="container" style="height:640px">
  <div class="home-content">
    <table class="table">
      <h1>Liste des Coordinateurs</h1>

      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">NOM / PRENOM</th>
          <th scope="col">FILIER</th>
          <th scope="col">Departement</th>
          <th>Operation</th>
        </tr>
      </thead>
      <tbody class="table-group-divider">
        <?php  $count= 1;?>
        <?php foreach($data as $data) :?>
        <tr>
          <!-- <?php var_dump($data); ?> -->
          <?php
             $idp= $data['id_professeur'];
             $idf=$data['id_filiere'];
             $query= "SELECT * FROM `professeur` WHERE id_professeur=$idp";
              $query=$pdo->query($query);
               $dataprof= $query->fetch(PDO::FETCH_ASSOC);


               $query= "SELECT * FROM `filiere` WHERE id_filiere=$idf";
               $query=$pdo->query($query);
               $datafili= $query->fetch(PDO::FETCH_ASSOC);

               $iddep= $datafili['id_departement'];
               $query= "SELECT * FROM `departement` WHERE  id_departement=$iddep";
               $query=$pdo->query($query);
               $datadepartem= $query->fetch(PDO::FETCH_ASSOC);
              
          
          
          ?>
          <th><?=  $count++ ;?></th>
          <th><?=$dataprof['nom_professeur']."-".$dataprof['prenom_professeur'];?></th>
          <td><?=$datafili['nom_filiere'];?></td>
          <td><?= $datadepartem['nom_departement']?></td>
          <td>
            <form method="POST">
              <a class="btn btn-primary btn-sm" href="modifiercoordinateur.php?idc=<?=$data['id_coordonnateur'];?>&idf=<?=$data['id_filiere'];?>&idp=<?=$data['id_professeur'];?>" type="submit"> Modifier</a>
              <!-- <a href="deletecorrdinateur.php?idc=<?=$data['id_coordonnateur'];?>" class=" btn btn-danger btn-sm" type="submit" onclick="return confirm('confirmer suppression')"> Supprimer </a> -->
            </form>
          </td>
        </tr>
        <?php endforeach ;?>
        <!-- Repeat the above code for each data row -->
      </tbody>
    </table>
  </div>
</div>

</div>
</div>
<?php  include_once './includes/script.php';?>

</body>
</html>