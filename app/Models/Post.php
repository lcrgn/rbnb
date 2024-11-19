<?php

namespace App\Models;

use PDO;

class Post
{
    private $db;

    public function __construct(PDO $db){
        $this->db = $db;
    }

    public function create(array $data):bool{
        $sql = "INSERT INTO posts (name, description, price, location, image, number_of_rooms, available, user_id) VALUES (:name, :description, :price, :location, :image, :number_of_rooms, :available, :user_id)";

        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $data['name'],
            'description' => $data['description'],
            'price' => $data['price'],
            'location' => $data['location'],
            'image' => $data['image'],
            'number_of_rooms' => $data['number_of_rooms'],
            'available' => $data['available'] ?? true,
            'user_id' => $data['user_id']
        ]);
    }

    public function findAll(array $filters = []):array{
        $sql = "SELECT p.*, u.username FROM posts p JOIN users u ON p.user_id = u.id WHERE 1=1";
        $params = [];

        if (isset($filters['min_price']) && $filters['min_price'] !== ''){
            $sql .= " AND p.price >= :min_price";
            $params['min_price'] = $filters['min_price'];
        }

        if (isset($filters['max_price']) && $filters['max_price'] !== ''){
            $sql .= " AND p.price <= :max_price";
            $params['max_price'] = $filters['max_price'];
        }

        $sql .= " ORDER BY p.created_at DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete(int $id, int $userId):bool{
        $sql = "DELETE FROM posts WHERE id = :id AND user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id' => $id,
            'user_id' => $userId
        ]);
    }




    // public function all()
    // {
    //     $stmt = $this->db->query('SELECT * FROM posts');
    //     return $stmt->fetchAll();
    // }


}
