<?php 
/**
 * cette classe permet de se connecte a la base des donnees
 */
    class Database
    {
        private $dns="mysql:localhost,dbname=nyalukemba_db";
        private $user="root";
        private $pass="";
        private $connexion;

        public function __construct()
            { 
                try {
                    $this->connexion=new PDO($this->dns,$this->user,$this->pass);
                    echo("connexion succefuly");
                } 
                catch (PDOException $msg) {
                    echo ($msg->getMessage());
                }
            }
    }

    $bdd=new Database()
?>