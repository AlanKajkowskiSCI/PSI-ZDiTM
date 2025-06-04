<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
    <link src="scripts.js">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <title>ZbiorkomInfo</title>
    <meta http-equiv="refresh" content="60">
</head>

<body>
    <div class="panel">
            <img src="res/zditm-logo-bw-pl.svg" alt="Logo ZDiTM"> 
            
    </div>

    <div class="leftPanel">
    <p>Tu kiedyś będzie nawigacja</p>
    </div>
    
    <div class="feed">
        <h1>Szybkie Fakty</h1>
    <?php
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
    try {

    $pdo = new PDO($dsn, $user, $passwd, $options);
    $stmt = $pdo->prepare("SELECT COUNT(*) AS liczba_autobusow FROM pojazdy WHERE vehicle_type = :type");
    $stmt->execute(['type' => 'bus']);
    $row = $stmt->fetch();
    echo "<p>Liczba autobusów = " . $row['liczba_autobusow'] . "</p>";

    $stmt = $pdo->prepare("SELECT COUNT(*) AS liczba_tramwajow FROM pojazdy WHERE vehicle_type = :type");
    $stmt->execute(['type' => 'tram']);
    $row = $stmt->fetch();
    echo "<p>Liczba tramwajów = " . $row['liczba_tramwajow'] . "</p>";

    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, punctuality FROM pojazdy WHERE vehicle_type = 'bus' ORDER BY punctuality ASC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Autobus z największym opóźnieniem: " . $result['line_number'] . " w kierunku " . $result['direction'] . " opóźniony o " . $result['punctuality'] . " minut. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];

    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, punctuality FROM pojazdy WHERE vehicle_type = 'bus' ORDER BY punctuality DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Autobus z największym przyspieszeniem: " . $result['line_number'] . " w kierunku " . $result['direction'] . " przyspieszony o " . $result['punctuality'] . " minut. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];
    
    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, punctuality FROM pojazdy WHERE vehicle_type = 'tram' ORDER BY punctuality ASC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Tramwaj z największym opóźnieniem: " . $result['line_number'] . " w kierunku " . $result['direction'] . " opóźniony o " . $result['punctuality'] . " minut. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];


    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, punctuality FROM pojazdy WHERE vehicle_type = 'tram' ORDER BY punctuality DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Tramwaj z największym przyspieszeniem: " . $result['line_number'] . " w kierunku " . $result['direction'] . " przyspieszony o " . $result['punctuality'] . " minut. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];
    

    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, velocity FROM pojazdy WHERE vehicle_type = 'bus' ORDER BY velocity DESC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Najszybszy autobus: " . $result['line_number'] . " w kierunku " . $result['direction'] . " jadący " . $result['velocity'] . "  km/h. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];
    

    $stmt = $pdo->prepare("SELECT line_number, vehicle_model, vehicle_operator, direction, velocity FROM pojazdy WHERE vehicle_type = 'bus' ORDER BY velocity ASC LIMIT 1");
    $stmt->execute();
    $result = $stmt->fetch();
    echo "<p>Najwolniejszy autobus: " . $result['line_number'] . " w kierunku " . $result['direction'] . " jadący " . $result['velocity'] . "  km/h. Operatorem autobusu jest " . $result['vehicle_operator'] . ", model: " . $result['vehicle_model'];


    }
    catch (PDOException $e) 
    {
    echo "Błąd połączenia lub zapytania: " . $e->getMessage();
    }

    ?>
    </div>


    <div class="footer">
        <p>Ten stópkarz jest do dokończenia</p>
    </div>
    

</body>
</html>