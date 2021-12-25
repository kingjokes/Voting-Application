<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <title>Admin Login - Voting Portal</title>
    <meta name="author" content="Paul Jokotagba">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet"

    <link rel="stylesheet" href="../animate.css">
    <style>
        body {
            font-family: 'Lato', sans-serif !important;
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
        .bgimg-1 {
            box-shadow:inset 0 0 0 150vw rgba(255,255,255,0.97);
            background-image: url("{{asset('/img/logo.png')}}");

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






    </style>
    <link rel="icon" href="../images/logo.png">
    <link href="../w3.css" rel="stylesheet">
    <script src="../wow.min.js">
        new WOW().init();
    </script>
</head>
<body class="">
<div class="w3-row">
    <div class="w3-col l6 m6 s12" style="background: #FAFAFA;min-height: 100vh; color:#535353;    padding: 15px 0;">
        <br>
        <div class=" w3-center">
            <img class="w3-image " style="height:90px; width:90px" src="../images/logo.png">
        </div>
        <br>
        <div class="wow fadeIn" data-wow-duration="2s" style="padding: 0 15px; line-height: 1.9">
            <div class="w3-center">
                <h3>Admin Login</h3>
            </div>
            <br>
            <div class="w3-row">
                <div class="w3-col l2 m12 s12">
                    &nbsp;
                </div>

                <div class="w3-col l9 m12 s12">
                    <div id="success" class="alert alert-success alert-dismissible"  style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Login successful, redirecting now..
                    </div>
                    <div id="error" class="alert alert-danger alert-dismissible" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                    </div>
                    <form id="form" class="" action="" method="post"  style="line-height: 1.7 !important;">
                        <input class="login-inputs w3-input  w3-mobile "  required  type="text" placeholder="Enter your username" name="username">
                        <span class="text text-danger"></span>
                        <br>
                        <input class="login-inputs w3-input w3-mobile" required   type="password" placeholder="Enter your password" name="password" >
                        <span class="text text-danger"></span>
                        <br><br>
                        <button class="login-button w3-btn w3-hover-shadow w3-hover-red w3-mobile" id="reg">Login</button>
                        <br><br>
                        <script>
                            $(document).ready(function(){
                                $('#form').on('submit', function(e){
                                    e.preventDefault()
                                    let data = $(this).serialize();
                                    $.ajax({
                                        method:'POST',
                                        url:'login-checker.php',
                                        data:data,
                                        dataType:'text',
                                        beforeSend: function(){
                                            $('#reg').text('Checking details...')
                                            $('#success, #error').fadeOut();
                                        },
                                        success: function(response){
                                            if(response==="ok"){
                                                $('#success').fadeIn()
                                                $('#error').fadeOut()
                                                   setTimeout(function(){
                                                       window.location.href='dashboard.php'
                                                   },3000)

                                            }else{
                                                $('#error').fadeIn().text(response)
                                                $('#success').fadeOut();
                                                $('#reg').text('Login')
                                            }
                                        }

                                    })

                                })
                            })
                        </script>
                    </form>
                </div>
            </div>






        </div>
        <div class="w3-center w3-padding">
            <i class="w3-text-grey w3-small">LEVAS INC</i>
        </div>
    </div>
    <div class="w3-col l6 m6 s12 w3-hide-small" style="background: #ffffff;min-height: 100vh; color:#535353;    padding: 15px 0;">
        <br><br><br><br><br>
        <img class="w3-image" src="../images/background.png" style="width: 90%; height: auto;">
    </div>

</div>

</body>
</html>
