<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php PROJECT_NAME ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-500 min-h-screen">
    
<nav class="bg-white shadow-lg">
    <div class="max-w-6xl mx-auto px-4">
        <div class="flex justify-between items-center h16">
            <a href="<?php BASE_URL ?>" class="flex items-center space-x-2">
                <span class="text-red-500 text-2xl font-bold">
                    <?php PROJECT_NAME ?>
                </span>
            </a>
                <div class="flex space-x-4">
                     <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="<?php BASE_URL ?>posts/create" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                            Ajouter un logement
                        </a>

                        <span>
                            Bonjour, <?php htmlspecialchars($_SESSION['username']) ?>
                        </span>

                        <a href="<?php  BASE_URL ?> logout" class="text-gray-600 hover:text-gray-800">logout</a>
                        <?php else : ?>

                        <a href="<?php  BASE_URL ?> login" class="text-gray-600 hover:text-gray-800">Connexion</a>
                        <a href="<?php  BASE_URL ?> register" class="text-gray-600 hover:text-gray-800">Inscrption</a>
                        <?php endif; ?>
                </div>
        </div>
    </div>
</nav>

<?php 
 if(isset($_SESSION['flash'])) :
?>

<div class="max-w-6xl max-auto mt-4 px-4">
    <div class="bg-green-100 border-green-400 text-green-700 px-4 py-3 rounded remative" role="alert">
    <strong class="font-bold">Error</strong>
    <ul class="list-disc list-inside">
        <?php foreach($_SESSION['error'] as $error): ?>
            <li><?php $error ?></li>
            <?php endforeach; ?>
    </ul>
    </div>
</div>

<?php unset($_SESSION['errors']); ?>
<?php endif; ?>

<main class="max-w-6xl mx-auto px-4 py-8">