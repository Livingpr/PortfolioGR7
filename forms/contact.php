
<?php
header('Content-Type: text/plain; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Invalid request method.');
}

$name     = trim($_POST['name'] ?? '');
$phone    = trim($_POST['phone'] ?? '');
$email    = trim($_POST['email'] ?? '');
$checkin  = trim($_POST['checkin'] ?? '');
$checkout = trim($_POST['checkout'] ?? '');
$guests   = trim($_POST['guests'] ?? '');
$message  = trim($_POST['message'] ?? '');

if (
    $name === '' ||
    $phone === '' ||
    !filter_var($email, FILTER_VALIDATE_EMAIL)
) {
    http_response_code(400);
    exit('Please provide your name, phone number, and a valid email.');
}

$receiving_email_address = 'YOUR_REAL_EMAIL@example.com';

$subject = 'New Chavakali Hotel booking inquiry';

$body =
    "New booking inquiry\n\n" .
    "Name: $name\n" .
    "Phone: $phone\n" .
    "Email: $email\n" .
    "Check-in: $checkin\n" .
    "Check-out: $checkout\n" .
    "Guests: $guests\n\n" .
    "Message:\n$message\n";

$headers = [
    'From' => $receiving_email_address,
    'Reply-To' => $email,
    'Content-Type' => 'text/plain; charset=UTF-8'
];

if (mail($receiving_email_address, $subject, $body, $headers)) {
    echo 'OK';
} else {
    http_response_code(500);
    exit('Email delivery is not configured. Please try again later.');
}
?>
