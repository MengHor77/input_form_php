<?php


$servername = 'localhost';
$username ='root';
$password ='';
$dbname = 'form_input_php';
$cnn = new mysqli($servername, $username, $password, $dbname);

if($cnn == false){
    die($cnn->connect_erro . " fail connection");

}else{
    echo 'succesfull connection'."</br>";
}
?>