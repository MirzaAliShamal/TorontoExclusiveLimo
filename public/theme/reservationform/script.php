<?php
$error_fields = array();
$email_content = array();

define('_EMAIL_TO', 'info@torontoexclusivelimo.com'); // your email address where reservation details will be received
define('_EMAIL_SUBJECT', 'Message via Toronto Exclusive Limousine'); // email message subject
define('_EMAIL_FROM', $_POST["email"]);

  // echo '<pre>'; print_r($_POST); echo '</pre>';
if(isset($_POST['captcha-response']) && !empty($_POST['captcha-response'])){
    // echo "111";
    // Google reCaptcha secret key
    $secretKey  = "6LdlrXMaAAAAAFLecnVJxB_YBQZFGANMYAzB5qK1";
    // Get verify response data
    $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['captcha-response']);
    $responseData = json_decode($verifyResponse);
    // echo '<pre>'; print_r($responseData); echo '</pre>';
    if(!($responseData->success)){
    // echo "222";

        // echo "Robot verification failed, please try again.";
       // echo json_encode(array('code' => 'failed', 'fields' => $error_fields));
      echo (json_encode(array('code' => 'failed-recaptcha')));
      exit;

    }
} else {
    // echo "333";

  echo (json_encode(array('code' => 'failed-recaptcha')));
  exit;
}

$fields = array(
    array('name' => 'name', 'title' => 'Name', 'valid' => array('require')),
    array('name' => 'email', 'title' => 'Email', 'valid' => array('require')),
    array('name' => 'phone', 'title' => 'Phone', 'valid' => array('')),
    array('name' => 'service-type', 'title' => 'Type of Service', 'valid' => array('')),
    array('name' => 'vehicle-type', 'title' => 'Type of Vehicle', 'valid' => array('')),
    array('name' => 'date', 'title' => 'Pickup Date', 'valid' => array('')),
    array('name' => 'pickup-location', 'title' => 'Pick-up Location', 'valid' => array('')),
    array('name' => 'drop-location', 'title' => 'Drop-off Location', 'valid' => array('')),
    array('name' => 'return-details', 'title' => 'Return Pick-up Details', 'valid' => array('')),
    array('name' => 'return-pickup', 'title' => 'Return Pickup Date', 'valid' => array('')),
    array('name' => 'card-type', 'title' => 'Card Type', 'valid' => array('')),
    array('name' => 'card-number', 'title' => 'Card Number', 'valid' => array('')),
    array('name' => 'expire-date', 'title' => 'Expiration Date', 'valid' => array(''))
);


foreach ($fields AS $field){
    $value = isset($_POST[$field['name']])?$_POST[$field['name']]:'';
    $title = empty($field['title'])?$field['name']:$field['title'];
    $email_content[] = $title.': '.nl2br(stripslashes($value));
    $is_valid = true;
    $err_message = '';
    if (!empty($field['valid'])){
        foreach ($field['valid'] AS $valid) {
            switch ($valid) {
                case 'require':
                    $is_valid = $is_valid && strlen($value) > 0;
                    $err_message = 'Field required';
                    break;
                case 'email':
                    $is_valid = $is_valid && preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i", $value);
                    $err_message = 'Email required';
                    break;
                default:
                    break;
            }
        }
    }
    if (!$is_valid){
        if (!empty($field['err_message'])){
            $err_message = $field['err_message'];
        }
        $error_fields[] = array('name' => $field['name'], 'message' => $err_message);
    }
}

if (empty($error_fields)){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers = "From: "._EMAIL_FROM."\r\n";
    $headers .= "Reply-To: "._EMAIL_FROM."\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    // Send email
    mail (_EMAIL_TO, _EMAIL_SUBJECT, implode('<hr>', $email_content), $headers);
    echo (json_encode(array('code' => 'success')));
}else{
    echo json_encode(array('code' => 'failed', 'fields' => $error_fields));
}