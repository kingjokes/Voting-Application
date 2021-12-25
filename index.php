<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <title>Voting Portal</title>
        <!--Author of the application-->
        <meta name="author" content="Paul Jokotagba">

        <!--Import of js and css-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900">
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet"

        <link rel="stylesheet" href="animate.css">
        <!--end of import -->
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






        </style>
        <link rel="icon" href="./images/logo.png">
        <link href="w3.css" rel="stylesheet">
        <script src="wow.min.js">
            new WOW().init();
        </script>
    </head>
    <body class="">
    <div class="w3-row">
        <div class="w3-col l6 m6 s12" style="background: #FAFAFA;min-height: 100vh; color:#535353;    padding: 15px 0;">
            <br>
            <div class=" w3-center">
                <img class="w3-image " style="height:90px; width:90px" src="images/logo.png">
            </div>
            <div class="wow fadeIn" data-wow-duration="2s" style="padding: 0 15px; line-height: 1.9">
                <div class="w3-center">
                    <h3>Voters Registration</h3>
                    <span>Kindly fill the form below</span>
                </div>
                <br>
                <div class="w3-row">
                    <div class="w3-col l2 m12 s12">
                        &nbsp;
                    </div>

                    <div class="w3-col l9 m12 s12 w3-padding">
                            <div id="success" class="alert alert-success alert-dismissible"  style="display: none">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Registration successful, kindly check your email for further instruction(s)
                            </div>
                            <div id="error" class="alert alert-danger alert-dismissible" style="display: none">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>

                            </div>
                        <form id="form" class="" action="" method="post"  style="line-height: 1.7 !important;">
                            <input class="login-inputs w3-input  w3-mobile"  required  type="text" placeholder="Enter your Surname" name="surname">
                            <span class="text text-danger"></span>
                            <br>
                            <input class="login-inputs w3-input  w3-mobile"  required  type="text" placeholder="Enter your Other Names" name="othername">
                            <span class="text text-danger"></span>
                            <br>
                            <input class="login-inputs w3-input  w3-mobile" required   type="email" placeholder="Email on graduation brochure" name="email">
                            <span class="text text-danger"></span>
                            <br>
                            <select class="login-inputs w3-input w3-mobile" required    name="grade" >
                                <option value="">Select Grade</option>
                                <option value="first_class">First Class</option>
                                <option value="second_class_upper">Second Class Upper</option>
                                <option value="second_class_lower">Second Class Lower</option>
                                <option value="third_class">Third Class</option>
                                <option value="pass">Pass</option>
                            </select>
                            <span class="text text-danger"></span>
                            <br>
                            <input class="login-inputs w3-input w3-mobile" required   type="text" placeholder="Enter your Faculty" name="faculty" >
                            <span class="text text-danger"></span>
                            <br>

                            <input class="login-inputs w3-input w3-mobile" required   type="text" placeholder="Enter your Department" name="department" >
                            <span class="text text-danger"></span>
                            <br>
                            <input class="login-inputs w3-input w3-mobile" required   type="number" placeholder="Year of graduation" name="year" >
                            <span class="text text-danger"></span>
                            <div id="success1" class="alert alert-success alert-dismissible w3-hide-large w3-hide-medium"  style="display: none">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                Registration successful, kindly check your email for further instruction(s)
                            </div>
                            <div id="error1" class="alert alert-danger alert-dismissible w3-hide-large w3-hide-medium" style="display: none">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>

                            </div>
                            <br><br>
<!--                            <button class="login-button w3-btn w3-hover-shadow w3-hover-red w3-mobile" id="reg">Submit</button>-->
                            <a href="javascript:void(0)" id="close" class="login-button w3-btn w3-hover-shadow w3-hover-red w3-mobile" >Submit</a>
                            <br><br>
                            <script>
                                $(document).ready(function(){
                                    $('#form').on('submit', function(e){
                                        e.preventDefault()
                                        window.alert('Voters registration is now closed. Thank You')
                                        return;
                                        let data = $(this).serialize();
                                        $.ajax({
                                            method:'POST',
                                            url:'./user/submit-reg.php',
                                            data:data,
                                            dataType:'text',
                                            beforeSend: function(){
                                                $('#reg').text('Please wait...')
                                                $('#success, #error,#success1, #error1').fadeOut();
                                            },
                                            success: function(response){
                                                if(response==="ok"){
                                                    $('#success,#success1').fadeIn()
                                                    $('#error, #error1').fadeOut()
                                                    $('#form')[0].reset()
                                                    $('#reg').text('Submit')
                                                    setTimeout(function(){
                                                        $('#success1').fadeOut()
                                                    }, 3000)
                                                 /*   setTimeout(function(){
                                                        window.location.href='./user/dashboard.php'
                                                    },3000)*/

                                                }else{
                                                    $('#error, #error1').fadeIn().text(response)
                                                    setTimeout(function(){
                                                        $('#error, #error1').fadeOut()
                                                    }, 3000)
                                                    $('#success, #success1').fadeOut();
                                                    $('#reg').text('Submit')
                                                }
                                            }

                                        })

                                    })
                                    $('#close').click(function(){
                                        window.alert('Voters registration is now closed. Thank You')
                                        return;
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
            <img class="w3-image" src="./images/background.png" style="width: 90%; height: auto;">
        </div>

    </div>

    </body>
</html>