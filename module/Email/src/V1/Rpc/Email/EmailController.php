<?php
namespace Email\V1\Rpc\Email;

use Zend\Mvc\Controller\AbstractActionController;
use ZF\ContentNegotiation\ViewModel;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class EmailController extends AbstractActionController
{
  public function emailAction()
  {
    $event = $this->getEvent();
    $inputFilter = $event->getParam('ZF\ContentValidation\InputFilter');

    $fromAddress = $inputFilter->getValue('fromAddress');
    $toAddress = $inputFilter->getValue('toAddress');
    $subject = $inputFilter->getValue('subject');
    $body = $inputFilter->getValue('body');

    $mail = new PHPMailer(true);    
    try {
      $mail->SMTPDebug = 2;                                 // Enable verbose debug output
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'localhost';                            // Specify main and backup SMTP servers
      $mail->SMTPAuth = false;                              // Enable SMTP authentication (Disabled for testing)
      $mail->Username = 'user@example.com';                 // SMTP username
      $mail->Password = 'secret';                           // SMTP password
      // $mail->SMTPSecure = 'tls';                         // Enable TLS encryption, `ssl` also accepted (Disabled for testing)
      $mail->Port = 2025;                                   // TCP port to connect to

      $mail->setFrom($fromAddress);
      $mail->addAddress($toAddress);                        // Add a recipient

      $mail->isHTML(false);
      $mail->Subject = $subject;
      $mail->Body    = $body;

      $mail->send();

      return new ViewModel([
			  'result' => 'success' 
      ]);

    } catch (Exception $e) {
      return new ViewModel([
	      'result' => 'error',
	      'error' => $mail->ErrorInfo
      ]);
    }
  }
}
