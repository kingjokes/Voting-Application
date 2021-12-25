<?php
require_once '../config.php';
include "AdminVoterClass.php";

$admin = new AdminVoterClass($conn);
$login = $admin->login($_POST['username'], $_POST['password']);

if($login){
    echo "ok";
    exit;
}

echo "Invalid Login Credentials";
