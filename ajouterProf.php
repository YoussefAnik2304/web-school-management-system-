<?php
include_once './db_conn.php';

$title = 'Ajouter Prof';
require_once './includes/head.php';

// Vérifier si le formulaire d'ajout a été soumis
// ...

if (isset($_POST['ajouter'])) {
    // Retrieve the submitted form values
    $nomProfesseur = $_POST['nom'];
    $prenomProfesseur = $_POST['prenom'];
    $emailProfesseur = $_POST['email'];
    $passwordProfesseur = $_POST['password'];
    $specialiteProfesseur = $_POST['specialite'];
    $departementProfesseur = $_POST['departement'];
    $roleProfesseur = 'Prof';
  
    // Check if a file was uploaded
    if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //   $imageFileName = $_FILES['image']['name'];

   // Specify the folder path within your project directory
$folderPath = 'C:/xampp/htdocs/eservicePro/images/';

// Generate a unique filename for the uploaded image
$imageFileName = uniqid() . '_' . $_FILES['image']['name'];

// Construct the destination file path
$imageFilePath = $folderPath . $imageFileName;

// Move the uploaded image to the specified folder
move_uploaded_file($_FILES['image']['tmp_name'], $imageFilePath);

  
      // Insert the data into the database, including the image path
      $sql = "INSERT INTO Professeur (nom_professeur, prenom_professeur, email_professeur, password_professeur, specialite, departement_id, role, image) 
              VALUES (:nom, :prenom, :email, :password, :specialite, :departement_id, :role, :image)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':nom', $nomProfesseur);
      $stmt->bindValue(':prenom', $prenomProfesseur);
      $stmt->bindValue(':email', $emailProfesseur);
      $stmt->bindValue(':password', $passwordProfesseur);
      $stmt->bindValue(':specialite', $specialiteProfesseur);
      $stmt->bindValue(':departement_id', $departementProfesseur);
      $stmt->bindValue(':role', $roleProfesseur);
      $stmt->bindValue(':image', $imageFilePath);
      $stmt->execute();
    } else {
      // Handle the case when no image was uploaded
      $sql = "INSERT INTO Professeur (nom_professeur, prenom_professeur, email_professeur, password_professeur, specialite, departement_id, role) 
              VALUES (:nom, :prenom, :email, :password, :specialite, :departement_id, :role)";
      $stmt = $pdo->prepare($sql);
      $stmt->bindValue(':nom', $nomProfesseur);
      $stmt->bindValue(':prenom', $prenomProfesseur);
      $stmt->bindValue(':email', $emailProfesseur);
      $stmt->bindValue(':password', $passwordProfesseur);
      $stmt->bindValue(':specialite', $specialiteProfesseur);
      $stmt->bindValue(':departement_id', $departementProfesseur);
      $stmt->bindValue(':role', $roleProfesseur);
      $stmt->execute();
    }
  
    // Redirect the user after the insertion
    header('Location: profs.php');
    exit();
  }
  // ...
?>  

<!-- Votre formulaire HTML -->
<!-- Assurez-vous d'avoir une connexion PDO à la base de données avant d'inclure ce code -->

<?php
$title = 'Ajouter Prof';
require_once './includes/head.php';
?>

<body>
    <?php include_once './sidebar.php'; ?>
    <div class="home-content" style="height: 640px">
        <div class="container my-4">
            <!-- <div class="home-content" style="height: 640px"> -->
            <div class="alert alert-info" role="alert">
                AJOUT D'UN PROF
            </div>

            <form method="POST" action="ajouterProf.php" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="showPassword">
                    <label class="form-check-label" for="showPassword">Afficher le mot de passe</label>
                </div>
                <div class="mb-3">
                    <label for="specialite" class="form-label">Spécialité</label>
                    <input type="text" class="form-control" id="specialite" name="specialite" required>
                </div>
                <div class="mb-3">
                    <label for="departement" class="form-label">Département</label>
                    <select class="form-control" name="departement" required>
                        <option value="">Sélectionner un département</option>
                        <?php
                            // Requête SQL pour récupérer les départements
                            $sql = "SELECT id_departement, nom_departement FROM Departement";
                            $stmt = $pdo->query($sql);

                            // Vérifier s'il y a des résultats de requête
                            if ($stmt->rowCount() > 0) {
                                // Parcourir les résultats et afficher les options du menu déroulant
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    echo "<option value='" . $row["id_departement"] . "'>" . $row["nom_departement"] . "</option>";
                                }
                            } else {
                                echo "<option>Aucun département trouvé</option>";
                            }
                            ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-3" name="ajouter">Ajouter</button>
            </form>
        </div>
    </div>
    </div>
    <script>
    // Fonction pour afficher ou masquer le mot de passe
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
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