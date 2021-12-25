<?php
//log voter out and destroy all session
session_start();
if(isset($_SESSION['voterLogger'])){
    session_unset();
    session_destroy();
    header('location:../index.php');
}

