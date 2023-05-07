<?php
//Procédure de A à Z à une base de donnée SQL
//recupéré les infos de connexion à la base des donnée dans les variables
$servername  = "localhost";
$username    = "root";
$passeword   = "root";
$dbname      = "budget_bdd";

//procédé à la connexion et la stocke dans une variable
$connexion = new mysqli($servername, $username, $passeword, $dbname);

//si la connexion s"est mal passée
if ($connexion->connect_error) {
    die("connexion imposssible");
}
//définir lma requete sql
$requete_sql = "SELECT * FROM depense";
//Execution de la requete SQL
$resultat = $connexion->query($requete_sql);
//fonction de calcul de code
function calculeTotalDepense($connexion)
{
    $total = 0;
    $requete_sql = "SELECT * FROM depense";
    $resultat = $connexion->query($requete_sql);

    if ($resultat->num_rows > 0) {
        while ($les_depenses = $resultat->fetch_assoc()) {
            $total += $les_depenses['prix'];
        }
        $total = intval($total);
        $total = number_format($total, 2, ',', ' ');
    }
    return $total;
}
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
    <title>Document</title>
</head>

<body>
    <div class="container mt-2">
        <div class="row mb-5">
            <div class="col-lg-8">
                <h1>Liste des dépense<h1>
                        <a class="btn btn-outline-primary" href="form-ajout-depense.php" role="button">
                            Créer une dépense</a>
            </div>
            <div class="col-lg-4">
                <div class="card text-bg-success mb-3">
                    <div class="card-header mt-5">Total des dépenses</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo calculeTotalDepense($connexion) ?>€</h5>
                        <p class="card-text">Ceci est une liste factuelle de toute mes dépenses.</p>
                    </div>
                </div>
            </div>
            <hr>
        </div>
        <?php if ($resultat->num_rows > 0) :  ?>

            <div class="row mb-5">
                <ol class="list-group list-group-numbered">
                    <?php while ($les_depenses = $resultat->fetch_assoc()) : ?>


                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold"><?php echo $les_depenses["titre"]; ?></div>
                                <a href="delete-depense.php?id=<?= $les_depenses["id"] ?>" class="link-danger ms-3" onclick="return confirm('Etes vous sûre de vouloire la suprimée?')">
                                    Supprimer</a>
                                <a href="updtate-depense.php?id=<?php echo $les_depenses["id"] ?>" class="link-primary">
                                    Modifier</a>
                            </div>
                            <span class="badge red center mt-3"><?php echo $les_depenses["prix"]; ?> €</span>
                        </li>


                    <?php endwhile; ?>
                </ol>

            </div>
        <?php else :  ?>
            <div class="alert alert-danger" role="alert">
                Aucune dépense trouvées
            </div>
        <?php endif; ?>


        <select class="form-select" aria-label="Default select example">
            <option selected>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>

</body>

</html>