<?php
include_once './db_conn.php';
$title = 'Modifier Prof';
include_once './includes/head.php';

// Vérifier si le formulaire de modification a été soumis
if (isset($_POST['modifier'])) {
    // Récupérer les valeurs soumises du formulaire
    $idProfesseur = $_POST['id'];
    $nomProfesseur = $_POST['nom_prof'];
    $prenomProfesseur = $_POST['prenom'];
    $specialiteProfesseur = $_POST['specialite'];
    $emailProfesseur = $_POST['email'];
    $passwordProfesseur = $_POST['password'];
    $departementProfesseur = $_POST['departement_id'];

    // Effectuer les modifications dans la base de données
    try {
        // Préparer la requête SQL avec des paramètres à remplacer
        $sql = "UPDATE Professeur SET nom_professeur = :nom, prenom_professeur = :prenom, specialite = :specialite, email_professeur = :email, password_professeur = :password, departement_id = :departement_id WHERE id_professeur = :id";
        // Préparer la requête avec PDO
        $stmt = $pdo->prepare($sql);

        // Lier les valeurs des paramètres avec les valeurs soumises du formulaire
        $stmt->bindValue(':nom', $nomProfesseur);
        $stmt->bindValue(':prenom', $prenomProfesseur);
        $stmt->bindValue(':specialite', $specialiteProfesseur);
        $stmt->bindValue(':email', $emailProfesseur);
        $stmt->bindValue(':password', $passwordProfesseur);
        $stmt->bindValue(':departement_id', $departementProfesseur);
        $stmt->bindValue(':id', $idProfesseur);

        // Exécuter la requête
        $stmt->execute();

        // Rediriger l'utilisateur vers une page appropriée après la modification
        header('Location: profs.php');
        exit();
    } catch (PDOException $e) {
        // Gérer les erreurs lors de l'exécution de la requête
        echo "Erreur lors de la modification du professeur : " . $e->getMessage();
    }
}

$idProfesseur = $_GET['id'] ?? null;


// Récupérer les informations du professeur à partir de la base de données
$sql = "SELECT id_professeur, nom_professeur, prenom_professeur, specialite, email_professeur, password_professeur, departement_id FROM Professeur WHERE id_professeur = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $idProfesseur);
$stmt->execute();
$professeur = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifier si le professeur existe
if (!$professeur) {
    echo "Professeur introuvable";
    exit;
}
?>

<body>
    <?php include_once './sidebar.php'; ?>
    <div class="home-content" style="height: 640px">
        <div class="container my-4">
            <!-- <div class="home-content" style="height: 640px"> -->
                <div class="alert alert-info" role="alert">
                    MODIFICATION D'UN PROF
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <input hidden type="number" class="form-control" id="exampleInputEmail1" name="id" value="<?php echo $professeur['id_professeur']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nom_prof" value="<?php echo $professeur['nom_professeur']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Prenom</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="prenom" value="<?php echo $professeur['prenom_professeur']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Specialite</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="specialite" value="<?php echo $professeur['specialite']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?php echo $professeur['email_professeur']; ?>">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" value="<?php echo $professeur['password_professeur']; ?>">
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="showPassword">
                        <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
                    </div>
                    <label for="exampleInputEmail1" class="form-label">Département</label>
                    <div class="mb-3">
                        <select class="formbold-form-input" name="departement_id" id="occupation">
                            <?php
                            // Requête SQL pour récupérer les départements
                            $sql = "SELECT id_departement, nom_departement FROM Departement";
                            $stmt = $pdo->query($sql);

                            // Vérifier s'il y a des résultats de requête
                            if ($stmt->rowCount() > 0) {
                                // Parcourir les résultats et afficher les options du menu déroulant
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($row['id_departement'] == $professeur['departement_id']) ? 'selected' : '';
                                    echo "<option value='" . $row["id_departement"] . "' $selected>" . $row["nom_departement"] . "</option>";
                                }
                            } else {
                                echo "<option>Aucun département trouvé</option>";
                            }
                            ?>
                        </select>
                    </div>

                   

                    <button type="submit" class="btn btn-primary mb-3" name="modifier">Modifier</button>
                    <a href="./profs.php"><button type="button" class="btn btn-secondary mb-3">Annulation</button></a>
                </form>
            </div>
        </div>
    </div>
    <script>
        // Fonction pour afficher ou masquer le mot de passe
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("exampleInputPassword1");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }

        // Écouter l'événement de clic sur la case à cocher
        var showPasswordCheckbox = document.getElementById("showPassword");
        showPasswordCheckbox.addEventListener("click", togglePasswordVisibility);
    </script>
</body>