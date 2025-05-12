<?php
// General contact form email handling script
header('Content-Type: application/json');

// Define variables to store form data
$name = isset($_POST['dzName']) ? $_POST['dzName'] : '';
$email = isset($_POST['dzEmail']) ? $_POST['dzEmail'] : '';
$phone = isset($_POST['dzPhoneNumber']) ? $_POST['dzPhoneNumber'] : '';
$message = isset($_POST['dzMessage']) ? $_POST['dzMessage'] : '';
$subject = isset($_POST['dzSubject']) ? $_POST['dzSubject'] : 'Contact Form Submission';
$toDo = isset($_POST['dzToDo']) ? $_POST['dzToDo'] : '';

// Email settings
$to = "info@vijethamart.com"; // Your email address

// Build email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Phone: $phone\n\n";
$email_content .= "Message:\n$message\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Validation
$response = array();
if(empty($name) || empty($email) || empty($message)) {
    $response['status'] = 0;
    $response['msg'] = "Please fill in all required fields.";
    echo json_encode($response);
    exit;
}

// Email validation
if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['status'] = 0;
    $response['msg'] = "Please provide a valid email address.";
    echo json_encode($response);
    exit;
}

// Send email
$mail_sent = mail($to, $subject, $email_content, $headers);

if($mail_sent) {
    $response['status'] = 1;
    $response['msg'] = "Thank you for contacting us! We will get back to you as soon as possible.";
} else {
    $response['status'] = 0;
    $response['msg'] = "Sorry, there was an error sending your message. Please try again later.";
}

echo json_encode($response);
?> 