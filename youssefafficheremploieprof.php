<?php
    $title = 'gestion prof';
    require_once './includes/head.php';
    require_once 'db_conn.php';
    include_once './sidebar.php';
?>

<div class="main-block container">
    <div class="container" style="height: 640px">
        <div class="home-content">
        <div class="alert alert-primary" role="alert">
 Emploie des profs
</div>
            <?php
                // Prepare the SQL query
                $sql = "SELECT id_professeur,nom_professeur FROM professeur";
                $stmt = $pdo->prepare($sql);
                $stmt->execute();

                echo "<table style='border-collapse: collapse; width: 100%;'>
                        <colgroup>
                            <col width='100'/>
                            <col width='100'/>
                            <col width='100'/>
                            <col width='100'/>
                            <col width='100'/>
                        </colgroup>";

                // Iterate over the fetched data to generate rows
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $idprofesseur = $row['id_professeur'];
                    $nomprofesseur = $row['nom_professeur'];

                    echo "
                        <tr>
                            <th style='border: 1px solid black; padding: 8px;' id='th$idprofesseur'>$idprofesseur</th>
                            <td style='border: 1px solid black; padding: 8px;' id='td$nomprofesseur'>$nomprofesseur</td>
                            <td style='border: 1px solid black; padding: 8px;'>
                                <form action='youssefafficheremploieprof2.php' method='POST'>
                                    <input type='hidden' name='professeur_id' value='" . $idprofesseur . "'>
                                    <input type='hidden' name='semestre' value='1'>
                                    <input type='submit' name='submit1' value='Semestre 1'>
                                </form>
                            </td>
                            <td style='border: 1px solid black; padding: 8px;'>
                                <form action='youssefafficheremploieprof2.php' method='POST'>
                                    <input type='hidden' name='professeur_id' value='" . $idprofesseur . "'>
                                    <input type='hidden' name='semestre' value='2'>
                                    <input type='submit' name='submit2' value='Semestre 2'>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</table>";
            ?>
        </div>
    </div>
</div>
