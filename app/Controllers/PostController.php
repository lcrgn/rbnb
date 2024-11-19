<?php

namespace App\Controllers;

use App\Models\Post;

class PostController{
    private $post;
    // private $comment;

    public function __construct(Post $post){
        $this->post = $post;
    }

    public function index(){

        $filters = [
            'min_price' => !empty($_GET['min_price']) ? floatval($_GET['min_price']) : null,
            'max_price' => !empty($_GET['max_price']) ? floatval($_GET['max_price']) : null
        ];

        $posts = $this->post->findAll($filters);

        require_once 'Views/home.php';
    }

    public function create()
    {

        if (!isset($_SESSION['user_id'])){
            header('Location:' . BASE_URL . 'login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $this->validatePost($_POST);

            if (empty($errors) && isset($_FILES['image'])){
                $imageResult = $this->uploadImage($_FILES['image']);
                if (is_string($imageResult)) {
                    $_POST['image'] = $imageResult;
                    $_POST['user_id'] = $_SESSION['user_id'];

                    if ($this->post->create($_POST)){
                        $_SESSION['flash'] = 'Post created successfully';
                        header('Location:' . BASE_URL);
                        exit;
                    }
                    $errors[] = 'Failed to create listing';
                } else{
                    $errors = $imageResult['errors'];
                }
            }
            $_SESSION['errors'] = $errors;
        }

        require_once 'Views/posts/create.php';
    }

    private function validatePost(array $data):array{
        $errors = [];

        $required = ['name', 'description', 'price', 'location', 'number_of_rooms'];
        foreach ($required as $field){
            if (empty($data[$field])){
                $errors[$field] = 'The ' . $field . ' field is required';
            }
        }

        if (!empty($data['price']) && !is_numeric($data['price'])  || $data['price'] <= 0){
            $errors[] = 'The price field must be a number';
        }

        if (!empty($data['number_of_rooms']) && !is_numeric($data['number_of_rooms']) || $data['number_of_rooms'] <= 0){
            $errors[] = 'Number of rooms must be a positive number';
        }
        return $errors;
    }

    private function uploadImage(array $file): array|string{
        $allowedTypes = ['image/jpeg', 'image/png'];
        $maxSize = 1024 * 1024 * 4;

        if (!in_array($file['type'], $allowedTypes)){
            return ['errors' => ['File type not allowed. Only JPEG and PNG allowed']];
        }

        if ($file['size'] > $maxSize){
            return ['errors' => ['File size must be less than 4MB']];
        }

        $fileName = uniqid() . '_' . $file['name'];
        $uploadPath = UPLOAD_DIR . $fileName . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!file_exists(UPLOAD_DIR)){
            mkdir(UPLOAD_DIR, 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadPath)){
            return file_get_contents($fileName);
        }

        return ['errors' => ['Failed to upload image']];
    }
}
