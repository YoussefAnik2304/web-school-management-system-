<?php
include_once './db_conn.php';

$title = 'liste Profs';
require_once './includes/head.php';
?>

<body>
    <?php include_once './sidebar.php'; ?>
    <div class="merg container" style="height: 640px">
        <div class="home-content">
            <a href="ajouterProf.php" class="link btn btn-success btn-sm float-end">Ajouter</a>
            <table class="table">
                <h1>Liste des profs</h1>
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">NOM</th>
                        <th scope="col">PRENOM</th>
                        <th scope="col">EMAIL</th>
                        <th scope="col">SPECIALITE</th>
                        <th scope="col">DÉPARTEMENT</th>
                        <th scope="col">PASSWORD</th>
                        <th scope="col">OPÉRATION</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                    $sql = "SELECT Professeur.id_professeur, Professeur.nom_professeur, Professeur.prenom_professeur, Professeur.email_professeur, Professeur.password_professeur, Professeur.specialite, Departement.nom_departement, Professeur.image
                            FROM Professeur
                            JOIN Departement ON Professeur.departement_id = Departement.id_departement";

                    // Exécution de la requête SQL
                    $result = $pdo->query($sql);

                    // Vérifier s'il y a des résultats de requête
                    if ($result->rowCount() > 0) {
                        // Parcourir les résultats et afficher les informations des professeurs
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $idProfesseur = $row["id_professeur"];
                            $imagePath = $row["image"];
                            $filename = basename($imagePath); // Retrieves the filename with extension
                            $directory = dirname($imagePath); // Retrieves the directory path

                            // echo "Filename: " . $filename . "<br>";
                            // echo "Directory: " . $directory . "<br>";

                            echo "<tr>";
                            echo "<td>" . $row["id_professeur"] . "</td>";
                            echo "<td><img src='images/" . $filename . "' width='50' height='50' alt='Image'></td>";
                            echo "<td>" . $row["nom_professeur"] . "</td>";
                            echo "<td>" . $row["prenom_professeur"] . "</td>";
                            echo "<td>" . $row["email_professeur"] . "</td>";
                            echo "<td>" . $row["specialite"] . "</td>";
                            echo "<td>" . $row["nom_departement"] . "</td>";
                            echo "<td id='password_$idProfesseur'>";
                            if (isset($_GET['show_password']) && $_GET['show_password'] == $idProfesseur) {
                                echo $row["password_professeur"]; // Utilisation de la colonne "password_professeur"
                            } else {
                                echo "********";
                            }
                            echo "</td>";
                            echo "<td>";
                            echo "<div>";
                            echo "<form method='POST'>";
                            echo "<a href='./modifierProf.php?id=" . $row["id_professeur"] . "' class='btn btn-primary btn-sm mx-1'>Modifier</a>";
                            echo "<input type='hidden' name='id' value='$idProfesseur'>";
                            echo "<a href='./supprimerProf.php?id=" . $row["id_professeur"] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Confirmer suppression\")'>Supprimer</a>";
                            echo "</form>";
                            echo "</div>";
                            echo "<div class='mt-1'>";
                            echo "<form method='POST'>";
                            echo "<a href='./profs.php?show_password=" . $row["id_professeur"] . "' class='btn btn-info btn-sm' id='show_password_" . $row["id_professeur"] . "' onclick='togglePasswordVisibility(" . $row["id_professeur"] . ")'>Afficher Password</a>";
                            echo "</form>";
                            echo "</div>";
                            echo "</td>";

                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Aucun professeur trouvé.</td></tr>";
                    }

                    // Fermer la connexion à la base de données
                    $pdo = null;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    // Fonction pour afficher ou masquer le mot de passe
    function togglePasswordVisibility(idProfesseur) {
        var passwordCell = document.getElementById(`password_${idProfesseur}`);
        var showPasswordLink = document.getElementById(`show_password_${idProfesseur}`);
        var password = passwordCell.innerHTML;

        if (passwordCell.innerHTML === "********") {
            passwordCell.innerHTML = password;
            showPasswordLink.innerHTML = "Masquer";
        } else {
            passwordCell.innerHTML = "********";
            showPasswordLink.innerHTML = "Afficher";
        }
    }
    </script>
</body>
<?php include_once './includes/script.php' ?>

</html>
