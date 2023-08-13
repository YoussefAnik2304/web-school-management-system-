<?php $title = 'Modifier Chef departement'?>
<?php include_once './includes/head.php';?>

<body>

<?php include_once './sidebar.php'; ?>
    <div class="home-content" style="height:640px">
        <div class="container my-4">
            <div class="home-content" style="height:640px">
                <div class="alert alert-info" role="alert">
                    MODIFICATION D'UN Chef departement
                </div>
                <form method="POST">
                    <div class="mb-3">
                        <input hidden type="number" class="form-control" id="exampleInputEmail1" name="id"
                            value="">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Nom </label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="nom_prof"
                            value="">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">PRENOM</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" name="prenom"
                            value="">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">specialite</label>

                        <input type="text" class="form-control" id="exampleInputEmail1" name="specialite"
                            value="">
                    </div>

                    <div class="mb-3">
                        <label>Departement</label>
                        <br>
                        <select class="formbold-form-input" name="nom_departement" id="occupation">
                          <option>test </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mb-3" name="modifier">Modifier</button>
            </div>
            </form>
        </div>
    </div>
    <?php include_once './sidebar.php'; ?>

</body>


</html>