<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link src="scripts.js">
    <title>ZbiorkomInfo</title>
</head>

<body>
<?php
$conn = new mysqli(hostname:"localhost", username: "root", password: "");
if ($conn->connect_error)
{
    die("Błąd połączenia: " . $conn->connect_error);
}

?>

</body>
</html>