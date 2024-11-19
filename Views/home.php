<?php

require_once 'Views/header.php';

?>

<div class="mb-8">
    <form action="<?= BASE_URL ?>" method="GET" class="bg-white p-4 rounded-lg shadow-md">
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-gray-700 mb-2" for="min_price">Prix minimum</label>
                <input
                    type="number"
                    name="min_price"
                    id="min_price"
                    value="<?= $_GET['min_price'] ?? '' ?>"
                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
            </div>
            <div>
                <label class="block text-gray-700 mb-2" for="max_price">Prix maximum</label>
                <input
                    type="number"
                    name="max_price"
                    id="max_price"
                    value="<?= $_GET['max_price'] ?? '' ?>"
                    class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
            </div>
            <div>
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Filtrer</button>
            </div>
        </div>

    </form>
</div>

<div class="grid grid-cols-3 gap-6">
    <?php foreach ($posts as $post) : ?>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <img src="<?= BASE_URL . 'uploads/' . $post['image'] ?>" alt="<?= $post['name'] ?>" class="w-full h-48 object-cover mb-4">
            <h2 class="text-xl font-bold mb-2"><?= $post['name'] ?></h2>
            <p class="text-gray-700 mb-2"><?= $post['description'] ?></p>
            <p class="text-gray-700 mb-2"><?= $post['price'] ?> €</p>
            <p class="text-gray-700 mb-2"><?= $post['location'] ?></p>
            <p class="text-gray-700 mb-2"><?= $post['number_of_rooms'] ?> chambre(s)</p>
            <p class="text-gray-700 mb-2">Posté par <?= $post['username'] ?></p>
        </div>
    <?php endforeach; ?>
</div>

<?php

require_once 'Views/footer.php';

?>