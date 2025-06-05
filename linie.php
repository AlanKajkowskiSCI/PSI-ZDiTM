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
                    <a href="linie.php">Linie</a>
                </div>

                <div class="leftPanelNav">
                <a href="przystanki.php">Przystanki</a>
                </div>

                <div class="leftPanelNav">
                <a href="zmiany.php">Zmiany</a>
                </div>

                <div class="leftPanelNav">
                <a href="trajektoriaLinii.php">Trasy</a>
                </div>
            
    </div>
    
    <div class="feed">

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
    $stmt = $pdo->prepare("SELECT COUNT(*) AS liczba_pojazdow FROM pojazdy GROUP BY line_number ORDER BY liczba_pojazdow");
    $stmt->execute();
    $linie = $stmt->fetchAll();

    foreach ($linie as $linia)
    {
        echo "<p>Linia {$linia['line_number']} - {$linia['liczba_pojazdow']} pojazdów </p> ";
    }

    }

    ?>
    </div>