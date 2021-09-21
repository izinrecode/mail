<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demo send email</title>
    <link rel="stylesheet" href="css/style.css">
   
</head>
<?php 
include('../include/db.php');
$query = "SELECT * FROM config_setup";
$runquery = mysqli_query($db,$query);
if(!$db){
    header("location:index-2.html");
}
$data = mysqli_fetch_array($runquery);
$email = $data['email'];
$pwapp = $data['pwapp'];
$wm = $data['watermark'];
$urlwm = $data['urlwatermark'];
?>
<body>
    <div id="container">
        <h2>Demo Send Email</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="OFF">
           
                
                
                
<?php
if(isset($_POST['send'])){
$receiver = $_POST['receiver'];
$subject = $_POST['subject'];
$message = $_POST['message'];

if(empty($receiver) || empty($subject) || empty($message)){
                    ?>
                    <div id="alert">All Inputs are required</div>
                    <?php
                    }
                 }
                   
                 
?>

                
                
                
                            
            <!-- <div id="alert">All Inputs are required</div> -->
            <input type="email" name="receiver" placeholder="Email"><br>
            <input type="text" name="subject" placeholder="Subject"><br>
            <textarea name="message" placeholder="Enter Your Message Here."></textarea><br>
            <input type="submit" name="send" value="Send">
        </form>
    </div>
</body>

</html>

<?php
 if(isset($_POST['send'])){
$receiver = $_POST['receiver'];
$subject = $_POST['subject'];
$message = $_POST['message'];
}
          

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
      
//Create instance of PHPMailer
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->Host = "smtp.gmail.com";
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "tls";
	$mail->Port = "587";
	$mail->Username = $email;
	$mail->Password = $pwapp;
	$mail->Subject = "$subject";
	$mail->setFrom('kmania247@gmail.com', "");
	$mail->isHTML(true);
//$mail->addAttachment('img/ss-home.png');
	$mail->Body = "$message <br><br> <b>this is a demo send email from <a href=$urlwm>$wm</a></b>";
	$mail->addAddress("$receiver");
	if ( $mail->send() ) {
     echo '<script>alert("Demo Sent Successfully")</script>'; 
  
	}
//Closing smtp connection
	$mail->smtpClose();
