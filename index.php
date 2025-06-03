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
$conn = new mysqli(hostname:"localhost", database: "zbiorkom_db", username: "root", password: "");
if ($conn->connect_error)
{
    die("Błąd połączenia: " . $conn->connect_error);
}

$dane = file_get_contents("https://www.zditm.szczecin.pl/api/v1/lines");
$daneZdekodowane = json_decode($dane, true);

$sql = "INSERT INTO pojazdy 
(
    line_id, line_number, line_type, vehicle_type, vehicle_id,vehicle_number, vehicle_model, vehicle_low_floor, vehicle_ticket_machine_cards, vehicle_ticket_machine_coins, vehicle_operator,     
    route_variant_number, service, direction, previous_stop, next_stop, latitude, longtitude, bearing, velocity, punctuality, update_at
)
VALUES 
(
    :line_id, :line_number, :line_type, :vehicle_type, :vehicle_id, :vehicle_number, :vehicle_model, :vehicle_low_floor, :vehicle_ticket_machine_cards, :vehicle_ticket_machine_coins, :vehicle_operator,     
    :route_variant_number, :service, :direction, :previous_stop, :next_stop, :latitude, :longtitude, :bearing, :velocity, :punctuality, :update_at
)";

$stm = $conn->prepare($sql);

foreach ($data['data'] as $item) {
    $stmt->execute([
        ':line_id' => $item['line_id'],
        ':line_number' => $item['line_number'],
        ':line_type' => $item['line_type'],
        ':line_subtype' => $item['line_subtype'],
        ':vehicle_type' => $item['vehicle_type'],
        ':vehicle_id' => $item['vehicle_id'],
        ':vehicle_number' => $item['vehicle_number'],
        ':vehicle_model' => $item['vehicle_model'],
        ':vehicle_low_floor' => $item['vehicle_low_floor'],
        ':ticket_cards' => $item['vehicle_ticket_machine']['cards'],
        ':ticket_coins' => $item['vehicle_ticket_machine']['coins'],
        ':vehicle_operator' => $item['vehicle_operator'],
        ':route_variant_number' => $item['route_variant_number'],
        ':service' => $item['service'],
        ':direction' => $item['direction'],
        ':previous_stop' => $item['previous_stop'],
        ':next_stop' => $item['next_stop'],
        ':latitude' => $item['latitude'],
        ':longitude' => $item['longitude'],
        ':bearing' => $item['bearing'],
        ':velocity' => $item['velocity'],
        ':punctuality' => $item['punctuality'],
        ':updated_at' => $item['updated_at'],
    ]);
}
?>

</body>
</html>