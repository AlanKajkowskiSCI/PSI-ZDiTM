<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
    <link src="scripts.js">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
     <style>#map { height: 80vh; }</style>
    <title>ZbiorkomInfo</title>
    <meta http-equiv="refresh" content="60">
</head>

<body>
    <div class="panel">
            <img src="res/zditm-logo-bw-pl.svg" alt="Logo ZDiTM"> 
            
    </div>

    <div class="leftPanel">
                <div class="leftPanelNav">
                    <a href="linie.php">Linie</a>
                </div>

                <div class="leftPanelNav">
                <a href="galeria.php">Galeria</a>
                </div>

                <div class="leftPanelNav">
                <a href="zmiany.php">Zmiany</a>
                </div>

                <div class="leftPanelNav">
                <a href="index.php">Strona główna</a>
                </div>
            
    </div>

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
    $stmt = $pdo->query("SELECT latitude, longitude, vehicle_type, vehicle_model, direction, next_stop, vehicle_operator, line_number  FROM pojazdy");
    $points = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $pointsJson = json_encode($points);

    }
    catch (PDOException $e) 
    {
    echo "Błąd połączenia lub zapytania: " . $e->getMessage();
    }
    ?>

    <div id="map" style="margin-top: 5vh; margin-right: 2vw; margin-left: 2vw;"></div>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
    const map = L.map('map').setView([53.428543, 14.552812], 14);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    const busIcon = L.icon({
    iconUrl: 'res/pic/bus.png',
    iconSize: [32, 32],
    iconAnchor: [16, 32],
    });

    const tramIcon = L.icon({
    iconUrl: 'res/pic/tram.svg',
    iconSize: [32, 32],
    iconAnchor: [16, 32],
    });


    const points = <?php echo $pointsJson; ?>;
    points.forEach(point => {
    if(point.latitude && point.longitude){
        let iconToUse = (point.vehicle_type === "bus") ? busIcon : tramIcon;
        let popupContent = `
            <strong>Linia:</strong> ${point.line_number}<br>
            <strong>Model:</strong> ${point.vehicle_model}<br>
            <strong>Kierunek:</strong> ${point.direction}<br>
            <strong>Następny przystanek:</strong> ${point.next_stop}<br>
            <strong>Operator:</strong> ${point.vehicle_operator}
            `;
        L.marker([point.latitude, point.longitude], {icon: iconToUse} ).addTo(map) .bindPopup(popupContent);
        }
    });


    </script>

    <div class="footer">
        <p>2025 - Alan Kajkowski</p>
    </div>
    
    </body>
    </html>