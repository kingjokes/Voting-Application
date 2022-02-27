<?php
/*$array = [
    [
        "id"=>1,
        "Name"=>"Printing",
        "Amount"=>200
    ],
    [
        "id"=>2,
        "Name"=>"Corrections",
        "Amount"=>100
    ],
];

function findAmount(array $array, string $search):float
{
    $result = array_filter($array, static function ($key) use ($search){
        return $key['Name']===$search;
    });
    if(count($result)===0){
        return 0;
    }
    $newArray=[...$result];

    return $newArray[0]['Amount'];

}

echo findAmount($array,'Printing');
*/

//database connection using mysqli object oriented
$host='localhost'; //host
$username='root'; //username
$password=''; //password
$table='voting'; //table

$conn = new mysqli($host,$username,$password,$table); //create connection

if($conn->connect_error){
    die("unable to connect to database"); //kill script if database connection could not be established
}

