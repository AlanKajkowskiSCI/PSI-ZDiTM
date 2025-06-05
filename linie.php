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
                <a href="przystanki.php">Przystanki</a>
                </div>

                <div class="leftPanelNav">
                <a href="zmiany.php">Zmiany</a>
                </div>

                <div class="leftPanelNav">
                <a href="trajektoriaLinii.php">Trasy</a>
                </div>
            
    </div>
    
    <div class="feed_linie">

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
    $stmt = $pdo->prepare("SELECT DISTINCT line_number FROM pojazdy GROUP BY line_number");
    $stmt->execute();
    $linie = $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    catch (PDOException $e) 
    {
    echo "Błąd połączenia lub zapytania: " . $e->getMessage();
    }
    ?>

    <form method="get" action="">
        <label for="linia">Wybierz linię która Cię interesuje: </label>
        <select name="linia" id="linia">
            <?php
                foreach ($linie as $linia): ?>
                <option value="<?= htmlspecialchars($linia) ?>"><?= htmlspecialchars($linia) ?></option>
                <?php endforeach; ?>

        </select>
                <input type="submit" value="Pokaż">
    </form>

    <?php
    if (isset($_GET['linia']) && !empty($_GET['linia'])) {
    $linia = $_GET['linia'];

    $stmt = $pdo->prepare("SELECT vehicle_number, vehicle_model, vehicle_low_floor, vehicle_ticket_machine_cards, vehicle_ticket_machine_coins, vehicle_operator, direction, next_stop, velocity, punctuality FROM pojazdy 
                           WHERE line_number = :linia");
    $stmt->execute(['linia' => $linia]);
    $pojazdy = $stmt->fetchAll();

    if(isset($pojazdy['vehicle_low_floor']) && $pojazdy['vehicle_low_floor'] == 1)
    {
        $nisko_podlogowy = "Tak";
    }
    else
    {
        $nisko_podlogowy = "Nie";
    }

    if (count($pojazdy) > 0) {
        $ilosc_pojazdow = 0;
        echo "<h3>Pojazdy na linii: " . htmlspecialchars($linia) . "</h3>";
        echo "<ul>";
        foreach ($pojazdy as $pojazd) 
        {
            $model = $pojazd['vehicle_model'];
            $plik_obrazka = 'res/pic/' . str_replace(['/', ' ','<', '>', '-'], '_', $model) . '.jpg';
            
            #echo "<p>Szukana ścieżka: $plik_obrazka</p>";
            

            $ilosc_pojazdow++;
            echo "<li style='list-style: none; margin-bottom: 20px;'>";
            echo "<div style='display: flex; align-items: center; gap: 20px;'>";

            if (file_exists($plik_obrazka)) {
            echo "<img src='$plik_obrazka' alt='Zdjęcie autobusu $model' style='width: 15vw; height: auto; border-radius: 10px;'>";
            } else {
            echo "<div style='width: 150px; text-align: center; color: gray;'>Brak zdjęcia</div>";
            }


            echo "<div>";
            echo "Numer pojazdu: {$pojazd['vehicle_number']}<br>";
            echo "Kierunek: {$pojazd['direction']}<br>";
            echo "Następny przystanek: {$pojazd['next_stop']}<br>";
            echo "Prędkość: {$pojazd['velocity']}<br>";
            echo "Model: {$pojazd['vehicle_model']}<br>";
            echo "Niskopodłogowy: {$nisko_podlogowy}<br>";
            echo "Operator: {$pojazd['vehicle_operator']}<br>";
            echo "Punktualność: {$pojazd['punctuality']}<br>";
            echo "</div>";
        }
echo "</div>";
echo "</li>";
        }
        echo "</ul>";
        echo "<p>Ilość pojazdów na linii: {$ilosc_pojazdow}";
    } else {
        echo "<p>Brak autobusów na tej linii.</p>";
        
    }
    
?>

    </div>