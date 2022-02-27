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
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Public+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="animate.css">
        <!--end of import -->
        <style>
            body {
                font-family: 'Public Sans', sans-serif!important;
            background-color:rgb(255, 255, 255);
            }
            a{
                text-decoration: none !important;
                color:inherit !important;
            }

            .contentHolder{
                background-color: rgb(255, 255, 255);
                color: rgb(33, 43, 54);
                transition: box-shadow 300ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
                background-image: none;
                overflow: hidden;
                position: relative;
                box-shadow: rgb(145 158 171 / 20%) 0px 0px 2px 0px, rgb(145 158 171 / 12%) 0px 12px 24px -4px;
                border-radius: 16px;
                z-index: 0;
                width: 100%;
                max-width: 464px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                margin: 16px 0px 16px 16px;
                height:100vh;
            }
            .header{
                margin:0 auto;
                font-weight: 600;
                line-height: 1.5;
                font-size: 1.5rem;
                font-family: "Public Sans", sans-serif;
                padding-left: 40px;
                padding-right: 40px;
            }
            .formHolder{
                margin: auto;
                min-height: 100vh;
                padding: 96px 5px;
                color: rgb(33, 43, 54);
                line-height: 1.5;
                font-size: 1rem;
                font-family: "Public Sans", sans-serif;
                font-weight: 400;
                justify-content: center;
                max-width: 480px;
                display: flex;
                flex-direction: column;


            }
            .formHeader{
                margin: 0px 0px 8px;
                font-weight: 700;
                line-height: 1.5;
                font-size: 1.25rem;
                font-family: "Public Sans", sans-serif;

            }
            .formSubtitle{
                margin: 0px;
                line-height: 1.5;
                font-size: 1rem;
                font-family: "Public Sans", sans-serif;
                font-weight: 400;
                color: rgb(99, 115, 129);
            }

            .formInput{
                line-height: 1.4375em!important;
                font-size: 1rem!important;
                font-family: "Public Sans", sans-serif!important;
                font-weight: 400!important;
                color: rgb(33, 43, 54)!important;
                cursor: text!important;
                width: 100%!important;!important;
                border-radius: 8px!important;
                letter-spacing: inherit!important;
                border: 0.5px solid rgb(145, 158, 171)!important;;
                background: none;
                height: 1.4375em;
                margin: 0px;
                -webkit-tap-highlight-color: transparent;
                display: block;
                animation-name: mui-auto-fill-cancel;
                animation-duration: 10ms;
                padding: 25px 10px;
            }
            .formButton{

                -webkit-tap-highlight-color: transparent;
                font-weight: 400;
                line-height: 1.71429;
                font-size: 0.9375rem;
                text-transform: capitalize;
                font-family: "Public Sans", sans-serif;
                padding: 8px 22px;
                border-radius: 8px;
                color: rgb(255, 255, 255)!important;
                background-color: rgb(55, 111, 208)!important;
                width: 100%!important;
                box-shadow: rgb(55, 111, 208 / 24%) 0px 8px 16px 0px;
                height: 48px;
                transition: background-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms,
                box-shadow 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms,
                border-color 250ms cubic-bezier(0.4, 0, 0.2, 1) 0ms;
            }
            .imageContainer{
                width: 80px;
                height: 80px;
                cursor: pointer;
                margin: 0 auto;
            }









        </style>
        <link rel="icon" href="./images/logo.png">
        <link href="w3.css" rel="stylesheet">
        <script src="wow.min.js">
            new WOW().init();
        </script>
    </head>
    <body class="">

    <div class="w3-row w3-padding">
        <div class="w3-col l4 m5 s12 w3-hide-small">

            <div class="contentHolder">

                <div class="header">
                    <div class="imageContainer ">
                        <img src="images/logo.png" alt="" class="w3-image">
                    </div>
                    <br>
                    <span>Online E-Voting Portal</span>
                </div>
                <br>
                <div class="imageHolder">
                    <img class="w3-image" src="./images/bg.png">
                </div>
            </div>

        </div>
        <div class="w3-col l1 m1 s12">
            &nbsp;
        </div>
        <div class="w3-col l6 m5 s12">
            <div class="formHolder">
                <div class="imageContainer w3-hide-large w3-hide-medium" style="margin-bottom: 15px!important;">
                    <img src="images/logo.png"  alt="" class="w3-image">
                    <br><br>
                </div>
                <h2 class="formHeader">Get started with voter's registration.</h2>
                <p class="formSubtitle">Kindly fill the form below.</p>
                <br>
                <div class="">
                    <div id="success" class="alert alert-success alert-dismissible"  style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        Registration successful, kindly check your email for further instruction(s)
                    </div>
                    <div id="error" class="alert alert-danger alert-dismissible" style="display: none">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>

                    </div>
                    <form id="form" class="" action="" method="post">
                        <div class="row" >
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <input class="formInput  w3-mobile" required   type="text" placeholder="Matric No" name="matric_no" >

                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <input class="formInput   w3-mobile"  required  type="text" placeholder="Enter your Surname" name="surname">
                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <input class="formInput   w3-mobile"  required  type="text" placeholder="Enter your Other Names" name="othername">
                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <input class="formInput   w3-mobile" required   type="email" placeholder="Email" name="email">
                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <select
                                        style="   border-radius: 8px!important;
                                         border: 1px solid rgb(145, 158, 171)!important;
                                         padding: 15px 10px; background: none;"
                                        class="w3-input   "
                                        required
                                        name="grade" >
                                    <option value="">Select Grade</option>
                                    <option value="first_class">First Class</option>
                                    <option value="second_class_upper">Second Class Upper</option>
                                    <option value="second_class_lower">Second Class Lower</option>
                                    <option value="third_class">Third Class</option>
                                    <option value="pass">Pass</option>
                                </select>
                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-6 col-lg-6 col-sm-6">
                                <input class="formInput  w3-mobile" required   type="number" placeholder="Year of graduation" name="year" >
                            </div>
                            <div style="margin-bottom: 20px!important;" class="col col-12 col-md-12 col-lg-12 col-sm-12">
                                <input class="formInput   w3-mobile" required   type="text" placeholder="Enter your Department" name="department" >
                            </div>
                        </div>
                        <br>

                        <button id="reg" style="  width: 100%!important;" class="formButton w3-btn w3-block">Register Now</button>
                       <br><br>
                        <script>
                            $(document).ready(function(){
                                $('#form').on('submit', function(e){
                                    e.preventDefault()
                                    let data = $(this).serialize();
                                    $.ajax({
                                        method:'POST',
                                        url:'./user/submit-reg.php',
                                        data:data,
                                        dataType:'text',
                                        beforeSend: function(){
                                            $('#reg').text('Please wait...')
                                            $('#success, #error').fadeOut();
                                        },
                                        success: function(response){
                                            window.scroll(0,0)
                                            if(response==="ok"){

                                                $('#success').fadeIn()
                                                $('#error').fadeOut()
                                                $('#form')[0].reset()
                                                $('#reg').text('Submit')
                                                setTimeout(function(){
                                                    $('#success1').fadeOut()
                                                }, 3000)
                                                /*   setTimeout(function(){
                                                       window.location.href='./user/dashboard.php'
                                                   },3000)*/

                                            }else{
                                                $('#error').fadeIn().text(response)
                                                setTimeout(function(){
                                                    $('#error').fadeOut()
                                                }, 3000)
                                                $('#success').fadeOut();
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
    </div>

    </body>
</html>
