<?php
$title = 'gestion prof';
require_once './includes/head.php';
require_once 'db_conn.php';

include_once './sidebar.php';
?>

<head>
    <style>
        .modules {
            display: flex;
            justify-content: space-between;
            background-color: #f1f1f1;
            padding: 10px;
        }

        .modules p {
            padding: 10px;
            cursor: pointer;
        }

        .modules p:hover {
            background-color: #ddd;
        }

        th {
            border-style: solid;
            border-width: 3px;
            text-align: center;
        }

        td {
            border-style: solid;
            border-width: 2px;
            border-color: grey;
            height: 50px;
        }

        .modules {
            display: flex;
            justify-content: center;
            justify-content: space-around;
        }

        p {
            background-color: orange;
            padding: 15px;
        }
    </style>
</head>
<div class="main-block container">
    <div class="container" style="height:640px">
        <div class="home-content">
        <div class="alert alert-primary" role="alert">
	affecter module au professeur 
</div>
            <form action="youssefaffectermodule.php" method="POST" id="myForm">
                <section class="profs">
                    <?php
                    // Prepare the SQL query
                    $sql = "SELECT id_professeur, nom_professeur, prenom_professeur FROM professeur";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    echo "<table style='border-collapse: collapse; width: 100%;'>
                            <colgroup>
                                <col width='100'/>
                                <col width='100'/>
                                <col width='100'/>
                                <col width='100'/>
                            </colgroup>";

                    // Iterate over the fetched data to generate rows
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $idProf = $row['id_professeur'];
                        $nomProf = $row['nom_professeur'];
                        $prenomProf = $row['prenom_professeur'];

                        echo "
                            <tr>
                                <th style='border: 1px solid black; padding: 8px;' id='th$idProf'>$nomProf</th>
                                <td style='border: 1px solid black; padding: 8px;' id='td$idProf'></td>
                            </tr>";
                    }
                    echo "</table>";
                    ?>
                </section>
                <section class="modules">
                    <?php
                    // Prepare the SQL query
                    $sql = "SELECT module_name,id_module FROM module ";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute();

                    // Iterate over the fetched data to generate options
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $moduleName = $row['module_name'];
                        $moduleId = $row['id_module'];
                        echo "<p draggable='true' data-module-id='$moduleId'>$moduleName</p>";
                    }
                    ?>
                </section>
                <button class="btn btn-primary mb-3 my-2" id="submitBtn">Submit</button>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    var p = document.getElementsByTagName('p');
    var tdElements = document.getElementsByTagName('td');
    var dragItem = null;

    for (var i = 0; i < p.length; i++) {
        p[i].addEventListener('dragstart', dragStart);
        p[i].addEventListener('dragend', dragEnd);
    }

    for (var j = 0; j < tdElements.length; j++) {
        tdElements[j].addEventListener('dragover', dragOver);
        tdElements[j].addEventListener('dragenter', dragEnter);
        tdElements[j].addEventListener('dragleave', dragLeave);
        tdElements[j].addEventListener('drop', drop);
    }

    function dragStart(e) {
        dragItem = this.cloneNode(true);
        dragItem.setAttribute('data-module-id', this.getAttribute('data-module-id')); // Set module ID attribute
        setTimeout(() => this.style.display = "none", 0);
    }

    function dragEnd(e) {
        setTimeout(() => this.style.display = "block", 0);
        dragItem = null;
    }

    function drop(e) {
        e.preventDefault();
        if (this.innerHTML.trim() === '') {
            var moduleId = dragItem.getAttribute('data-module-id');
            dragItem.removeAttribute('data-module-id');
            this.appendChild(dragItem);

            var profId = this.id.substring(2); // Extract the professor ID from the td element's ID

            sendDataToPHP(profId, moduleId);
        }
    }

    function sendDataToPHP(profId, moduleId) {
        var xhr = new XMLHttpRequest();
        var url = "youssefsqlaffectermodule.php";
        var params = "profId=" + encodeURIComponent(profId) + "&moduleId=" + encodeURIComponent(moduleId);

        xhr.open("POST", url, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                // Request was successful
                var response = xhr.responseText;
                console.log(response); // Handle the response from PHP
            }
        };

        xhr.send(params);
    }

    function dragOver(e) {
        e.preventDefault();
    }

    function dragEnter(e) {
        e.preventDefault();
    }

    function dragLeave() {
        // You can add styling changes here if needed
    }
</script>
