<?php
$title = 'Add New Annonce';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the form data
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $date_publication = $_POST['date_publication'];

    // Insert the new annonce into the database
    $sql = "INSERT INTO annonce (titre, description, date_publication) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$titre, $description, $date_publication]);

    // Redirect to the page displaying all annonces after successful insertion
    header("Location: homeadmin.php");
    exit();
}
?>

<div class="container" style="height:640px">
    <div class="home-content">
        <div class="alert alert-info" role="alert">
            <strong>Add New Annonce</strong>
        </div>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="titre" class="form-label">Titre</label>
                <input type="text" class="form-control" id="titre" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="date_publication" class="form-label">Date de publication</label>
                <input type="date" class="form-control" id="date_publication" name="date_publication" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Annonce</button>
        </form>
    </div>
</div>
</body>
</html>
