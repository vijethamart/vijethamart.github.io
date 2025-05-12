# Contact Form Email Configuration

This directory contains PHP scripts for handling contact form submissions on the Vijetha Mart website.

## Files Included

- `contact_smtp.php`: Handles table reservation form submissions
- `general_contact.php`: Handles general contact form submissions

## Configuration

### Basic PHP Mail (Default)

The scripts are currently configured to use PHP's built-in `mail()` function. This requires:

1. A properly configured mail server on your hosting environment
2. Appropriate PHP mail settings in your php.ini file

### Using an SMTP Server (Recommended)

For more reliable email delivery, we recommend using an SMTP server instead. To implement this:

1. Install PHPMailer library: `composer require phpmailer/phpmailer`
2. Replace the mail sending code in the PHP files with PHPMailer code
3. Configure with your SMTP server details

Example PHPMailer configuration:

```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->SMTPDebug = 0;                     // Disable debug output
    $mail->isSMTP();                          // Use SMTP
    $mail->Host       = 'smtp.example.com';   // SMTP server
    $mail->SMTPAuth   = true;                 // Enable SMTP authentication
    $mail->Username   = 'username';           // SMTP username
    $mail->Password   = 'password';           // SMTP password
    $mail->SMTPSecure = 'tls';                // Enable TLS encryption
    $mail->Port       = 587;                  // TCP port (usually 587 for TLS)

    // Recipients
    $mail->setFrom('info@vijethamart.com', 'Vijetha Mart');
    $mail->addAddress($to);                   // Add recipient
    $mail->addReplyTo($email, $name);         // Add reply-to address

    // Content
    $mail->isHTML(false);                     // Set email format to plain text
    $mail->Subject = $subject;
    $mail->Body    = $email_content;

    $mail->send();
    $response['status'] = 1;
    $response['msg'] = "Thank you for your message! We will get back to you as soon as possible.";
} catch (Exception $e) {
    $response['status'] = 0;
    $response['msg'] = "Sorry, there was an error sending your message. Please try again later.";
}
```

## Customization

You can customize the recipient email addresses by editing the `$to` variable in each script:

```php
$to = "info@vijethamart.com"; // Change to your email address
```

For security reasons, ensure your PHP files are not accessible directly if you include sensitive SMTP credentials. 