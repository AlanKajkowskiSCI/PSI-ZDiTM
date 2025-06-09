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
                <a href="trajektoriaLinii.php">Trasy</a>
                </div>

                <div class="leftPanelNav">
                <a href="kontrolaPredkosci.php">Kontrola prędkości</a>
                </div>
            
    </div>

    <div class="feed_control">
        <div style="margin-bottom: 2vh; text-align: center; margin-top: 2vh; border-radius: 8px; background-color:rgba(73, 77, 80, 0.75); color:rgb(236, 236, 236)">
        <h1>Pomiary prędkości</h1>
        </div>
<?php
$areas = [
    'Brama Portowa' => [
        'coords' => [
    [14.551055552429883, 53.4257019361747],
    [14.550941638655448, 53.425698601527486],
    [14.550828821986109, 53.42568862970185],
    [14.550718188959216, 53.42567211673654],
    [14.550610805078415, 53.42564922166799],
    [14.550507704550492, 53.42562016499827],
    [14.550409880323793, 53.42558522657136],
    [14.55031827452429, 53.4255447428774],
    [14.55023376938142, 53.42549910381175],
    [14.550157178731137, 53.42544874891941],
    [14.550089240178034, 53.425394163161364],
    [14.550030607991998, 53.42533587224352],
    [14.549981846807846, 53.425274437553355],
    [14.54994342618853, 53.425210450752786],
    [14.549915716104305, 53.42514452807982],
    [14.549898983371307, 53.425077304413314],
    [14.549893389083756, 53.42500942715857],
    [14.549898987064525, 53.424941550012186],
    [14.549915723348814, 53.42487432666664],
    [14.549943436705927, 53.424808404514884],
    [14.549981860193952, 53.42474441841576],
    [14.550030623732395, 53.42468298458028],
    [14.550089257667823, 53.42462469463755],
    [14.550157197298198, 53.42457010993757],
    [14.550233788312234, 53.42451975614557],
    [14.550318293091353, 53.424474118180285],
    [14.550409897813585, 53.42443363554438],
    [14.550507720290886, 53.424398698092574],
    [14.550610818464522, 53.42436964227756],
    [14.55071819947661, 53.42434674791043],
    [14.550828829230618, 53.42433023546634],
    [14.550941642348665, 53.42432026396167],
    [14.551055552429883, 53.424316929422815],
    [14.551169462511105, 53.42432026396167],
    [14.55128227562915, 53.42433023546634],
    [14.551392905383159, 53.42434674791043],
    [14.551500286395248, 53.42436964227756],
    [14.551603384568883, 53.424398698092574],
    [14.551701207046184, 53.42443363554438],
    [14.551792811768413, 53.424474118180285],
    [14.551877316547534, 53.42451975614557],
    [14.551953907561568, 53.42457010993757],
    [14.552021847191947, 53.42462469463755],
    [14.552080481127375, 53.42468298458028],
    [14.552129244665817, 53.42474441841576],
    [14.552167668153842, 53.424808404514884],
    [14.552195381510955, 53.42487432666664],
    [14.552212117795243, 53.424941550012186],
    [14.552217715776012, 53.42500942715857],
    [14.552212121488461, 53.425077304413314],
    [14.552195388755463, 53.42514452807982],
    [14.552167678671239, 53.425210450752786],
    [14.552129258051924, 53.425274437553355],
    [14.552080496867768, 53.42533587224352],
    [14.552021864681736, 53.425394163161364],
    [14.551953926128633, 53.42544874891941],
    [14.55187733547835, 53.42549910381175],
    [14.551792830335478, 53.4255447428774],
    [14.551701224535975, 53.42558522657136],
    [14.551603400309276, 53.42562016499827],
    [14.551500299781354, 53.42564922166799],
    [14.551392915900554, 53.42567211673654],
    [14.551282282873657, 53.42568862970185],
    [14.551169466204321, 53.425698601527486],
    [14.551055552429883, 53.4257019361747],
    ],
    'max_velocity' => 50
    ],
    'Gdańska' => [
            'coords' => [
            [14.571149242056435, 53.4159893543883],
            [14.571149242056435, 53.39346139728309],
            [14.607878290336345, 53.39346139728309],
            [14.607878290336345, 53.4159893543883],
            [14.571149242056435, 53.4159893543883],
            ],
            'max_velocity' => 70
        ],

    'Podjuchy-Słoneczne' => [
        'coords' => [
          
            [14.631333616125346, 53.38415993702486],
            [14.591641554502388, 53.38415993702486],
            [14.591641554502388, 53.363645306027934],
            [14.631333616125346, 53.363645306027934],
            [14.631333616125346, 53.38415993702486],
        ],
          'max_velocity' => 50
    ],

    'Aleja Wojska Polskiego (do jednostki)' => [
        'coords' => [
            [
              14.486316448081226,
              53.47023663888501
            ],
            [
              14.486316448081226,
              53.45895271968419
            ],
            [
              14.501482507512549,
              53.45895271968419
            ],
            [
              14.501482507512549,
              53.47023663888501
            ],
            [
              14.486316448081226,
              53.47023663888501
            ]
            ],
            'max_velocity' => 50
        ],
    'Nad Odrą' => [
        'coords' => [
            [
              14.616395991682879,
              53.48730785794038
            ],
            [
              14.596580156177964,
              53.48730785794038
            ],
            [
              14.596580156177964,
              53.466184924261455
            ],
            [
              14.616395991682879,
              53.466184924261455
            ],
            [
              14.616395991682879,
              53.48730785794038
            ]
            ],
            'max_velocity' => 40
        ]
    ];





