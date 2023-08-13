<?php
include_once './db_conn.php';

// Récupérer les départements depuis la table "Departement"
$departements = $pdo->query("SELECT id_departement, nom_departement FROM departement")->fetchAll(PDO::FETCH_ASSOC);

// Variable pour stocker les professeurs du département sélectionné
$professeurs = [];

// Variable pour stocker le département sélectionné
$selectedDepartement = '';

// Vérifier si un département a été sélectionné
if (isset($_POST['nom_departement'])) {
    $nomDepartement = $_POST['nom_departement'];

    // Récupérer l'id du département sélectionné
    $idDepartement = $pdo->query("SELECT id_departement FROM departement WHERE nom_departement = '$nomDepartement'")->fetch(PDO::FETCH_COLUMN);
    // Récupérer les professeurs du département sélectionné
    $professeurs = $pdo->query("SELECT id_professeur, nom_professeur, prenom_professeur FROM professeur WHERE departement_id = $idDepartement")->fetchAll(PDO::FETCH_ASSOC);
    // Stocker le département sélectionné
    $selectedDepartement = $nomDepartement;
}

// Traitement du formulaire
if (isset($_POST['ajouter'])) {
    $nomDepartement = $selectedDepartement;
    $idProfesseur = $_POST['id_professeur'];

    // Mettre à jour le rôle du professeur sélectionné à "chefdepart"
    $pdo->query("UPDATE professeur SET role = 'chefdepart' WHERE id_professeur = $idProfesseur");

    // Vérifier si un département a été sélectionné avant d'insérer dans la table `chefdepartement`
    if (!empty($idDepartement)) {
        $pdo->query("INSERT INTO chefdepartement (id_professeur, id_departement) VALUES ($idProfesseur, $idDepartement)");
    }

    header('Location: chefdepartement.php');
    exit;
}
?>
<?php $title = 'Ajouter chef departement' ?>
<?php require_once './includes/head.php'; ?>
<body>
    <?php include_once './sidebar.php'; ?>
    <div class="home-content" style="height: 640px">
        <div class="container my-4">
            <div class="alert alert-warning" role="alert">
                ADD CHEF DEPARTEMENT
            </div>
            <form action="" method="POST" class="form">
                <div class="form-group">
                    <label for="nom_departement">Département</label>
                    <select class="form-control" name="nom_departement" id="nom_departement">
                        <?php foreach ($departements as $departement) : ?>
                            <option value="<?php echo $departement['nom_departement']; ?>" <?php if ($selectedDepartement === $departement['nom_departement']) echo 'selected'; ?>><?php echo $departement['nom_departement']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="valider">Valider</button>
            </form>
            <form method="POST" action="" class="form">
                <div class="form-group">
                    <label for="id_professeur">Les professeurs de ce Département:</label>
                    <select class="form-control" name="id_professeur" id="id_professeur">
                        <?php if (empty($professeurs)) : ?>
                            <option disabled>Aucun professeur disponible</option>
                        <?php else : ?>
                            <?php foreach ($professeurs as $professeur) : ?>
                                <option value="<?php echo $professeur['id_professeur']; ?>"><?php echo $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur']; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <br>
                <button type="submit" class="btn btn-primary" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>

    <!-- Custom JS -->
    <script src="./js/custom.js"></script>
</body>

</html>
