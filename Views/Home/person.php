<?php
class PersonView {
    public function showAddForm() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Person</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="font-sans bg-gray-100">
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-4">Add Person</h1>
                <form action="?action=store" method="post"  enctype="multipart/form-data">

                    <label for="profile_image">Profile Image:</label>
                    <input type="file" name="profile_image" required class="border border-gray-300 p-2 mb-4 w-full">

                    <label for="name">Name:</label>
                    <input type="text" name="name" required class="border border-gray-300 p-2 mb-4 w-full">
                   
                    <label for="name">Age:</label>
                    <input type="text" name="age" required class="border border-gray-300 p-2 mb-4 w-full">
                   
                    <label for="name">Address:</label>
                    <input type="text" name="address" required class="border border-gray-300 p-2 mb-4 w-full">
                 
                    <label for="gender">Gender:</label>
                    <select name="gender" required class="border border-gray-300 p-2 mb-4 w-full">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>

                    <label for="name">Country:</label>
                    <input type="text" name="country" required class="border border-gray-300 p-2 mb-4 w-full">
                    <button type="submit" class="bg-green-500 text-white p-2 rounded hover:bg-green-700">Add Record</button>
                    <a href="?action=back" class="bg-gray-300 text-gray-700 p-2 rounded ml-2">Back</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    }

    public function showRecords($records) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Person's Records</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/@heroicons/react@1.0.4/dist/index.css" rel="stylesheet">

        </head>
        <body class="font-sans bg-gray-100">
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-4">Person's Records</h1>
                <div class="overflow-x-auto">
                <div class="flex justify-end">
                    <a href="?action=addform" class="bg-green-500 text-black-300 p-2 rounded ml-2 mb-2 flex items-center hover:bg-green-700">
                        <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Add Person
                    </a>
                </div>
                    <table class="min-w-full bg-white border border-gray-300 shadow-sm">
                        <thead class="bg-green-500 text-white">
                            <tr>
                                <!-- <th class="py-2 px-4 border-b">ID</th> -->
                                <th class="py-2 px-4 border-b">Image</th>
                                <th class="py-2 px-4 border-b">Name</th>
                                <th class="py-2 px-4 border-b">Age</th>
                                <th class="py-2 px-4 border-b">Address</th>
                                <th class="py-2 px-4 border-b">Gender</th>
                                <th class="py-2 px-4 border-b">Country</th>
                                <th class="py-2 px-4 border-b">Actions</th>
                            </tr>
                        </thead>

                        <?php foreach ($records as $data) : ?>
                            <tr>
                                <td class="py-2 px-4 border-b text-center">
                                    <div class="flex items-center justify-center h-full">
                                        <?php if (!empty($data['profile_image'])): ?>
                                            <img src="<?= $data['profile_image'] ?>" alt="Profile Image" class="rounded-full w-12 h-12">
                                        <?php else: ?>
                                            <img src="Public/images/icon.png" alt="Default Image" class="rounded-full w-12 h-12">
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <!-- <td class="py-2 px-4 border-b text-center"><?= $data['id'] ?></td> -->
                                <td class="py-2 px-4 border-b text-center"><?= $data['name'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $data['age'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $data['address'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $data['gender'] ?></td>
                                <td class="py-2 px-4 border-b text-center"><?= $data['country'] ?></td>
                                <td class="py-2 px-4 border-b text-center">
                                    <a href="?action=edit&id=<?= $data['id'] ?>" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">Edit</a>
                                    <a href="?action=delete&id=<?= $data['id'] ?>" class="bg-red-500 text-white p-2 rounded hover:bg-red-700">Delete</a>
                                </td>
                                
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </body>
        </html>
        <?php
    }

    public function showEditForm($record) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Edit Person's Record</title>
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        </head>
        <body class="font-sans bg-gray-100">
            <div class="container mx-auto p-4">
                <h1 class="text-3xl font-bold mb-4">Edit Person's Record</h1>
                <form action="?action=update&id=<?= $record['id'] ?>" method="post" enctype="multipart/form-data">

            
                    <div class="mb-4">
                        <label for="current_image">Current Image:</label>
                        <?php if (!empty($record['profile_image'])): ?>
                            <img src="<?= $record['profile_image'] ?>" alt="Current Image" class="rounded-full w-20 h-20">
                        <?php else: ?>
                            <img src="Public/images/icon.png" alt="Default Image" class="rounded-full w-20 h-20">
                        <?php endif; ?>
                    </div>

                    <div class="mb-4">
                        <label for="profile_image">New Image:</label>
                        <input type="file" name="profile_image" class="border border-gray-300 p-2 w-full">
                    </div>

                    <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= $record['name'] ?>" required class="border border-gray-300 p-2 mb-4 w-full">
                   
                    <label for="name">Age:</label>
                    <input type="text" name="age" value="<?= $record['age'] ?>" required class="border border-gray-300 p-2 mb-4 w-full">
                   
                    <label for="name">Address:</label>
                    <input type="text" name="address" value="<?= $record['address'] ?>" required class="border border-gray-300 p-2 mb-4 w-full">
                 
                    <label for="gender">Gender:</label>
                        <select name="gender" required class="border border-gray-300 p-2 mb-4 w-full">
                            <option value="Male" <?= ($record['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                            <option value="Female" <?= ($record['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                            <option value="Other" <?= ($record['gender'] == 'Other') ? 'selected' : '' ?>>Other</option>
                           
                        </select>

                    <label for="name">Country:</label>
                    <input type="text" name="country" value="<?= $record['country'] ?>" required class="border border-gray-300 p-2 mb-4 w-full">
                    <button type="submit" class="bg-blue-500 text-white p-2 rounded hover:bg-blue-700">Update Record</button>
                     <a href="?action=back" class="bg-gray-300 text-gray-700 p-2 rounded ml-2">Back</a>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
}
?>
