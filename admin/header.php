<?php
require "../config.php"; //include db connection
include 'AdminVoterClass.php'; //include admin Class


$admin = new AdminVoterClass($conn);
$path = $admin->getUrl($_SERVER['REQUEST_URI']); //extract current page name


if(!isset($_SESSION['adminLogger'])){ //if admin is yet to login
    header('Location:login.php');
    exit;
}
$details = $admin->getAdminDetails($_SESSION['adminLogger']); //get admin details

$voters = $admin->getVoters(); //get all voters
$candidates= $admin->getCandidates(); //get all candidates
$settings = $admin->getSettings(); //get voting time settings

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>Admin -  <?php echo strtoupper($path) ?></title>
    <meta name="author" content="Paul Jokotagba">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet"
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../animate.css">
    <style>
        body {
            font-family: 'Public Sans', sans-serif!important;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #212529;
            text-align: left;
            background: #f8f9fe!important;
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
        .calculator{
            table-layout: fixed;
        }
        .calculator tr td input[type="button"]{
            margin-bottom: 7px;
            margin-left:3px;
            margin-right:3px;
            font-size: 11px;
        }
        .calculator tr td input[type="text"]{
            margin:3px;
            width:96%;

        }
        .bgimg-1{
            position: relative;

            background-position-x: 50%;
            background-position-y: 50%;
            background-repeat: no-repeat;
            background-size: contain;
            min-height: 100vh

        }
        .bgimg-1 {
            box-shadow:inset 0 0 0 150vw rgba(255,255,255,0.8);
            background-image: url("LOGO EIT.PNG");

        }
        .myradio{
            width:15px !important;
            height:15px!important;
        }
        .answer-text{
            font-size:16px !important;
        }
        .bgimg-1{
            position: relative;

            background-position-x: 50%;
            background-position-y: 50%;
            background-repeat: no-repeat;
            background-size: contain;
            min-height: 100vh

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
        .active-link{
            background: #141d28;
            color: #fff;
        }
        .navigation-link:hover{
            background: #141d28;
            color: #fff;
        }






    </style>
    <link rel="icon" href="../images/logo.png">
    <link href="../w3.css" rel="stylesheet">
    <script src="../wow.min.js">
        new WOW().init();
    </script>
    <script>
        $(document).ready(function(){
            $(window).resize(function () {
                if ($(window).width() <= 568){
                    $('#main').animate({'marginLeft':'0px'});
                }else{

                    $('#main').animate({'marginLeft':'16.66%'});
                }
            });

            if ($(window).width() <= 750){

                $('#main').animate({'marginLeft':'0px'});

            }
            else{
                $('#main').animate({'marginLeft':'16.66%'});

            }

            $('#open').click(function () {
                $('#sidebar').slideDown();
                // $('#overlay').show().css({'width':'25%'});
                $('#close').show();
                $(this).hide();
            });
            $(document).click(function (e) {
                let sidebar = $('#sidebar, #open');
                if(!sidebar.is(e.target)  && sidebar.has(e.target).length ===0){
                    $('#sidebar').slideUp();
                    $('#close').hide();
                    $('#open').show();
                }

            })
        })
    </script>
</head>
<body class="">
<div id="sidebar" class="w3-sidebar bg-img" style="display: none;   width:75%;  background: #1c2a39;  font-size: 10px;  left:0; ">

    <?php include "sidebar.php"; ?>
</div>
<div class="w3-row">

    <div class="w3-col l2 m3 s12 d-none d-sm-block d-lg-block" id="side" style="height: 100vh; position: fixed; background: #1c2a39; overflow: auto; ">
        <?php include "navbar.php"; ?>
    </div>
    <div class="w3-col l10 m9 s12" id="main" style="margin-left: 16.66%">

        <nav class="navbar  navbar-top navbar-expand navbar-light">
            <div class="container-fluid w3-padding">
                <div class="text-left text-capitalize">
                    <a href="javascript:void(0)" style="color: inherit" id="open">
                        <i class="fa fa-list w3-large w3-hide-large w3-hide-medium"></i>
                    </a>
                    <?php echo $path ?></div>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav float-left  ml-md-auto">
                        <li class="nav-item  ">


                            <!--  <button id="small_nav" onclick="showMenu()">Test</button>-->
                            <div class="pr-3 sidenav-toggler  sidenav-toggler-light" data-action="sidenav-pin" data-target="#sidenav-main" style="z-index:10000000000000;">
                                <div class="sidenav-toggler-inner">

                                </div>
                            </div>
                        </li>
                    </ul>

                    <ul class="navbar-nav  align-items-center ml-auto ml-md-0">
                        <li class="nav-item dropdown d-sm-block">
                            <a class="nav-link pr-0" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                   <span class="avatar avatar-sm rounded-circle">
                                      <img alt="Image placeholder" src='../images/personx.jpg' width="30" height="30">
                                    </span>
                                    <div class="media-body ml-2 ">
                                        <span class="mb-0 text-sm text-capitalize text-default"><?php echo "{$details['username']}" ?> </span>
                                    </div>
                                </div>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link pr-0">
                                <i class="fa fa-sign-out" style="color: #5dbe40;"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>


