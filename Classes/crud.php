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

                public function selectalldata2($sql)
                {
                        $select1 = $this->connection->query($sql);
                        return $select1;
                }
                // affichier les donnees de la table par id
                public function selectbyid($id,$tab)
                {
                        $sel = "SELECT * FROM $tab WHERE id=$id";
                        $res = $this->connection->query($sel);
                        return $res->fetch();
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

                public function Modification($id,$nm,$se,$gr,$do,$ad,$te){
                   $sql="UPDATE enseignants SET noms=:nm,sexe=:se,grade=:gr,domaine=:do,adresse=:ad,telephone=:te WHERE id=:id";
                   $stms=$this->connection->prepare($sql);
                   $stms->execute((['nm'=>$nm,'se'=>$se,'gr'=>$gr,'do'=>$do,'ad'=>$ad,'te'=>$te,'id'=>$id
                   ]));
                        return true;
                }
}
// $taches=new Crud();
//         $taches->insert2("INSERT INTO enseignants(noms,sexe,grade,domaine,adresse,telephone) values('Gourou','M','Gourou','M','Gourou','M')");
?>