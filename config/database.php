<?php

require_once 'config.php';

class Database
{
    
    private $pdo;
    public function getConnection()
    {
       
        $this->pdo = null;
        try {
            $this->pdo = new PDO(
                "mysql:host=" . DB_SERVER .      
                    ";port=" . DB_PORT .           
                    ";dbname=" . DB_NAME,          
                DB_USERNAME,                       
                DB_PASSWORD                        
            );

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            
            echo "Erreur de connexion : " . $e->getMessage();
        }

        return $this->pdo;
    }
}