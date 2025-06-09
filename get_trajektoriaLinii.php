


<?php

    function curlGetWithRateLimitHandling($url) {
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

    $response = curl_exec($ch);
    if ($response === false) {
        curl_close($ch);
        return [false, null];
    }

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $headersRaw = substr($response, 0, $headerSize);
    $body = substr($response, $headerSize);

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Parsujemy nagłówki
    $headers = [];
    foreach (explode("\r\n", $headersRaw) as $line) {
        if (strpos($line, ':') !== false) {
            list($key, $value) = explode(':', $line, 2);
            $headers[trim($key)] = trim($value);
        }
    }

    curl_close($ch);

    return [$body, $headers, $httpCode];
}

set_time_limit(300000);
#inicjowanie połączenia z bazą danych
$host = "localhost"; 
$db = "zbiorkominfo_db";
$user = "root";
$passwd = "";
$charset = "utf8mb4";
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
$pdo = new PDO($dsn, $user, $passwd);
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    ];


#pobieranie danych z API i ich dekodowanie
$dane = file_get_contents("https://www.zditm.szczecin.pl/api/v1/lines");
$daneZdekodowane = json_decode($dane, true);

$stmt = $pdo->prepare("
        INSERT INTO linie (
            id, number, type, subtype, vehicle_type,
            on_demand, highlighted, sort_order, updated_at
        ) VALUES (
            :id, :number, :type, :subtype, :vehicle_type,
            :on_demand, :highlighted, :sort_order, :updated_at
        )
        ON DUPLICATE KEY UPDATE
            number = VALUES(number),
            type = VALUES(type),
            subtype = VALUES(subtype),
            vehicle_type = VALUES(vehicle_type),
            on_demand = VALUES(on_demand),
            highlighted = VALUES(highlighted),
            sort_order = VALUES(sort_order),
            updated_at = VALUES(updated_at)
    ");

    foreach ($daneZdekodowane['data'] as $line) {
        $stmt->execute([
            ':id' => $line['id'],
            ':number' => $line['number'],
            ':type' => $line['type'],
            ':subtype' => $line['subtype'],
            ':vehicle_type' => $line['vehicle_type'],
            ':on_demand' => $line['on_demand'] ? 1 : 0,
            ':highlighted' => $line['highlighted'] ? 1 : 0,
            ':sort_order' => $line['sort_order'],
            ':updated_at' => $line['updated_at']
        ]);
    }

}
 catch (Exception $e) {
    echo "Błąd: " . $e->getMessage();
}