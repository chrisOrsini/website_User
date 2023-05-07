<?php   
    $id_to_delete = $_GET["id"];
    //recupéré les infos de connexion à la base des donnée dans les variables
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
//définir ma requete sql
$requete_sql = "DELETE FROM depense WHERE id = $id_to_delete";
//Execution de la requete SQL
$resultat = $connexion->query($requete_sql);

    if($resultat){
            header("Location: index.php");
    
    }else{
        echo 'Problème de suppression';
    }

?>