<?php

require_once 'Views/header.php';

?>

<div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold mb-6">
        Ajouter un logement
    </h1>

    <form action="<?= BASE_URL ?>posts/create" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
            <label class="block text-gray-700 mb-2" for="name">Nom du logement</label>
            <input
                type="text"
                name="name"
                id="name"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="location">Localisation</label>
            <input
                type="text"
                name="location"
                id="location"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="price">Prix</label>
            <input
                type="number"
                name="price"
                id="price"
                step="0.01"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="number_of_rooms">Nombre de chambre</label>
            <input
                type="number"
                name="number_of_rooms"
                id="number_of_rooms"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="description">Description</label>
            <textarea
                name="description"
                id="description"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500"></textarea>
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="available">Disponibilité</label>
            <input
                type="checkbox"
                name="available"
                value="1"
                checked
                id="available"
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <div>
            <label class="block text-gray-700 mb-2" for="image">Image</label>
            <input
                type="file"
                name="image"
                id="image"
                accept="image/jpeg, image/png"
                required
                class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-red-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg">
            Ajouter le logement
        </button>

    </form>
</div>


<?php

require_once 'Views/footer.php';

?>