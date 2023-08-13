<?php $title = 'gestion prof' ?>
<?php require_once './includes/head.php'; ?>
   
<?php include_once './sidebar.php'; ?>

   
<div class="main-block container">
<div class="container" style="height:640px">
<div class="home-content">
<div class="alert alert-primary" role="alert">
GERER PROFESSEURS 
</div>
    <div class="row">
        <div class="col-md-12">
           <div class="table-wrapper">
             
           <div class="table-title">
             <div class="row">
                 <div class="col-sm-6 p-0 flex justify-content-lg-start justify-content-center">
                    <!-- <h2 class="ml-lg-2"></h2> -->
                 </div>
                 <div class="col-sm-6 p-0 flex justify-content-lg-end justify-content-center">
                   <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal">
                   <i class="material-icons"></i>
                   <span>AJOUTER PROFESSEUR</span>
                   </a>
                   <a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal">
                   <i class="material-icons"></i>
                   <span>SUPPRIMER</span>
                   </a>
                 </div>
             </div>
           </div>
           
           <table class="table table-striped table-hover">
              <thead>
                 <tr>
                 <th></th>
                 <th>Nom</th>
                 <th>Email</th>
                 <th>role</th>
                 <th>Actions</th>
                 </tr>
              </thead>
              
              <tbody>
              <?php
			// Database connection configuration
			$host = 'localhost';
			$database = 'backend';
			$username = 'root';
			$password = '';

			// Create a new PDO instance for database connection
			$db = new PDO("mysql:host=$host;dbname=$database;charset=utf8mb4", $username, $password);

			// Fetch filieres from the filiere table
			$sql = "SELECT id_professeur,nom_professeur,prenom_professeur,email_professeur,role,password_professeur FROM professeur";
			$result = $db->query($sql);

			// Iterate over the fetched filieres to generate options
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "
                <tr>
                    <th></th>
                    <th>" . $row['nom_professeur'] . "</th>
                    <th>" . $row['email_professeur'] . "</th>
                    <th>" . $row['role'] . "</th>
                    <th>
                    <a href='#editEmployeeModal' class='edit' data-toggle='modal' data-id='" . $row['id_professeur'] . "'>
                        <i class='material-icons' data-toggle='tooltip' title='Edit'></i>
                   </a>
                   <a href='#deleteEmployeeModal' class='delete' data-toggle='modal' data-id='" . $row['id_professeur'] . "'>
                      <i class='material-icons' data-toggle='tooltip' title='Delete'></i>
                 </a>
                
                    </th>
                </tr>";
        }
        ?>
                 
              </tbody>
              
              
           </table>

           </div>
        </div>
        
        
                           <!----add-modal start--------->
                           <div class="modal fade" tabindex="-1" id="addEmployeeModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employees</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="youssefajouterprof.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nomInput">Nom</label>
                        <input type="text" class="form-control" id="nomInput" name="nomprof" required>
                    </div>
                    <div class="form-group">
                        <label for="prenomInput">Prenom</label>
                        <input type="text" class="form-control" id="prenomInput" name="prenomprof" required>
                    </div>
                    <div class="form-group">
                        <label for="emailInput">Email</label>
                        <input name="emailprof" type="email" class="form-control" id="emailInput" required>
                    </div>
                    <div class="form-group">
                        <label for="roleInput">Role</label>
                        <input name="roleprof" class="form-control" id="roleInput" required>
                    </div>
                    <div class="form-group">
                        <label for="Passinput">Password</label>
                        <input type="password" name="Password" class="form-control" id="Pass" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>





           <!----edit-modal end--------->
           
           
           
           
           
       <!----edit-modal start--------->
       <div class="modal fade" tabindex="-1" id="editEmployeeModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="youssefmodifierprof.php">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editNomInput">Nom</label>
                        <input type="text" class="form-control" id="editNomInput" name="nomprof" required>
                    </div>
                    <div class="form-group">
                        <label for="editPrenomInput">Prenom</label>
                        <input type="text" class="form-control" id="editPrenomInput" name="prenomprof" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmailInput">Email</label>
                        <input name="emailprof" type="email" class="form-control" id="editEmailInput" required>
                    </div>
                    <div class="form-group">
                        <label for="editRoleInput">Role</label>
                        <input name="roleprof" class="form-control" id="editRoleInput" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassInput">Password</label>
                        <input type="password" name="Password" class="form-control" id="editPassInput" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>




           <!----edit-modal end--------->	   
           
           
         <!----delete-modal start--------->
         <div class="modal fade" tabindex="-1" id="deleteEmployeeModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post" action="youssefsupprimerprof.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="deleteemailinput" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordInput">Password</label>
                        <input type="password" class="form-control" id="pass" name="password" required>
                    </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this record?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>


           <!----edit-modal end--------->   
           
        
        
     
     </div>
     <script src="jquery-3.3.1.slim.min.js"></script>
     <script src="popper.min.js"></script>
     <script src="bootstrap.min.js"></script>
     <script src="jquery-3.3.1.min.js"></script>
     