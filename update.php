<?php
// Include necessary files for database connection and table creation
include_once 'connection.php';
include_once 'createTable.php';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    $id = $_GET['id'] ?? null;
    $name = $_POST['name'];
    $price = $_POST['price'];
    $qty = $_POST['qty'];
    $image = '';

    // Image upload handling
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        if (!empty($_FILES['image']['name'])) {
            $upload_dir = __DIR__ . '/imageInsert/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true); // Create the directory if it doesn't exist
            }
            $file_name = basename($_FILES['image']['name']);
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_path = $upload_dir . $file_name;

            // Check file type
            $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            if (in_array($file_ext, $allowed_types)) {
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $image = $file_name; // Save only the filename to be stored in the database
                } else {
                    die('Failed to upload image.'); // Stop script execution
                }
            } else {
                die('Invalid file type. Only JPG, JPEG, PNG, and GIF allowed.');
            }
        } else {
            die('No image file selected.');
        }
    }

    // Using prepared statements for security
    $sql = "UPDATE   input_test_php2  SET  name ='$name', price= '$price', qty='$qty', image='$image'";
    if ($cnn->query($sql) === TRUE) {
        echo 'update  successful!<br>';
        echo 'Name: ' . htmlspecialchars($name) . "<br>";
        echo 'Price: ' . htmlspecialchars($price) . "<br>";
        echo 'Quantity: ' . htmlspecialchars($qty) . "<br>";
        
        // Display the uploaded image
        if ($image) {
            echo 'Image: <img src="imageInsert/' . htmlspecialchars($image) . '" alt="' . htmlspecialchars($name) . '" style="width:100px;height:auto;"><br>';
        }
    } else {
        echo 'Error inserting: ' . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.12/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class="flex justify-center items-center h-screen bg-gray-100">
        <form action="" method="POST" enctype="multipart/form-data" class="bg-red-400 p-6 rounded-lg shadow-lg space-y-4">
            <div>
                <label for="name" class="block text-white font-bold">Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 rounded border">
            </div>

            <div>
                <label for="price" class="block text-white font-bold">Price</label>
                <input type="text" name="price" id="price" class="mt-1 block w-full p-2 rounded border">
            </div>

            <div>
                <label for="qty" class="block text-white font-bold">Quantity</label>
                <input type="text" name="qty" id="qty" class="mt-1 block w-full p-2 rounded border">
            </div>

            <div>
                <label for="image" class="block text-white font-bold">Image</label>
                <input type="file" name="image" id="image" class="mt-1 block w-full p-2 rounded border">
            </div>

            <button type="submit" name="submit" id="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
                Submit
            </button>
        </form>
    </div>
</body>

</html>
