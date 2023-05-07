<?php 
if(isset($_POST['ajouter'])){
    if(!empty($_POST['titre']) && !empty($_POST['prix']))
    {
        //je récupère les infos de connexionx à la base de donnée dans les variables
        $servername  = "localhost";
        $username    ="root";
        $passeword   ="root";
        $dbname      ="budget_bdd";
        //procédé à la connexion et la stocke dans une variable
        $connexion = new mysqli($servername, $username, $passeword, $dbname);

        //si la connexion s"est mal passée
        if($connexion->connect_error){
            die("connexion imposssible");
        }

        $titre = $_POST['titre'];
        $prix = $_POST['prix'];

        //définir lma requete sql
        $requete_sql = "INSERT INTO depense(titre, prix) VALUES ('$titre', '$prix')";
        //Execution de la requete SQL
        $resultat = $connexion->query($requete_sql);
        
       if($resultat){
            $message = "Dépense ajoutée";
            $statut = "success";           
        }else{
            $message = "Problème de connexion";
            $statut = "Danger";
        }
        
    } else{
      echo "Un des champs n'est pas rempli";
    }
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

</head>
<body>
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<div class="container">
    <h1>Ajouter une dépense</h1>
        <?php 
            if(!empty($message)) : ?>
                <div class="alert alert-<?php echo $statut ?> d-flex align-items-center" role="alert">
                <!-- Si stazut est egal a succeess -->
                <?php 
                if($statut == 'success') : ?>                
                <svg style="width: 12px; height:12px" class="bi flex-shrink-0 me-2" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                <!-- sinon  -->
                <?php  else : ?>
                <svg style="width: 12px; height:12px" class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg> 
                <?php endif; ?>
                <div>
                <?php echo $message; ?>
                </div>
                </div>
            <?php endif; ?>
            

<form action="" method="POST">
        <div class="form-floating mb-3">
                 <input type="text" class="form-control" id="floatingInput" placeholder="Ex: Iphone 14" name="titre" required>
                <label for="floatingInput">Titre de la dépense</label>
        </div>
            <div class="form-floating">
                 <input type="number" class="form-control" id="floatingPassword" placeholder="Ex: 1025" name="prix" required>
                <label for="floatingPassword">Prix de la dépense</label>
            </div>
            
            
            <button type="submit" class="btn btn-primary mt-2" name="ajouter">Ajouter</button>
            <a class="btn btn-primary mt-2 ms-3" href="index.php" role="button">Retoure à la liste</a>
    </form>
</div>

    
</body>
</html>