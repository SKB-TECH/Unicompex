<?php 

error_reporting( E_ALL );
ini_set( 'display_errors', 1);

        include_once('Connexion/Database.php');

        class Crud extends Database
        {

                public $columns = "";
                public $values = "";
                public $column = "";
                public $value = "";


                public function __construct()
                {
                        parent::__construct();
                }

                //afficher  toutes les donnees de la bdd
                public function selectalldata($table)
                {
                        $select = "SELECT * FROM $table";
                        $select1 = $this->connection->query($select);
                        return $select1;
                }
                // affichier les donnees de la table par id
                public function selectbyid($table, $labelId, $id)
                {
                        $sel = "SELECT * FROM $table where $labelId=$id";
                        $sel1 = $this->connection->query($sel);
                        return $sel1->fetch();
                }


                public function update($data, $table, $labelId, $id)
                {
                        foreach ($data as $this->column => $this->value) {
                                $update = ("UPDATE $table SET $this->column = '$this->value' WHERE $labelId= '$id'");
                                $this->connection->query($update);
                        }
                        return true;
                }
                // suppression d'une donnees dans la table 
                function deletedata($table, $labelId, $where)
                {
                        $delete = ("DELETE FROM $table WHERE $labelId=$where");
                        $this->connection->query($delete);
                        return true;
        }
                public function insert2($sql)
                {   
                        if($sql != ""){
                           $insert1 = $this->connection->query($sql);
                        }
                }

                public function escape_string($value)
                {
                        return $this->connection->quote($value);
                }

                public function total($tab){
                    $sql=("SELECT * FROM $tab");
                    $stms=$this->connection->prepare($sql);
                    $stms->execute();
                    return $tot=$stms->rowCount();
                }

                public function read($tab){
                    $data =array();

                    $sql="SELECT * FROM $tab";
                    $stmt=$this->connection->prepare($sql);
                    $stmt->execute();
                    $resultat=$stmt->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($resultat as $row) {
                        $data=$row;
                    }

                    return $data;
                }



}

// $taches=new Crud();
//         $taches->insert2("INSERT INTO enseignants(noms,sexe,grade,domaine,adresse,telephone) values('Gourou','M','Gourou','M','Gourou','M')");
?>