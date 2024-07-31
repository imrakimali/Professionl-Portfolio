<?php

// Set the recipient email address
$receiving_email_address = 'rakimali770@gmail.com';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    // Set email headers
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

    // Create the full message
    $full_message = "You have received a new message from your website contact form.\n\n";
    $full_message .= "Here are the details:\n\n";
    $full_message .= "Name: $name\n";
    $full_message .= "Email: $email\n";
    $full_message .= "Subject: $subject\n";
    $full_message .= "Message:\n$message\n";

    // Send the email
    if (mail($receiving_email_address, $subject, $full_message, $headers)) {
        echo 'Email sent successfully!';
    } else {
        echo 'Failed to send email.';
    }
}
?>
