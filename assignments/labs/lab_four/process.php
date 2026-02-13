<?php
require "connect.php";   // make sure this path matches where your connect.php is

// Grab form data
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$email = $_POST['email'];

// INSERT query
$sql = "INSERT INTO subscribers (first_name, last_name, email)
        VALUES (:first_name, :last_name, :email)";

$statement = $db->prepare($sql);

$statement->execute([
    ':first_name' => $first,
    ':last_name'  => $last,
    ':email'      => $email
]);
?>

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <main class="container mt-4">
        <h2>Thank You for Subscribing</h2>

        <!-- TODO: Display a confirmation message -->
        <!-- Example: "Thanks, Name! You have been added to our mailing list." -->


        <p class="mt-3">
            <a href="subscribers.php">View Subscribers</a>
        </p>
    </main>
</body>

</html>