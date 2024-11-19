<?php

require_once 'Views/header.php';

?>

<div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6 text-center">Connexion</h1>

    <form action="<?= BASE_URL ?>login" method="POST" class="space-y-4">

        <div>
            <label class="block text-gray-700 mb-2" for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="password">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">
            Se connecter
        </button>

    </form>

    <p class="mt-4 text-center">
        Pas encore de compte ? <a href="<?= BASE_URL ?>register" class="text-blue-500">S'inscrire</a>
    </p>
</div>



<?php

require_once 'Views/footer.php';

?>