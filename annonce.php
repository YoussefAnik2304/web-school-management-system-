<?php
$title = 'All ANNONCES';
include_once './includes/head.php';
include_once './sidebar.php';
include './db_conn.php';
?>

<div class="container" style="height:640px">
    <div class="home-content">
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Toutes les annonces</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <a href="addanonce.php" class="link btn btn-success bnt-sm float-end"> Ajouter</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Titre</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date de publication</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Select all rows from the "annonce" table
                $sql = "SELECT * FROM annonce";
                $result = $pdo->query($sql);

                // Display the data
                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<th scope='row'>" . $row['id'] . "</th>";
                    echo "<td>" . $row['titre'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "<td>" . $row['date_publication'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
