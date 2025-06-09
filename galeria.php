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
                <a href="index.php">Strona główna</a>
                </div>

                <div class="leftPanelNav">
                <a href="galeria.php">Galeria</a>
                </div>

                <div class="leftPanelNav">
                <a href="linie.php">Linie</a>
                </div>

                <div class="leftPanelNav">
                <a href="kontrolaPredkosci.php">Pomiary</a>
                </div>

                <div class="leftPanelNav">
                <a href="trajektoriaLinii.php">Mapa</a>
                </div>

                <div class="leftPanelNav">
                <a href="zmiany.php">Zmiany</a>
                </div>

            
    </div>
    
    <div class="feed_linie">
        <ul class="gallery" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; padding: 0; margin-top: 5vh;">

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
    $stmt = $pdo->query("SELECT DISTINCT vehicle_model FROM pojazdy ORDER BY vehicle_model");
    $stmt->execute();
    $modele = $stmt->fetchAll();
    
    foreach ($modele as $model) 
    {
    $plik_obrazka = 'res/pic/' . str_replace(['/', ' ','<', '>', '-'], '_', $model['vehicle_model']) . '.jpg';
    $typ = $model['vehicle_model'];

    echo "<li style='list-style: none; margin-bottom: 20px;'>";
            echo "<div style='display: flex; flex-direction: column; align-items: center; gap: 20px;'>";

            if (file_exists($plik_obrazka)) {
            echo "<img src='$plik_obrazka' alt='Zdjęcie autobusu $typ' style='width: 15vw; height: auto; border-radius: 10px;'>";
            } else {
            echo "<div style='width: 150px; text-align: center; color: gray;'>Brak zdjęcia</div>";
            }

            echo '<div style="padding: 16px; margin-bottom: 20px; border-radius: 8px; background-color:rgba(73, 77, 80, 0.75); color:rgb(236, 236, 236)">';
            echo $typ;
            echo "</div>";
    }

}
    catch (PDOException $e) 
    {
    echo "Błąd połączenia lub zapytania: " . $e->getMessage();
    }
    ?>
    </ul>
    </div>
    <div class="footer">
        <p>2025 - Alan Kajkowski</p>
    </div>
    </body>
    </html>