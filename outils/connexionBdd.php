<?php 
        try{
            $pdo =new PDO("mysql:host=localhost;dbname=nyalukemba_db","root","");
        }catch(Exception $e){
            die('Erreur de connexion :' .$e->getMessage());
        }
?>