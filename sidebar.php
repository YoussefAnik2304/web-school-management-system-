<?php @session_start();?>

<body>
    <?php include_once './db_conn.php'; ?>
    <?php include_once './sidebar.php'; ?>
    <div class="sidebar">
        <div class="logo-details">
            <i class="bx bx-book-alt"></i>
            <span class="logo_name">Ensah</span>
        </div>
        <ul class="nav-links">
            <?php include_once './testrole.php'; ?>


            <li>
                <a href="team.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Team</span>
                </a>
            </li>
            <li>
                <a href="./profile.php">
                    <i class='bx bx-user'></i>
                    <span class="links_name">Profile</span>
                </a>
            </li>
            <li>
                <a href="#">
                    <i class='bx bx-cog'></i>
                    <span class="links_name">Setting</span>
                </a>
            </li>
            <li class="log_out">
                <a href="./logout.php">
                    <i class='bx bx-log-out'></i>
                    <span class="links_name">Log out</span>
                </a>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="sidebarr-button">
                <i class='bx bx-menu sidebarBtn' style="font-size: 22px;"></i>
                <span class="dashboard" style="font-size: 22px;">Dashboard</span>
            </div>
            <div class="search-box">
                <input type="text" placeholder="Search..." name="" class="input">
                <button class='bx bx-search button'></button>
            </div>
            <div class="profile-details">
                <!--<img src="images/profile.jpg" alt="">-->
                <a href="./profile.php"> <span class="admin_name"><?php echo 'MR'.' '.$_SESSION['name'] ?></span></a>
                <i class='bx bx-user'></i>
            </div>
        </nav>
<script>


    // Récupérer les éléments HTML
// Récupérer les éléments HTML
var searchBox = document.querySelector('.search-box');
var input = searchBox.querySelector('.input');
var button = searchBox.querySelector('.button');

// Écouter l'événement click du bouton de recherche
button.addEventListener('click', function() {
  performSearch();
});

// Écouter l'événement de pression de touche dans l'input
input.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    performSearch();
  }
});

// Fonction de recherche
function performSearch() {
  var searchQuery = input.value.toLowerCase(); // Convertir la requête en minuscules

  // Récupérer tous les éléments à rechercher
  var elements = document.querySelectorAll('.searchable');

  // Parcourir chaque élément et afficher/masquer en fonction de la recherche
  for (var i = 0; i < elements.length; i++) {
    var element = elements[i];
    var text = element.innerText.toLowerCase(); // Convertir le texte de l'élément en minuscules

    // Vérifier si le texte contient la requête de recherche
    if (text.includes(searchQuery)) {
      element.style.display = 'block'; // Afficher l'élément s'il correspond à la recherche
    } else {
      element.style.display = 'none'; // Masquer l'élément s'il ne correspond pas à la recherche
    }
  }
}


</script>