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

    </div>

    <div class="feed">
        <h1>Ogłoszenia</h1>
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
    $stmt = $pdo->prepare("SELECT * FROM zmiany");
    $stmt->execute();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        echo '<div style="border: 1px solid #ccc; padding: 16px; margin-bottom: 20px; border-radius: 8px;">';
        echo "Ważne od: " . $row['valid_from'] . "<br>";
        echo "PL: " . $row['description_pl'] . "<br>";
        echo "EN: " . $row['description_en'] . "<br>";
        echo "DE: " . $row['description_de'] . "<br>";
        echo "UA: " . $row['description_uk'] . "<br>";
        echo '</div>';
    }
    

    }
    catch (PDOException $e) 
    {
    echo "Błąd połączenia lub zapytania: " . $e->getMessage();
    }

    ?>
    </div>
    <div class="footer">
        <p>2025 - Alan Kajkowski</p>
    </div>
    </body>
    </html>