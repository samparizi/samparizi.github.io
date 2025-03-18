<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $title = htmlspecialchars($_POST['title']);
    $message = htmlspecialchars($_POST['message']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Invalid email format";
        exit;
    }

    // Email details
    $to = "your-email@iotainverse.com"; // Replace with your email address
    $subject = "Contact Form: $title";
    
    // Create email body
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Title: $title\n\n";
    $email_body .= "Message:\n$message\n";

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();

    // Try to send email
    try {
        if (mail($to, $subject, $email_body, $headers)) {
            // Success response
            http_response_code(200);
            echo json_encode(["message" => "Message sent successfully"]);
        } else {
            // Error response
            http_response_code(500);
            echo json_encode(["message" => "Failed to send message"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["message" => "An error occurred"]);
    }
} else {
    // Not a POST request
    http_response_code(403);
    echo json_encode(["message" => "Access denied"]);
}
?> 
