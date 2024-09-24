<?php
include_once 'connection.php';



if(isset($_POST['submit'])){
    if (isset($_FILES['file_input']) && $_FILES['file_input']['error'] == 0) {
        $image = $_FILES['file_input']['name'];

        echo "Temp name: " . $_FILES['file_input']['tmp_name'] ."<br>";
        echo"susecee upload image "."</br>";
    }
}else{
    echo'nofile  uploald'."</br>";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <input type="file" name="file_input" id="file_input">

            <button type="submit" name="submit"> submit</button>
        </form>

    </div>
</body>

</html>