<?php

// Retrieve form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

// Simple server-side validation for POST data
$errors = [];
if (!$name) $errors[] = 'Please enter your name.';
if (!$email) $errors[] = 'Please enter your email.';
if (!$comment) $errors[] = 'Please enter your message.';
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Please enter a valid email address.';

// If the errors array is empty, send the mail
if (empty($errors)) {
    // Recipient - replace with your email
    $to = 'daviswollesen@gmail.com';
    // Sender - from the form
    $from = $name . ' <' . $email . '>';
    
    // Subject and the HTML message
    $subject = 'Message from ' . $name;
    $message = 'Name: ' . $name . '<br/><br/>
               Email: ' . $email . '<br/><br/>
               Message: ' . nl2br($comment) . '<br/>';

    // Send the mail
    $result = sendmail($to, $subject, $message, $from);
    
    // Display the message
    if ($result) {
        echo 'Thank you! We have received your message.';
    } else {
        echo 'Sorry, unexpected error. Please try again later.';
    }
} else {
    // Display the errors message
    foreach ($errors as $error) {
        echo $error . '<br/>';
    }
    echo '<a href="index.html">Back</a>';
    exit;
}
