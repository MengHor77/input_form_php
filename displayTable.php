<?php
// Include necessary files for database connection and table creation
include_once 'connection.php';
include_once 'createTable.php';
include_once 'insertTodatabase.php';

// Fetch products from the database
$sql = "SELECT * FROM input_test_php2"; // Adjust table name as needed
$result = $cnn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.12/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mx-auto p-6">
        <h1 class="text-2xl font-bold mb-6 text-center">Product List</h1>

        <?php if ($result && $result->num_rows > 0): ?>
            <div class="overflow-x-auto">
                <table class="min-w-full border border-gray-300">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">Name</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Price</th>
                            <th class="border border-gray-300 px-4 py-2 text-right">Quantity</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="hover:bg-gray-100">
                                <td class="border border-gray-300 px-4 py-2"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-right"><?php echo htmlspecialchars($row['price']); ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-right"><?php echo htmlspecialchars($row['qty']); ?></td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    <?php 
                                        // Ensure the image path is correct
                                        $imagePath = 'imageInsert/' . htmlspecialchars($row['image']);
                                    ?>
                                    <?php if (file_exists($imagePath)): ?>
                                        <img src="<?php echo $imagePath; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="w-20 h-20 object-cover mx-auto">
                                    <?php else: ?>
                                        <span class="text-red-500">Image not found</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-red-500 text-center">No records found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
