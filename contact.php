<?php
if(isset($_POST['email'])) {
 
    // скорректировать следующие две строки
    $email_to = "askar.aldan@gmail.com";
    $email_subject = "Новый заказ по франшизе";
 
    function died($error) {
        // код ошибки
        echo "Мы очень сожалеем, были обнаружены ошибки в отправленных Вами данных. ";
        echo "Ниже показаны возникшие ошибки.<br /><br />";
        echo $error."<br /><br />";
        echo "Пожалуйста, вернитесь и исправьте ошибки.<br /><br />";
        die();
    }
 
 
    // проверка требуемых данных
    if(!isset($_POST['name']) ||
        !isset($_POST['phone'])) {
        died('Имя и телефон являются обязательными для ввода.');       
    }
 
     
 
    $name = $_POST['name']; // требуется
    $email_from = $_POST['email']; // требуется
    $telephone = $_POST['phone']; // не требуется
    $comments = $_POST['message']; // требуется
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'Неправильный адрес электронной почты.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
    $error_message .= 'Имя указано в неверном формате.<br />';
  }
 
  if(isset($_POST['message'])&&strlen($comments) < 2) {
    $error_message .= 'Слишком короткий комментарий.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Детали поданной заявки.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }     
 
    $email_message .= "Имя: ".clean_string($name)."\n";
    $email_message .= "Телефон: ".clean_string($telephone)."\n";	
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Комментарий: ".clean_string($comments)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- Отображаемое после отправки сообщение -->
 
Спасибо за проявленный интерес. Скоро мы свяжемся с Вами.
 
<?php
 
}
?>