<?php $title = 'HOME' ?>
<?php require_once './includes/head.php'; ?>


<body>
    <?php include_once './sidebar.php'; ?>
    <?php include_once  './db_conn.php'; ?>

    <div class="home-content">


        <?php 
        
        
        $sql = "SELECT COUNT(*) as count FROM `professeur`";
    // Prepare the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nmbprof = $row['count'];




    $sql = "SELECT COUNT(*) as count FROM `coordonnateur`";
    // Prepare the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nmbcoordinateur= $row['count'];
    



    

    $sql = "SELECT COUNT(*) as count FROM `filiere`";
    // Prepare the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nmbfilier= $row['count'];
    
        

    $sql = "SELECT COUNT(*) as count FROM `chefdepartement`";
    // Prepare the query
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nmbchefdepartement= $row['count'];



    $sql = "SELECT COUNT(*) as count FROM `professeur` where role='chefdepart'";
    // Prepare the query
    $stmt2 = $pdo->prepare($sql);
    $stmt2->execute();
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $nmbchefdepartement2= $row2['count'];
        ?>
        <div class="overview-boxes">
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Fillieres</div>
                    <div class="number"><?php echo  $nmbfilier - 2; ?></div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from yesterday</span>
                    </div>
                </div>
                <i class='bx bx-box' style="font-size:40px"></i>


            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">Profs</div>
                    <div class="number"><?php  echo $nmbprof ;?></div>
                    <div class="indicator">
                        <i class='bx bx-up-arrow-alt'></i>
                        <span class="text">Up from yesterday</span>
                    </div>
                </div>
                <i class='bx bx-list-ul' style="font-size:40px"></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic"> Coordinateurs</div>
                    <div class="number"><?php echo $nmbcoordinateur; ?></div>
                    <div class="indicator">
                        <i class='bx bx-down-arrow-alt down'></i>
                        <span class="text">Up from yesterday</span>
                    </div>
                </div>
                <i class='bx bx-user' style="font-size:40px"></i>
            </div>
            <div class="box">
                <div class="right-side">
                    <div class="box-topic">chef departement</div>
                    <div class="number"><?php  echo $nmbchefdepartement+$nmbchefdepartement2;?></div>
                    <div class="indicator">
                        <i class='bx bx-down-arrow-alt down'></i>
                        <span class="text">Down From Today</span>
                    </div>
                </div>
                <i class='bx bx-user' style="font-size:40px"></i>
            </div>
        </div>

        <div class="sales-boxes">
            <div class="recent-sales box">
                <div class="title">Annonce</div>
                <div class="sales-details">
                    <ul class="details">
                        <li class="topic">Date</li>

                        <?php 
                     $sql = "SELECT * FROM annonce LIMIT 15";
    
                     // Execute the query
                     $result = $pdo->query($sql);
                     
                     // Fetch all rows as an associative array
                     $rows = $result->fetchAll(PDO::FETCH_ASSOC);
                     foreach ($rows as $row) {
                        echo " <h5>" . $row['date_publication'] . "<h5>";

                     }
                     
                    ?>


                    </ul>
                    <ul class="details">
                        <li class="topic">description</li>
                        <?php
                              foreach ($rows as $row) {
                                echo "<h5> " . $row['description'] . " </h5>";
        
                             }
                             
                            ?>


                    </ul>
                    <ul class="details">

                        <li class="topic">titre</li>
                        <?php
                              foreach ($rows as $row) {
                                echo "<h5> " . $row['titre'] . "<h5>";
        
                             }
                             
                            ?>

                    </ul>

                </div>
                <div class="button">
                    <a href="annonce.php">See All</a>
                </div>
            </div>
            <div class="top-sales box">

                <ul class="top-sales-details">
                    <div class="title">Recherche d'un professeur</div>
                    <div class="">
                        <div class="search">
                            <i class="fa fa-search"></i>


                            <?php




                            if (isset($_POST['searchprof'])) {
                                $profName = $_POST['profName'];

                                $sql = "SELECT * FROM professeur WHERE nom_professeur= :nom";

                                // Prepare the statement
                                $stmt = $pdo->prepare($sql);

                                // Bind the parameter
                                $stmt->bindParam(':nom', $profName);

                                // Execute the query
                                $stmt->execute();

                                // Check if any rows are returned
                             
                            ?>
                           
                            <?php


echo "<table class='table table-striped'>";
      if ($stmt->rowCount() > 0) {
        // Fetch the results as an associative array
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Display the data as desired
           
            echo "<tr><th>"."ID: " . $row["id_professeur"] ."</th>". "<br>";
            echo"<th>". "Nom et prénom   :  " . $row["nom_professeur"] ." - ". $row["prenom_professeur"] ."</th>" . "<br>";
           
            // echo "Autres détails: " . $row["autres_details"] . "<br>";
            // ...
        }
         echo "</table>";
    } else {
        echo "Aucun professeur trouvé avec ce nom.";
    }


}

?>
                           <form method="POST">
                                <input type="text" class="form-control " placeholder="Nom de profs" name="profName">
                                <button class="btn btn-primary mt-2" name="searchprof">search</button>
                            </form>
                        </div>

                    </div>

            </div>
        </div>
    </div>
    </div>
    </div>
    </section>
    <?php include_once './sidebar.php'; ?>
    <?php include_once './includes/script.php' ?>