// Funkcja do zamiany koordynatów (lng, lat) na (lat, lng) jeśli potrzebne
function swapCoords($coords) {
    return array_map(fn($pair) => [$pair[1], $pair[0]], $coords);
}

// Załaduj wszystkie wielokąty z poprawioną kolejnością
foreach ($areas as $key => $area) {
    $areas[$key]['coords'] = array_map(fn($pair) => [$pair[1], $pair[0]], $area['coords']);
}


// pointInPolygon (bez zmian z twojego kodu)
function pointInPolygon($point, $polygon) {
    $x = $point[1]; // lng
    $y = $point[0]; // lat
    $inside = false;
    $n = count($polygon);

    for ($i = 0, $j = $n - 1; $i < $n; $j = $i++) {
        $xi = $polygon[$i][1]; $yi = $polygon[$i][0];
        $xj = $polygon[$j][1]; $yj = $polygon[$j][0];

        $intersect = (($yi > $y) != ($yj > $y)) &&
                     ($x < ($xj - $xi) * ($y - $yi) / (($yj - $yi) ?: 1e-10) + $xi);
        if ($intersect) $inside = !$inside;
    }
    return $inside;
}

// Połączenie z bazą
$pdo = new PDO("mysql:host=localhost;dbname=zbiorkominfo_db;charset=utf8mb4", "root", "");

// Pobierz pojazdy
$sql = "SELECT vehicle_id, line_number, vehicle_number, velocity, latitude, longitude FROM pojazdy";
$stmt = $pdo->query($sql);
$pojazdy = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tablica wynikowa: dla każdego obszaru pojazdy w środku
$results = [];

foreach ($areas as $areaName => $area) {
    $polygonCoords = $area['coords'];
    $maxVelocity = $area['max_velocity'];

    $results[$areaName] = [
        'max_velocity' => $area['max_velocity'],
        'vehicles' => []
    ];
    foreach ($pojazdy as $pojazd) {
        $punkt = [$pojazd['latitude'], $pojazd['longitude']];
        if (pointInPolygon($punkt, $polygonCoords)) {
            $results[$areaName]['vehicles'][] = $pojazd;
        }
    }
}

// Wyświetl wyniki dla każdego obszaru
foreach ($results as $areaName => $areaData) {
    $maxVelocity = $areas[$areaName]['max_velocity'];
    $pojazdyWSrodku = $areaData['vehicles'];
    echo '<div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 20px; border-radius: 8px; background-color:rgba(73, 77, 80, 0.75); color:rgb(236, 236, 236)">';
    echo "<h3>Pojazdy na obszarze: <strong>$areaName</strong></h3>";
    if (count($pojazdyWSrodku) === 0) {
        echo "Brak pojazdów.<br>";
    } else {
        foreach ($pojazdyWSrodku as $pojazd) {
            echo "Pojazd linii <strong>{$pojazd['line_number']}</strong> o numerze : {$pojazd['vehicle_number']} — prędkość: <strong>{$pojazd['velocity']} km/h</strong><br>";
            if ($pojazd['velocity'] > $maxVelocity && $pojazd['velocity'] != 0) {
                echo "<p style='color:red;'>Przekroczono prędkość</p>";
            }
        }
    }
    echo "</div>";
}
?>
    </div>
    <div class="footer">
        <p>2025 - Alan Kajkowski</p>
    </div>
    </body>
    </html>