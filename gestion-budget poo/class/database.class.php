<?php

//affiche les differents erreurs PHP
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


class Database
{
    private $host     = "localhost";
    private $username = "root";
    private $pass     = "root";
    private $dbname   = "budget_bdd";

    public function connect()
    {
        $connexion = new mysqli($this->host, $this->username, $this->pass, $this->dbname);
        if ($connexion) {
            return $connexion;
        } else {
            die('connexion imposible');
        }
    }

    public function create($table, $values = array())
    {
        /**
         * array(
         * 'titre' => 'iphone 14 pro'
         * 'prix' => '1329'
         * );
         */
        $connexion = $this->connect();
        $tab_nom_table = array_keys($values); //recupère "array('titre', 'prix')" et le mets dans un tableau 
        $nom_table = implode(',', $tab_nom_table); // sépare mes tableau par une virgule(,) titre, prix

        $tab_values_tables = array_values($values); //récupère "aray('iphone 14 pro', '1324')
        $count = count($tab_values_tables); //² compte le nombre des variable dans un tableau
        $i = 1;
        $values_string = '';

        foreach ($tab_values_tables as $value) {
            if ($i != $count) {
                if (gettype($value) != "string") {
                    //tout les autres passages 
                    $values_string = $values_string . "$value,"; // $values_string = '' . "1329, "

                } else {
                    $values_string = $values_string . "'$value',"; // $values_string = '' . "'iphone 14 pro', "
                }
            } else {
                if (gettype($value) != "string") {
                    //dernier passage
                    $values_string = $values_string . "$value"; //$values_string = 'iphone 14 pro', ' . "1329"
                } else {
                    //dernier passage
                    $values_string = $values_string . "'$value'"; //$values_string = 'iphone 14 pro', ' . "'iphone 14 pro'"
                }
            }
            $i++;
        }
        //$values_string = 'iphone 14 pro' , 1329
        $requete_sql = "INSERT INTO $table($nom_table) VALUES ($values_string)";

        $resultat = $connexion->query($requete_sql);
        return $resultat;
    }


    public function select($table, $where = '')
    {
        $connexion = $this->connect();  //une methode affin d'avoir pour objet $connexion

        //Changement de la requete SQL en fonction du where
        if ($where == '') {
            $requete_sql = "SELECT * FROM $table";
            $resultat = $connexion->query($requete_sql);
        } else {
            $requete_sql = "SELECT *FROM $table WHERE $where";
            $requete_sql = $connexion->query($requete_sql);
        }
        //Recupération des données dans le tableau
        if ($resultat->num_rows > 0) {
            $lesdepenses = $resultat->fetch_all(MYSQLI_ASSOC);
            return $lesdepenses;
        } else {
            return false;
        }
    }
    public function update($table, $where = '')
    {

        $connexion = $this->connect();
        $requete_sql = "SELECT * FROM $table";
        $resultat = $connexion->query($requete_sql);

        if ($connexion->connect_error) {
            die("connexion imposssible");
        }

        if (!empty($_GET['id'])) {
            $id_to_updtate = $_GET['id'];
            //définir ma requete sql
            $requete_sql = "SELECT * FROM depense WHERE id = $id_to_updtate";
            //Execution de la requete SQL
            $resultat = $connexion->query($requete_sql);

            if ($resultat) {
                $la_depense = $resultat->fetch_assoc();
            }
        }


        if (isset($_POST['modifier'])) {
            if (!empty($_POST['titre']) && !empty($_POST['prix'])) {


                $titre = $_POST['titre'];
                $prix = $_POST['prix'];
                $id = $_POST['id'];

                //définir lma requete sql
                $requete_sql = "UPDATE depense SET titre = '$titre', prix ='$prix' WHERE id= $id ";
                //Execution de la requete SQL
                $resultat = $connexion->query($requete_sql);

                if ($resultat) {
                    $message = "Dépense ajoutée";
                    $statut = "success";
                } else {
                    $message = "Problème lors de la modification";
                    $statut = "Danger";
                }
            } else {
                echo "Un des champs n'est pas rempli";
            }
        }
    }

    public function delete($table, $where = '')
    {
        $connexion = $this->connect();
        /* CHANGEMENT DE LA REQUETE SQL EN FONCTION DE WHERE */

        if ($where == '') {

            $delete_requete = "DELETE FROM $table";

            $exection_delete = $connexion->query($delete_requete);
        } else {

            $delete_requete = "DELETE FROM $table WHERE $where";

            $exection_delete = $connexion->query($delete_requete);
        }

        return $exection_delete;
    }
}
