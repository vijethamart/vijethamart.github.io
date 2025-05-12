<?php
// Contact form email handling script
header('Content-Type: application/json');

// Define variables to store form data
$name = isset($_POST['dzName']) ? $_POST['dzName'] : '';
$email = isset($_POST['dzEmail']) ? $_POST['dzEmail'] : '';
$phone = isset($_POST['dzPhoneNumber']) ? $_POST['dzPhoneNumber'] : '';
$message = isset($_POST['dzMessage']) ? $_POST['dzMessage'] : '';
$guests = isset($_POST['dzOther']['Person']) ? $_POST['dzOther']['Person'] : '';
$toDo = isset($_POST['dzToDo']) ? $_POST['dzToDo'] : '';

// Email settings
$to = "info@vijethamart.com"; // Change this to your email address
$subject = "Table Reservation Request from $name";

// Build email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n";
$email_content .= "Phone: $phone\n";
$email_content .= "Number of Guests: $guests\n\n";
$email_content .= "Special Requests:\n$message\n";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Validation
$response = array();
if(empty($name) || empty($email) || empty($phone)) {
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
    $response['msg'] = "Thank you for your reservation request! We will contact you shortly to confirm.";
} else {
    $response['status'] = 0;
    $response['msg'] = "Sorry, there was an error sending your message. Please try again later.";
}

echo json_encode($response);
?> 