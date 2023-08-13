<?php $title = 'gestion prof' ?>
<?php require_once './includes/head.php'; ?>
<?php require_once 'db_conn.php'; ?>
<head>
    <style>
        /* Module styles */
        #module_list {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin-bottom: 20px;
        }

        #module_list p {
            margin: 5px;
            padding: 10px;
            background-color: #003d99;
            color: #ffffff;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: move;
            transition: background-color 0.3s ease;
        }

        #module_list p:hover {
            background-color: #6699ff;
        }

        /* Submit button styles */
        #submitBtn {
            padding: 10px 20px;
            background-color: #003d99;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #submitBtn:hover {
            background-color: #6699ff;
        }

        /* Drag and drop styles */
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 100%;
        }

        th {
            border: 3px solid #000;
            width: 100px;
            text-align: center;
        }

        td {
            border: 2px solid #ccc;
            height: 50px;
            width: 100px;
            text-align: center;
            vertical-align: middle;
        }
    </style>
</head>
<?php include_once './sidebar.php'; ?>

<div class="main-block container">
    <div class="container" style="height: 640px">
        <div class="home-content">
            <body>
                <form id="myForm" action="save_table2.php" method="POST">
                <label for="semestre">Choose a semestre:</label>
                    <select name="semestre" id="semestre">
                        <option value='1'>1</option>
                        <option value='2'>2</option>
                    </select>
                    <table>
                        <colgroup>
                            <col width="100" />
                            <col width="100" />
                            <col width="100" />
                            <col width="100" />
                            <col width="100" />
                            <col width="100" />
                            <col width="100">
                        </colgroup>
                        <tbody>
                            <tr>
                                <th></th>
                                <th class='heure '>8:30-10:30</th>
                                <th class='heure '>10:30-12:30</th>
                                <th class='heure'>14:30-16:30</th>
                                <th class='heure'>16:30-18:30</th>
                            </tr>
                            <tr>
                                <th class="day">Monday</th>
                                <input type="hidden" name="monday">
                                <td class="day-cell" id="container"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                            <tr>
                                <th class="day">Tuesday</th>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                            <tr>
                                <th class="day">Wednesday</th>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                            <tr>
                                <th class='day'>Thursday</th>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                            <tr>
                                <th class='day'>Friday</th>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                            <tr>
                                <th class='day'>Saturday</th>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                                <td class="day-cell"></td>
                            </tr>
                        </tbody>
                    </table>
                    
                    <div id="module_list">
                        <?php
                        // Database connection configuration
                        $host = 'localhost';
                        $database = 'backend';
                        $username = 'root';
                        $password = '';
                        $idprof = $_POST['professor_id']; // Corrected the variable name to match the form field name

                        // Create a new PDO instance for database connection
                        $db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

                        // Prepare the SQL query
                        $sql = "SELECT module.module_name, enseignement.id_professeur FROM enseignement 
                                JOIN module ON enseignement.id_module = module.id_module 
                                WHERE id_professeur = :idprof";
                        $stmt = $db->prepare($sql);
                        $stmt->bindParam(':idprof', $idprof);
                        $stmt->execute();

                        // Iterate over the fetched data to generate options
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            $nom = $row['module_name'];
                            echo "<p draggable='true'>$nom</p>";
                        }
                        ?>
                    </div>
                    <!-- Submit Button -->
                    <button id="submitBtn">Submit</button>
                </form>
            </body>
        </html>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            var tdElements = document.getElementsByTagName('td');

            // Loop through each <td> element and add the class
            for (var i = 0; i < tdElements.length; i++) {
                tdElements[i].classList.add('heure');
            }

            var pElements = document.getElementsByTagName('p');
            var heureCells = document.getElementsByClassName('heure');
            var dragItem = null;

            for (var i = 0; i < pElements.length; i++) {
                pElements[i].addEventListener('dragstart', dragStart);
                pElements[i].addEventListener('dragend', dragEnd);
            }

            function dragStart(e) {
                dragItem = this.cloneNode(true);
                setTimeout(() => this.style.display = "none", 0);
            }

            function dragEnd(e) {
                setTimeout(() => this.style.display = "block", 0);
                dragItem = null;
            }

            for (var j = 0; j < heureCells.length; j++) {
                heureCells[j].addEventListener('dragover', dragOver);
                heureCells[j].addEventListener('dragenter', dragEnter);
                heureCells[j].addEventListener('dragleave', dragLeave);
                heureCells[j].addEventListener('drop', drop);
            }

            function drop(e) {
                e.preventDefault(); // Prevent the default drop behavior
                if (this.innerHTML.trim() === '') {
                    this.append(dragItem);
                }
            }

            function dragOver(e) {
                e.preventDefault();
            }

            function dragEnter(e) {
                e.preventDefault();
            }

            function dragLeave() {

            }

            var submitBtn = document.getElementById('submitBtn');
            submitBtn.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the form from submitting normally

                var tableData = saveTable();
                var jsonData = JSON.stringify(tableData);

                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'data';
                input.value = jsonData;

                var input2 = document.createElement('input');
                input2.type = 'hidden';
                input2.name = 'idprof';
                input2.value = <?php echo json_encode($idprof); ?>;

                var form = document.getElementById('myForm');
                form.appendChild(input);
                form.appendChild(input2);

                form.submit();
            });

            function saveTable() {
                var table = document.querySelector('table');
                var cells = table.getElementsByClassName('day-cell');
                var tableData = {
                    'Monday': [],
                    'Tuesday': [],
                    'Wednesday': [],
                    'Thursday': [],
                    'Friday': [],
                    'Saturday': []
                };

                // Loop through each cell
                for (var i = 0; i < cells.length; i++) {
                    var cellData = cells[i].innerText;
                    var day = cells[i].parentNode.querySelector('.day').innerText;
                    tableData[day].push(cellData);
                }

                return tableData;
            }
        </script>
    </div>
</div>
</div>
