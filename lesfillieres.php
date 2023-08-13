<?php
$title = 'FILLIERES';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';
?>

<div class="container" style="height:640px">
    <div class="home-content">
        <a href="./ajouterFilier.php" class="link btn btn-success bnt-sm float-end"> Ajouter</a>
        <table class="table">
            <h1>Liste des Filiers</h1>
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">NOM DE FILIER</th>
                    <th scope="col">Description</th>
                    <th scope="col">Departement</th>
                    <th scope="col">CHEF DE Filier</th>
                    <th>Operation</th>
                    <th>Semester</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
            <?php
$query = "SELECT F.id_filiere, F.nom_filiere, F.id_departement, F.description,C.id_coordonnateur, C.id_filiere, C.id_professeur,P.id_professeur, P.nom_professeur, P.prenom_professeur, P.email_professeur, P.role, P.password_professeur,D.id_departement, D.nom_departement FROM filiere F 
INNER JOIN coordonnateur C ON C.id_filiere=F.id_filiere
INNER JOIN professeur P  ON C.id_professeur=P.id_professeur
INNER JOIN departement D ON D.id_departement=F.id_departement";

$statement = $pdo->query($query);
$count = 1;

while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $count++ . "</td>";
    echo "<td>" . $row['nom_filiere'] . "</td>";
    echo "<td>" . $row['description'] . "</td>";
    echo "<td>" . $row['nom_departement'] . "</td>";
    echo "<td>" . $row['nom_professeur'] . " " . $row["prenom_professeur"] . "</td>";
    echo "<td>";
    echo "<form method='POST'>";
    echo "<a href='./modifierfilier.php?id=" . $row['id_filiere'] . "&departement_id=" . $row['id_departement'] . "&coordonnateur_id=" . $row['id_coordonnateur'] . "' class='btn btn-primary btn-sm' type='submit'>Modifier</a>";
    echo "</form>";
    echo "</td>";
    echo "<td>";
    echo "<a href='semesterdesfilier.php?id=" . $row['id_filiere'] . "&departement_id=" . $row['id_departement'] . "&coordonnateur_id=" . $row['id_coordonnateur'] . "' class='btn btn-warning btn-sm' type='submit'>About semester</a>";
    echo "</td>";
    echo "</tr>";
}
?>

            </tbody>
        </table>
    </div>
</div>

<?php include_once './sidebar.php'; ?>
<?php include_once './includes/script.php' ?>

</body>
</html>
