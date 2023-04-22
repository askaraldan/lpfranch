<?php
/*
  PHP contact form script
  Version: 1.1
  Copyrights BootstrapMade.com
*/

/***************** Configuration *****************/

  // Replace with your real receiving email address
  $contact_email_to = "sfransizator1@gmail.com";
  //$contact_email_to = "lpfranch@unigroup.kz";

  // Title prefixes
  $name_title = "Имя:";
  $phone_title = "Телефон:";
  $email_title = "E-mail:";
  $message_title = ""; //"Сообщение клиента:";

  // Error messages
  $contact_error_name = "Имя слишком короткое или пустое";
  $contact_error_phone = "Пожалуйста, введите правильный номер телефона!";
  $contact_error_email = "Пожалуйста, введите правильный email!";
  $contact_error_subject = "Тема пустая или слишком короткая!";
  $contact_error_message = "Слишком короткое сообщение. Пожалуйста, напишите что-нибудь.";

/********** Do not edit from the below line ***********/

  if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
    die('Sorry Request must be Ajax POST');
  }

  if(isset($_POST)) {
/*
    $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
	$phone = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $subject = filter_var($_POST["subject"], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);
	*/
    $name = $_POST["name"];
	$phone = $_POST["phone"];
    $email = $_POST["email"];
    $subject = $_POST["subject"];
    $message = $_POST["message"];
	$state = $_POST["state"];

    if(!$contact_email_to || $contact_email_to == 'contact@example.com') {
      die('The contact form receiving email address is not configured!');
    }

    /*if(strlen($name)<3){
      die($contact_error_name);
    }

    if(!$email){
      die($contact_error_email);
    }

    if(strlen($subject)<3){
      die($contact_error_subject);
    }

    if(strlen($message)<3){
      die($contact_error_message);
    }
	*/
    //if(!isset($contact_email_from)) {
      $contact_email_from = "webmaster@lpfranch.kz";
    //}
/*
    $headers = 'From: <' . $contact_email_from . '>' . PHP_EOL;
    $headers .= 'Reply-To: ' . $email . PHP_EOL;
    $headers .= 'MIME-Version: 1.0' . PHP_EOL;
    $headers .= 'Content-Type: text/html; charset=UTF-8' . PHP_EOL;
    $headers .= 'X-Mailer: PHP/' . phpversion();
*/

    $headers = "Content-type:text/html; charset = utf-8\r\nFrom:$contact_email_from";
	
	$message_content =  'Заказ франшизы Unigroupkz!<br>';
    $subject_title = "Заказ франшизы с сайта unigroup.kz";	
	if($state == 'presentation') {
		$subject_title = "Скачивание презентации с сайта unigroup.kz";	
		$message_content =  'Скачивание презентации с сайта unigroup.kz<br>';
	}
	
    $message_content .=  $name_title .  $name . '<br>';
	$message_content .= $phone_title . $phone . '<br>';
    $message_content .= $email_title .  $email . '<br>';
    $message_content .= $message_title . nl2br($message);

    $sendemail = mail($contact_email_to, $subject_title . ' ' . $subject, $message_content, $headers);

    if( $sendemail ) {
      echo 'OK';
    } else {
      echo 'Could not send mail! Please check your PHP mail configuration.';
    }
  }
?>
