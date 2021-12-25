<?php
//database connection using mysqli object oriented
$host='localhost'; //host
$username='root'; //username
$password=''; //password
$table='voting'; //table

$conn = new mysqli($host,$username,$password,$table); //create connection

if($conn->connect_error){
    die("unable to connect to database"); //kill script if database connection could not be established
}

