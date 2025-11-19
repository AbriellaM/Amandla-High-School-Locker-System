<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer classes (adjust path if needed)
require 'C:/xampp/htdocs/amandla-lockersystem/PHPMailer/src/Exception.php';
require 'C:/xampp/htdocs/amandla-lockersystem/PHPMailer/src/PHPMailer.php';
require 'C:/xampp/htdocs/amandla-lockersystem/PHPMailer/src/SMTP.php';

/**
 * Generic mail sender used by all notification wrappers.
 */
function sendMail(string $to, string $toName, string $subject, string $htmlBody, string $altBody = ''): bool {
    $mail = new PHPMailer(true);
    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'amandlahighschoollockersystem2@gmail.com'; // your Gmail
        $mail->Password   = 'rihh rxag gabw lque'; // Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Sender & recipient
        $mail->setFrom('amandlahighschoollockersystem2@gmail.com', 'Amandla High School Locker System');
         $mail->addAddress($to, $toName ?: '');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $htmlBody;
        $mail->AltBody = $altBody ?: strip_tags($htmlBody);

        $mail->send();
        error_log("sendMail: email sent to $to subject=$subject");
        return true;
    } catch (Exception $e) {
        error_log("Mailer Error: " . $mail->ErrorInfo);
        return false;
    }
}
?>