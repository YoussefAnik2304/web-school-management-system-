<?php $title = 'gestion prof' ?>
<?php require_once './includes/head.php'; ?>
<?php require_once 'db_conn.php';?>
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
		table {
			margin-top: 20px;
		}

		th {
			border-style: solid;
			border-width: 3px;
            width :700px;
            text-align: center;
		}

		td {
			border-style: solid;
			border-width: 2px;
			border-color: grey;
			height: 50px;
			width: 700px;
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
<body>
<?php include_once './sidebar.php'; ?>

   
<div class="main-block container">
<div class="container" style="height:640px">
<div class="home-content">

	<!-- left container -->
	<div>
	<div class="alert alert-primary" role="alert">
	affecter emploie class
</div>
	<form id="myForm" method="POST" action="save_table.php">
		<label for="filiere">Choose a Filiere:</label>
		<select name="filiere" id="filiere">
			<?php
			// Database connection configuration
			$host = 'localhost';
			$database = 'backend';
			$username = 'root';
			$password = '';

			// Create a new PDO instance for database connection
			$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

			// Fetch filieres from the filiere table
			$sql = "SELECT id_filiere,nom_filiere FROM filiere";
			$result = $db->query($sql);

			// Iterate over the fetched filieres to generate options
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$nom = $row['nom_filiere'];
				$idfiliere=$row['id_filiere'];
				echo "<option value='$idfiliere'>$nom</option>";
			}
			?>
		</select>
		<br>
		<label for="semestre">Choose a semestre:</label>
		<select name="semestre" id="semestre">
			<option value='1'>1</option>
			<option value='2'>2</option>
		</select>
		<table >
			<colgroup>
				<col width="100"/>
				<col width="100"/>
				<col width="100"/>
				<col width="100"/>
				<col width="100"/>
				<col width="100"/>
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
					<input type="hidden" name="monday"><td class="day-cell" id="container"></td>
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
		<div class="modules"><?php
			// Database connection configuration
			$host = 'localhost';
			$database = 'backend';
			$username = 'root';
			$password = '';

			// Create a new PDO instance for database connection
			$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

			// Fetch filieres from the filiere table
			$sql = "SELECT id_module,module_name FROM module";
			$result = $db->query($sql);

			// Iterate over the fetched filieres to generate options
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$nom = $row['module_name'];
				echo "<p draggable='true'>$nom</p>";
			}
			?>
		</div>
        
	</div>
	<div id="output"></div>
	<!-- Submit Button -->
	<button id="submitBtn" class="btn btn-primary mb-3 my-2">Submit</button>
	</form>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
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
		/*function analyzeTableData(tableData) {
			var analysisResult = {};

			for (var day in tableData) {
				var cells = tableData[day];
				analysisResult[day] = {};

				for (var i = 0; i < cells.length; i++) {
				var cellData = cells[i];
				if (cellData.startsWith('M')) {
					var mIndex = parseInt(cellData.substring(1));
					analysisResult[day][cellData] = i + 1;
				}
				}
			}

			return analysisResult;
			}*/

			var submitBtn = document.getElementById('submitBtn');
			submitBtn.addEventListener('click', function(event) {
			event.preventDefault(); // Prevent the form from submitting normally
			
			var tableData = saveTable();
			//var analysisResult = analyzeTableData(tableData);
			
			// Convert the JavaScript object to JSON string
			var jsonData = JSON.stringify(tableData);
			
			// Create a hidden input field to store the JSON data
			var input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'data';
			input.value = jsonData;
			
			// Append the input field to the form
			var form = document.getElementById('myForm');
			form.appendChild(input);
			
			// Submit the form
			form.submit();
			});



	</script>

    
			</body>
		</html>
			
<script type="text/javascript">
	var tdElements = document.getElementsByTagName('td');

// Loop through each <td> element and add the class
for (var i = 0; i < tdElements.length; i++) {
  tdElements[i].classList.add('heure');
}
	var p=document.getElementsByTagName('p');
	var heure =document.getElementsByClassName('heure');
	var dragitem=null;

	for(var i of p){
		i.addEventListener('dragstart',dragStart);
		i.addEventListener('dragend',dragEnd);
	}
	function dragStart(e){
		dragitem=this.cloneNode(true);;
		setTimeout(()=>this.style.display ="none" ,0);
	}
	function dragEnd(e){
		setTimeout(()=>this.style.display ="block" ,0);
		dragitem=null;
	}
	for(j of heure){
		j.addEventListener('dragover',dragOver);
		j.addEventListener('dragenter',dragEnter);
		j.addEventListener('dragleave',dragLeave);
		j.addEventListener('drop',Drop);
	}
	function Drop(e) {
		e.preventDefault(); // Prevent the default drop behavior
		if (this.innerHTML.trim() === '') {
			this.append(dragitem);
			}
		}
	function dragOver(e){
		e.preventDefault();
	}
	function dragEnter(e){
		e.preventDefault();
	}
	function dragLeave(){

	}
	  
</script>