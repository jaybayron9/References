<?php
// Verify reCAPTCHA response
$recaptchaResponse = $_POST['recaptchaResponse'];
$secretKey = '6LdIqu0mAAAAAEZ9DKBe01pPpWivJQ-TLBcW0lBa'; // Replace with your actual secret key obtained in Step 2

$url = 'https://www.google.com/recaptcha/api/siteverify';
$data = array(
    'secret' => $secretKey,
    'response' => $recaptchaResponse
);

$options = array(
    'http' => array(
        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data)
    )
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);
$response = json_decode($result);

if ($response->success) {
    echo 'success';
} else {
    echo 'error';
}
?>
