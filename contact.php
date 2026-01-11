<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = isset($_POST["name"]) ? trim($_POST["name"]) : "";
    $email   = isset($_POST["email"]) ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : "";
    $subject = isset($_POST["subject"]) ? trim($_POST["subject"]) : "";
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : "";

    if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?error=1");
        exit;
    }

    $recipient = "shivams9114@gmail.com";

    $email_subject = "New Contact: $subject";

    $email_content  = "New contact form submission:\n\n";
    $email_content .= "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Subject: $subject\n\n";
    $email_content .= "Message:\n$message\n";

    $email_headers = "From: $name <$email>";

    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        header("Location: thank-you.html");
        exit;
    } else {
        header("Location: contact.html?error=2");
        exit;
    }

} else {
    header("Location: contact.html?error=3");
    exit;
}
?>

