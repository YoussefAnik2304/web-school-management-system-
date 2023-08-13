<?php include_once './db_conn.php'; ?>
<?php $title= 'Login' ?>
<?php include_once './includes/head.php';?>
<?php
session_start();

// Check if the login form is submitted
if (isset($_POST['login'])) {
    // Retrieve the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

  

    $stmt = $pdo->prepare("SELECT * FROM Professeur WHERE email_professeur = :email AND password_professeur = :password");

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);

    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row) {
        $_SESSION['prof_id'] = $row['id_professeur'];
        $_SESSION['prof_role'] = $row['role'];
        $_SESSION['name'] = $row['nom_professeur'];
        $_SESSION['surname'] = $row['prenom_professeur'];
        $_SESSION['email'] = $row['email_professeur'];
        $_SESSION['image'] = $row['image'];

        // Redirect to the professor's dashboard or any other desired page
        header("Location: ./homeadmin.php");
        exit();
    } else {
        // Invalid login credentials
        // echo "Invalid email or password. Please try again.";
    }
}
?>
<body>
<div class="containerr">
      <div class="contact-box" style="height: 600px;">
        <div class="left"></div>
        <div class="right">
          <?php 
          if(isset($row) && !$row):?>
          <div class="alert alert-danger" role="alert">
          Invalid email or password. Please try again.
       </div>
          <?php endif;?>
          <h2>Welcome  Back</h2>
          <form method="post">
          <input type="email" class="field" placeholder="Your email" name="email" />
          <input type="password" class="field" placeholder="Your password" name="password" />
          <input type="submit" value="Login" name="login">
          <hr>
          <p><a href="./forget.php" class="link-primary  link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Mot de pass oublier ?</a></p>
          <p><a href="https://ensah.ma/" class="link-secondary  link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Question ?</a></p>

        </div>
      </div>
    </div>
</body>
</html>