<?php
#inicjowanie połączenia z bazą danych
$host = "localhost"; 
$db = "zbiorkominfo_db";
$user = "root";
$passwd = "";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$pdo = new PDO($dsn, $user, $passwd);
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];


#pobieranie danych z API i ich dekodowanie
$dane = file_get_contents("https://www.zditm.szczecin.pl/api/v1/vehicles");
$daneZdekodowane = json_decode($dane, true);

/*echo '<pre>';
print_r($daneZdekodowane);
echo '</pre>';
*/
#przygotywanie  do wczytania danych do tablicy pojazdy
$sql = "INSERT INTO pojazdy 
(
    line_id, line_number, line_type, line_subtype, vehicle_type, vehicle_id,vehicle_number, vehicle_model, vehicle_low_floor, vehicle_operator,     
    route_variant_number, service, direction, previous_stop, next_stop, latitude, longitude, bearing, velocity, punctuality, updated_at
)
VALUES 
(
    :line_id, :line_number, :line_type, :line_subtype, :vehicle_type, :vehicle_id, :vehicle_number, :vehicle_model, :vehicle_low_floor, :vehicle_operator,     
    :route_variant_number, :service, :direction, :previous_stop, :next_stop, :latitude, :longitude, :bearing, :velocity, :punctuality, :updated_at
)
ON DUPLICATE KEY UPDATE
    line_id = VALUES(line_id),
    line_number = VALUES(line_number),
    line_type = VALUES(line_type),
    line_subtype = VALUES(line_subtype),
    vehicle_type = VALUES(vehicle_type),
    vehicle_number = VALUES(vehicle_number),
    vehicle_model = VALUES(vehicle_model),
    vehicle_low_floor = VALUES(vehicle_low_floor),
    vehicle_operator = VALUES(vehicle_operator),
    route_variant_number = VALUES(route_variant_number),
    service = VALUES(service),
    direction = VALUES(direction),
    previous_stop = VALUES(previous_stop),
    next_stop = VALUES(next_stop),
    latitude_old = latitude,
    longitude_old = longitude,
    latitude = VALUES(latitude),
    longitude = VALUES(longitude),
    bearing = VALUES(bearing),
    velocity = VALUES(velocity),
    punctuality = VALUES(punctuality),
    updated_old = updated_at,
    updated_at = VALUES(updated_at)";

$stm = $pdo->prepare($sql);

#wczytywanie danych do tablicy pojazdy
foreach ($daneZdekodowane['data'] as $item) {
    $bearing = isset($item['bearing']) && $item['bearing'] !== null ? $item['bearing'] : 0;
    $next_stop = isset($item['next_stop']) ? (is_array($item['next_stop']) ? implode(", ", $item['next_stop']) : $item['next_stop']) : '';
    $vehicle_model = isset($item['vehicle_model']) && !empty($item['vehicle_model']) ? $item['vehicle_model'] : 'nieznany model';
    $previous_stop = isset($item['previous_stop']) ? (is_array($item['previous_stop']) ? implode(", ", $item['previous_stop']) : $item['previous_stop']) : '';
    $line_id = $item['line_id'] ?? 0;
    $line_number = $item['line_number'] ?? '';
    $line_type = $item['line_type'] ?? '';
    $line_subtype = $item['line_subtype'] ?? '';
    $vehicle_type = $item['vehicle_type'] ?? '';
    $vehicle_id = $item['vehicle_id'] ?? 0;
    $vehicle_number = $item['vehicle_number'] ?? '';
    $vehicle_low_floor = isset($item['vehicle_low_floor']) ? (int)$item['vehicle_low_floor'] : 0;
    $vehicle_operator = $item['vehicle_operator'] ?? '';
    $route_variant_number = $item['route_variant_number'] ?? 0;
    $service = $item['service'] ?? '';
    $direction = $item['direction'] ?? '';
    $latitude = $item['latitude'] ?? 0.0;
    $longitude = $item['longitude'] ?? 0.0;
    $velocity = $item['velocity'] ?? 0;
    $punctuality = $item['punctuality'] ?? 0;
    $updated_at = $item['updated_at'] ?? '';

    $stm->execute([
        ':line_id' => $line_id,
        ':line_number' => $line_number,
        ':line_type' => $line_type,
        ':line_subtype' => $line_subtype,
        ':vehicle_type' => $vehicle_type,
        ':vehicle_id' => $vehicle_id,
        ':vehicle_number' => $vehicle_number,
        ':vehicle_model' => $vehicle_model,
        ':vehicle_low_floor' => $vehicle_low_floor,
        ':vehicle_operator' => $vehicle_operator,
        ':route_variant_number' => $route_variant_number,
        ':service' => $service,
        ':direction' => $direction,
        ':previous_stop' => $previous_stop,
        ':next_stop' => $next_stop,


        ':latitude' => $latitude,
        ':longitude' => $longitude,
        ':bearing' => $bearing,
        ':velocity' => $velocity,
        ':punctuality' => $punctuality,
        ':updated_at' => $updated_at,
    ]);
}
?>