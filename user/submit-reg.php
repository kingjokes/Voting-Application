<?php
include '../config.php';
include 'UserClass.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$user = new UserClass($conn);




//register new voter
$query = $user->registration(
    $_POST['surname'],
    $_POST['othername'],
    $_POST['email'],
    $_POST['grade'],
    $_POST['faculty'],
    $_POST['department'],
    $_POST['year']
);

//if voter was registered successfully, send mail with voting link to user
if($query==='ok'){
    require '../PHPMailer-master/src/PHPMailer.php';
    require '../PHPMailer-master/src/SMTP.php';
    require '../PHPMailer-master/src/Exception.php';

// Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        //$mail->SMTPDebug = 2;                                       // Enable verbose debug output
        $mail->isSMTP();                                            // Set mailer to use SMTP
        $mail->Host       = 'mail.hyperquick.com.ng';  // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'service@hyperquick.com.ng';                     // SMTP username
        $mail->Password   = 'p?nsxb-Z^XJ;';                               // SMTP password
        $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
        $mail->Port       = 465;                                        // TCP port to connect to
        // TCP port to connect to

        //Recipients
        $mail->setFrom('service@hyperquick.com.ng', 'Ajayi Crowther Alumni Election ');
        $mail->addAddress($_POST['email'], 'Ajayi Crowther Alumni Election');     // Add a recipient
        $mail->addReplyTo('service@hyperquick.com.ng', ' Ajayi Crowther Alumni Election');
        $mail->isHTML(true);


        // Set email format to HTML
        $mail->Subject = 'Ajayi Crowther Alumni Election';
        $mail->Body = '
                <div style="font-size: 13px; line-height: 2.0; font-family: Poppins, san-serif ">
                                   
                            <br>
                            <span style="text-transform: capitalize">Dear, ' . $_POST["surname"]. ' '.$_POST["othername"]. '</span><br>
                            <span>
                            Thank you for registering for voting. Click the link below to proceed to your voting page
                            </span>
                            <br>
                            <a style="padding:5px 10px; background-color:cyan;font-size:17px; color:white; border:0;" href="https://lesvas.com/user/index.php?voterID='.md5($_POST['email']).'">Vote Here</a>
                            
                                <br>
                             
                            
                                 <br>
                                 Best Regards.
                                
                                 <br>
                                 
                    
                   
                       
                   
                        <br>
                        Thank You for choosing Ajayi Crowther Alumni Election.
                       
                        
                                       
                                        <br>
                      </div>

                                                                            ';
        $mail->AltBody = 'Ajayi Crowther Alumni Election';

        if ($mail->send()) {
            $send="";
        }
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

echo $query;

