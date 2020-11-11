<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings

	$mail->Host = '127.0.0.1';        // Set the SMTP server to send through
	$mail->isSMTP();                  // Send using SMTP
	$mail->SMTPAuth   = false; 	  // Enable SMTP authentication
        $mail->SMTPAutoTLS = false;
	$mail->Port = 25;                 // Par défaut 587 ou 465

        $mail->SMTPDebug = 2;       // Enable verbose debug output

        //$mail->Username   = 'philippe.simier.pro@gmail.com';   // SMTP username
        //$mail->Password   = 'touchard72';                   // SMTP password
        //$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted


        //Recipients
        $mail->setFrom('philippe.simier.pro@gmail.com', 'Philippe SIMIER');
        $mail->addAddress('philaure@wanadoo.fr', 'Philippe SIMIER');


    // Attachments
    $mail->addAttachment('README.md');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Test phpMailer with postfix';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>
