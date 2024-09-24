<?php

include_once 'connection.php';

$table = "CREATE TABLE IF NOT EXISTS input_test_php2(
        id  INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) ,
        price DOUBLE ,
        qty  INT ,
        image  VARCHAR(255) 
)";

$qr = $cnn->query($table); 

if($qr== true){
    echo " table has create !";
}else{
    echo " fail to create table  !";

}
?>
