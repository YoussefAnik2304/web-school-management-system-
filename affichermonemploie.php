<?php
    $title = 'gestion prof';
    require_once './includes/head.php';
    require_once 'db_conn.php';
    include_once './sidebar.php';
?>
<style>
    /* Custom table styles */
    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid black;
        padding: 8px;
        text-align: center;
    }

    /* Animation styles */
    @keyframes fade-in {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Apply animation to the table */
    .custom-table-container {
        animation: fade-in 0.5s;
    }
</style>
<div class="main-block container">
    <div class="container" style="height: 640px">
        <div class="home-content">
            <?php
                
                    $idprofesseur = $_SESSION['prof_id'];
                    

                    // Prepare the SQL query
                    $sql = "SELECT date, seance, module FROM emploieprof WHERE professeur = :idprof ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':idprof', $idprofesseur);
                    
                    $stmt->execute();

                    // Fetch all the data into an associative array
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Extract unique dates and seances
                    $dates = array_unique(array_column($data, 'date'));
                    $seances = array_unique(array_column($data, 'seance'));

                    if (empty($data)) {
                        echo "No modules available for the selected filiere and semestre.";
                    } else {
                        echo "<div class='custom-table-container'>
                                <table class='custom-table'>
                                    <colgroup>
                                        <col width='100'/>";

                        // Generate the horizontal headers
                        foreach ($seances as $seance) {
                            echo "<col width='100'/>";
                        }

                        echo "</colgroup>";

                        // Generate the vertical headers (dates)
                        echo "<tr>
                                <th></th>";

                        foreach ($seances as $seance) {
                            echo "<th>Seance $seance</th>";
                        }

                        echo "</tr>";

                        // Generate the table cells
                        foreach ($dates as $date) {
                            echo "<tr>
                                    <th>$date</th>";

                            $colspan = 1; // Initialize colspan as 1

                            foreach ($seances as $seance) {
                                $module = '';
                                // Search for the module corresponding to the date and seance
                                foreach ($data as $row) {
                                    if ($row['date'] === $date && $row['seance'] === $seance) {
                                        $module = $row['module'];
                                        break;
                                    }
                                }

                                // Check if the module is the same in the next seance
                                $nextSeance = $seance + 1;
                                $nextModule = '';
                                foreach ($data as $row) {
                                    if ($row['date'] === $date && $row['seance'] === $nextSeance) {
                                        $nextModule = $row['module'];
                                        break;
                                    }
                                }

                                if ($module !== '') {
                                    if ($module === $nextModule) {
                                        // Increment colspan if the module is the same in the next seance
                                        $colspan++;
                                    } else {
                                        // Output the table cell with colspan
                                        echo "<td colspan='$colspan'>$module</td>";
                                        $colspan = 1; // Reset colspan to 1
                                    }
                                } else {
                                    // Output an empty table cell
                                    echo "<td></td>";
                                }
                            }

                            echo "</tr>";
                        }

                        echo "</table>
                            </div>";
                    }
                
            ?>
        </div>
    </div>
</div>
