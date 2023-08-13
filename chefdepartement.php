<?php
include_once './db_conn.php';
$title = 'Chef departement';
require_once './includes/head.php';

// Fetch professors with the role "chefdepart"
$professeurs = $pdo->query("SELECT p.id_professeur, p.nom_professeur, p.prenom_professeur, d.nom_departement, p.specialite
                           FROM professeur AS p
                           INNER JOIN departement AS d ON p.departement_id = d.id_departement
                           WHERE p.role = 'chefdepart'")->fetchAll(PDO::FETCH_ASSOC);

// Update professor role
if (isset($_POST['changer_role'])) {
    $idProfesseur = $_POST['id_professeur'];

    // Update the role of the professor to "prof"
    $pdo->query("UPDATE professeur SET role = 'prof' WHERE id_professeur = $idProfesseur");

    // Redirect to the same page to update the table
    header('Location: chefdepartement.php');
}
?>

<body>
    <?php include_once './sidebar.php'; ?>

    <div class="merg container" style="height: 640px">
        <div class="container">
            <div class="home-content">
                <a href="./ajouterchef.php" class="link btn btn-success bnt-sm float-end">Ajouter</a>
                <table class="table">
                    <h1>Liste des Chefs de Département</h1>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">NOM/Prenom</th>
                            <th scope="col">Département</th>
                            <th scope="col">Spécialité</th>
                            <th>Opération</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php foreach ($professeurs as $professeur) : ?>
                            <tr>
                                <td><?php echo $professeur['id_professeur']; ?></td>
                                <td><?php echo $professeur['nom_professeur'] . ' ' . $professeur['prenom_professeur']; ?></td>
                                <td><?php echo $professeur['nom_departement']; ?></td>
                                <td><?php echo $professeur['specialite']; ?></td>
                                <td>
                                    <form method="POST">
                                        <input type="hidden" name="id_professeur" value="<?php echo $professeur['id_professeur']; ?>">
                                        <button class="btn btn-danger btn-sm" type="submit" name="changer_role" onclick="return confirm('Confirmer le changement de rôle')">supprimer</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
<?php include_once './includes/script.php' ?>
