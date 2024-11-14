<?php

namespace App\Models;

use PDO;

class User{

    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    // :bool => typage -> maintenabilité (on sait directement de quoi il s'agit -> gain de temps)
    public function create(array $data):bool{
        $sql = "INSERT INTO users(username, email, password) VALUES(:username, :email, :password)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(
            [
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            ]
        );
    }

    // :?array => on met le point d'interogation au cas ou il ne s'agirait pas d'un tableau
    public function find(int $id):?array{
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByEmail(string $email):?array{
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update(int $id, array $data):bool{
        // si on ajoute le password, le mot de passe sera toujours updaté dans la bdd => inutile 
        $fields = ['username = :username, email = :email'];
        $params = ['id' => $id, 'username' => $data['username'], 'email' => $data['email']];

        // condition = on explique que si l'user ne modifie pas son password on ne change rien/pas d'update
        if(!empty($data['password'])){
            $fields[] = 'password = :password';
            $params['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $sql = "UPDATE users SET" . implode(', ', $fields) . "WHERE id = :id";
        return $this->db->prepare($sql)->execute($params);
    }

    public function delete(int $id):bool{
        $sql = "DELETE FROM users WHERE id = :id";
        return $this->db->prepare($sql)->execute(['id' => $id]);
    }
}

