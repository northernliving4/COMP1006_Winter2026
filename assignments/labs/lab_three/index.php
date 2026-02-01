<?php
// COMP1006 – Lab 3
// Handles validation, sanitization, and email sending

// ------------------------------------
// Only accept POST requests
// ------------------------------------
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}

// ------------------------------------
// Helper functions
// ------------------------------------
function clean(string $value): string {
    return trim($value);
}

function escape(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, "UTF-8");
}

// ------------------------------------
// Read input
// ------------------------------------
$firstName = clean($_POST["firstName"] ?? "");
$lastName  = clean($_POST["lastName"] ?? "");
$email     = clean($_POST["email"] ?? "");
$message   = clean($_POST["message"] ?? "");

// ------------------------------------
// Validation
// ------------------------------------
$errors = [];

if ($firstName === "") $errors[] = "First name is required.";
if ($lastName === "")  $errors[] = "Last name is required.";
if ($email === "")     $errors[] = "Email is required.";
if ($message === "")   $errors[] = "Message is required.";

if (strlen($firstName) > 40)  $errors[] = "First name is too long.";
if (strlen($lastName) > 40)   $errors[] = "Last name is too long.";
if (strlen($email) > 80)      $errors[] = "Email is too long.";
if (strlen($message) > 1000)  $errors[] = "Message is too long.";

if ($email !== "" && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Email format is invalid.";
}

// ------------------------------------
// Show errors
// ------------------------------------
if (!empty($errors)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Error</title>
</head>
<body>

  <h1>Form Errors</h1>
  <ul>
    <?php foreach ($errors as $error): ?>
      <li><?= escape($error) ?></li>
    <?php endforeach; ?>
  </ul>

  <a href="index.html">Go back</a>

</body>
</html>
<?php
    exit;
}

// ------------------------------------
// Send email
// ------------------------------------
$to = "info@example.com"; // change if needed
$subject = "Contact Form Submission";

$body =
"First Name: $firstName\n" .
"Last Name: $lastName\n" .
"Email: $email\n\n" .
"Message:\n$message\n";

$headers  = "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8";

$mailSent = @mail($to, $subject, $body, $headers);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Form Submitted</title>
</head>
<body>

  <h1>Thank you</h1>
  <p>Your message has been submitted.</p>

  <p><strong>First Name:</strong> <?= escape($firstName) ?></p>
  <p><strong>Last Name:</strong> <?= escape($lastName) ?></p>
  <p><strong>Email:</strong> <?= escape($email) ?></p>
  <p><strong>Message:</strong><br><?= nl2br(escape($message)) ?></p>

  <?php if ($mailSent): ?>
    <p>Email was sent successfully.</p>
  <?php else: ?>
    <p>Email could not be sent (this is normal on local servers).</p>
  <?php endif; ?>

  <a href="index.html">Submit another message</a>

</body>
</html>
