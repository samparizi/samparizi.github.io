<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "xxx.bb@gmail.com";
    $subject = $_POST["title"];
    $message = $_POST["message"];
    $headers = "From: " . $_POST["email"] . "\r\n" .
        "Reply-To: " . $_POST["email"] . "\r\n" .
        "X-Mailer: PHP/" . phpversion();

    if (mail($to, $subject, $message, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Message could not be sent.";
    }
}
?>





