<?php
session_start();
if(isset($_SESSION['adminLogger'])){
    session_unset();
    session_destroy();
    header('location:login.php');
}



