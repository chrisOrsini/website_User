<?php
//affiche les differents erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once('database.class.php');
    class Depense {
            protected $db;

            public function __construct(){
                $this->db = new Database();
            }

            public function listDepenses(){
                $lesDepenses = $this->db->select("depense");
                if($lesDepenses){
                    foreach($lesDepenses as $depense){
                        $titre = $depense['titre'];
                        $prix = $depense['prix'];
                        $id = $depense['id'];
                        $debite = $depense['debite'];

                        

                        if($debite == 1){
                            echo "<li class='list-group-item d-flex justify-content-between align-items-start'>
                            <div class='ms-2 me-auto d-flex justify-content-between align-items-start'>
                                <div class='fw-bold'>$titre</div>
                            <div class='ms-2 me-auto d-flex justify-content-space between align-items-start'>
                                <a href='index.php?id=$id' 
                                class='link-danger ms-3' onclick='return confirm('Etes vous sûre de vouloire la suprimée?')'>
                                Supprimer</a>
                                <a href='index.php?id=$id' class='link-primary'>
                                Modifier</a>
                            </div>
                            </div>
                             <span class='badge red center mt-3'>$prix €</span>
                        </li>";
                        }else{
                            echo "<li class='list-group-item d-flex justify-content-between align-items-start'>
                        <div class='ms-2 me-auto d-flex justify-content-between align-items-start'>
                            <div class='fw-bold'>$titre</div>
                            <div class='ms-2 me-auto d-flex justify-content-between align-items-start'>
                                <a href='database.class.php?id=$id' 
                                    class='link-danger ms-3' onclick='return confirm('Etes vous sûre de vouloire la suprimée?')'>
                                        Supprimer</a>
                                <a href='database.class.php?id=$id' class='link-primary'>
                                    Modifier</a>
                             </div>
                        </div>
                         <span class='badge text-bg-success center mt-3'>$prix €</span>
                    </li>";
                        }
                       
                    } 
                    unset($depense);
                }else{
                    echo "<div class='alert alert-danger' role='alert'>
                    Aucune dépense trouvées
            </div>";
                }
            }



     public function addDepense($values){
         $reponse = [];
     if(!empty($values["titre"]) && !empty($values["prix"]) && !empty($values["prix"])){
         $resultat = $this->db->create("depense", $values);

         if($resultat){
                        $reponse = array(
                            'message' => "Dépense ajouté",
                            'statut' =>"danger"
                        );
                    }
                }else{
                    $reponse = array(
                        'message' => "Un des champs n'est pas rempli",
                        'statut' => "danger"
                    );
                }
                return $reponse;
            }

            
            public function calculTotalDepense(){
                $total = 0;
                $lesDepenses = $this->db->select("depense");
            
                if($lesDepenses){
                    foreach($lesDepenses as $depense){
                        $total += $depense['prix'];
                    }
                }
                    $total = intval($total);
                    $total = number_format($total, 2, ',', ' ');
                    
            
                return $total;
            }
    }

?>