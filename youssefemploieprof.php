<?php $title = 'gestion prof' ?>
<?php require_once './includes/head.php'; ?>
<?php require_once 'db_conn.php';?>

<?php include_once './sidebar.php'; ?>
<head>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    button {
        display: inline-block;
        padding: 6px 12px;
        margin: 0;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.42857143;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        cursor: pointer;
        background-image: none;
        border: 1px solid transparent;
        border-radius: 4px;
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }
</style>

</head>
   <body>
<div class="main-block container">
<div class="container" style="height:640px">
<div class="home-content">

<div class="alert alert-primary" role="alert">
affecter Emploie des profs
</div>
	<!-- left container -->
	<div>

	<?php
    // Database connection configuration
    $host = 'localhost';
    $database = 'backend';
    $username = 'root';
    $password = '';

    // Create a new PDO instance for database connection
    $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

    // Fetch professors from the professeur table
    $sql = "SELECT id_professeur, nom_professeur, prenom_professeur FROM professeur";
    $result = $db->query($sql);

    echo "<table>";

    // Iterate over the fetched professors to generate rows and buttons
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "
            <tr>
                <td>" . $row['id_professeur'] . "</td>
                <td>" . $row['nom_professeur'] . "</td>
                <td>" . $row['prenom_professeur'] . "</td>
                <td>
                    <form method='post' action='youssefsubmit_prof.php'>
                        <input type='hidden' name='professor_id' value='" . $row['id_professeur'] . "'>
                        <input type='submit' value='emploie'  class='btn btn-primary mb-3 my-2'>
                    </form>
                </td>
            </tr>";
    }

    echo "</table>";
?>
