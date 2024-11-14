<?php

namespace App\Controllers;

use App\Models\User;

class AuthController{
    private $user;

    // l'objet User va contenir notre utilisateur connecté 
    public function __construct(User $user){
        $this->user = $user;
    }

    public function register(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = $this->validateRegistration($_POST);

            if(empty($errors)){
                if($this->user->create($_POST)){
                    // flash = msg qui pop up mais qui ne reste pas 
                    $_SESSION['flash'] = "Registration successfull. Please login";
                    header('Location: ' . BASE_URL . 'login');
                    exit;
                }
                $errors[] = 'Registration failed. Please try again';
            }
            $_SESSION['error'] = $errors;
        }
        require_once'Views/auth/register.php';
    }

    public function login(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user = $this->user->findByEmail($_POST['email']);

            if($user && password_verify($_POST['password'], $user['password'])){
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header('Location: ' . BASE_URL);
                exit;
            }
            $_SESSION['errors'] = ['Invalid email or password'];
        }
        require_once'Views/auth/login.php';
    }

    public function logout(){
        session_destroy();
        header('Location: ' . BASE_URL);
        exit;
    }

    private function validateRegistration(array $data):array{
        $errors = [];

        if(empty($data['username'])){
            $errors['username'] = "The username field is required";
        }
        if(empty($data['email'])){
            $errors['email'] = "The email field is required";
        }
        if(empty($data['password'])){
            $errors['password'] = "The password is required";
        }
        if(empty($errors)){
            $this->user->create($data);
        }
        return $errors;
    }

}