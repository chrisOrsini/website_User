<?php
//affiche les differents erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('class/depense.class.php');

//Instanciation de l'objet
$depense = new Depense();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/bootstrap.js" defer></script>
    <title>Gestion Budget</title>
</head>
<body>
<div class="container mt-2">
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1>Liste des dépense<h1>
            <a class="btn btn-outline-primary" href="add-depense.php" role="button">
                Créer une dépense</a>
        </div>
        <div class="col-lg-4">
            <div class="card text-bg-success mb-3">
                <div class="card-header mt-5">Total des dépenses :</div>
                <div class="card-body">
                <span class="h1"><?= $depense->calculTotalDepense()?>€</span>
                <p class="card-text">Ceci est une liste factuelle de toute mes dépenses.</p>
            </div>
        </div>
    </div>
    <hr>
</div>
    <div class="row mb-5">
<ol class="list-group list-group-numbered">
   <?php $depense->listDepenses(); ?>
   
</ol>
 
    </div>
</body>
</html>