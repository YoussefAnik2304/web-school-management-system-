<?php
$title = 'Semesteres';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';

$idf = $_GET['id'];
$query = "SELECT * FROM `filiere` WHERE id_filiere = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$idf]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if ($result) {
    $nomFiliere = $result['nom_filiere'];
    echo $nomFiliere;
} else {
    echo "No filiere found for the provided id.";
}
?>

<div class="container" style="height:1340px">
    <div class="home-content">
        <div class="alert alert-warning" role="alert">
            Les modules de chaque semestre de filière
            <span style="color:blueviolet;font-size:23px"><?php echo $result['nom_filiere']; ?></span>
        </div>
        <p><a class="link-offset-2" href="ajoutersemester.php?filliere_id=<?php echo $_GET['id']?>">Ajouter Les
                Modules</a></p>

        <?php
        $query = "SELECT * FROM `semestre` WHERE filliere_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$_GET['id']]);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if(isset($_GET['id'])&& isset($_GET['departement_id'])&&isset($_GET['coordonnateur_id']))
      {
        $id = $_GET['id'];
        $departement_id = $_GET['departement_id'];
        $coordonnateur_id = $_GET['coordonnateur_id'];
      }
        ?>

        <?php if (empty($res)) : ?>
            <div class="alert alert-danger" role="alert">
                Aucun module ajouté
            </div>
        <?php else : ?>
            <?php foreach ($res as $semester) : ?>
                <button type="button" class="btn btn-primary position-relative">
                    S
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        S<?php echo $semester['semester_number']; ?>
                        <span class="visually-hidden"></span>
                    </span>
                </button>
                <div class="d-flex flex-wrap">
                    <?php
                    $query2 = "SELECT * FROM `semestremodule` WHERE id_semestre = ?";
                    $stmt2 = $pdo->prepare($query2);
                    $stmt2->execute([$semester['id']]);
                    $data = $stmt2->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <?php foreach ($data as $semestremodule) : ?>
                        <?php
                        $idModule = $semestremodule['id_module'];

                        $queryModule = "SELECT * FROM module WHERE id_module = ?";
                        $stmtModule = $pdo->prepare($queryModule);
                        $stmtModule->execute([$idModule]);
                        $resultModule = $stmtModule->fetch(PDO::FETCH_ASSOC);
                        //  var_dump($data);
                        if ($resultModule) {
                            $moduleName = $resultModule['module_name'];
                        } else {
                            echo "No module found for the provided id.";
                        }
                        ?>

                        <ol class="list-group list-group-numbered my-1 ms-1">
                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="ms-2 me-auto">
                                    <div class="fw-bold"><?php echo $moduleName; ?></div>
                                </div>
                            </li>
                        </ol>
                    <?php endforeach; ?>
                </div>

                <p><a class="link-offset-2" href="modifiersemester.php?idf=<?php echo $_GET['id'];?>&id_semester=<?php echo $semestremodule['id_semestre'];?>&id=<?=$_GET['id']?>&departement_id=<?=$departement_id?>&coordonnateur_id=<?=$coordonnateur_id?>">Modifier les Modules</a></p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once './sidebar.php'; ?>
