<?php
include "../config.php"; //include database connection file
include "../admin/AdminVoterClass.php"; //include adminClass
include "UserClass.php"; //include userClass

$user = new UserClass($conn); //initiate class
$admin = new AdminVoterClass($conn); //initiate class

$voters = (new AdminVoterClass($conn))->getVoters(); //get list of all voters

if(!isset($_SESSION['voterLogger'])){ //if voter is yet to log in, redirect to home page
    header('Location:../index.php');
    exit;
}

$totalVotes= $user->getAllVotes(); //get sum of voters who had voted

$uncastedVotes = $voters[0] - (float)$totalVotes['total'];  //get sum of  voters who are yet to vote

$details = $user->getUserDetails($_SESSION['voterLogger']); //get the voter's details
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>Voters Dashboard</title>
    <!--Author of the application-->
    <meta name="author" content="Paul Jokotagba">

    <!--Import of js and css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <link rel="icon" href="../images/logo.png">
    <link href="../w3.css" rel="stylesheet">
    <script src="../wow.min.js">
        new WOW().init();
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <!--end of import -->

    <link rel="stylesheet" href="../animate.css">
    <style>
        body {
            font-family: 'Lato', sans-serif !important;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background-color: #f6f8fa;
        }
        a{
            text-decoration: none !important;
            color:inherit !important;
        }
        .login-inputs{
            padding: 10px 20px;
            font-size: 16px;
            outline: none;
            height: 50px;
            /*width:% !important;*/
            background: rgba(23, 23, 23, 0.72);
            color: #616161;
            border-radius: 3px;
            font-weight: 500;
            border: 1px solid transparent;
            background: #fff;
            box-shadow: 0 0 5px rgb(0 0 0 / 20%);
        }
        .login-button{
            background: #ff2f2f !important;
            box-shadow: 0 0 5px rgb(0 0 0 / 20%);
            border: none;
            color: #fff !important;
            cursor: pointer;
            padding: 13px 50px 12px 50px;
            font-size: 17px;
            font-weight: 400;
            border-radius: 50px;
            width: 100%;
        }


        .mybuttons {
            padding: 5px 10px;
            margin: 10px 5px;
            border-radius: 5px;
            cursor: pointer;
            background: #ddd;
            border: 1px solid #ccc;
        }
        .mybuttons:hover {
            background: #ccc;
        }
        .unanswered{
            color: #721c24 !important;
            background-color: #FFB6C1 !important;
            border-color: #f5c6cb !important;
        }
        .answered{
            color: #155724 !important;
            background-color: #d4edda !important;
            border-color: #c3e6cb !important;
        }
        .w3-check{
            cursor:pointer!important;
        }






    </style>
</head>
<body class="">
