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
$dane = file_get_contents("https://www.zditm.szczecin.pl/api/v1/timetable-change-descriptions");
$daneZdekodowane = json_decode($dane);
$sql = "INSERT INTO zmiany
(
    id, valid_from, valid_to, description_pl, description_en, description_de, description_uk, updated_at
)
VALUES
(
    :id, :valid_from, :valid_to, :description_pl, :description_en, :description_de, :description_uk, :updated_at
)
ON DUPLICATE KEY UPDATE
    id = VALUES(id),
    valid_from = VALUES(valid_from),
    valid_to = VALUES(valid_to),
    description_pl = VALUES(description_pl),
    description_en = VALUES(description_en), 
    description_de = VALUES(description_de), 
    description_uk = VALUES(description_uk), 
    updated_at = VALUES(updated_at)";

$stm = $pdo->prepare($sql);

#wczytywanie danych do tablicy zmiany
foreach ($daneZdekodowane->data as $item) {
    $id = $item->id ?? 0;
    $valid_from = $item->valid_from ?? '';
    $valid_to = $item->valid_to ?? '';
    $description = $item->description ?? '';
    $updated_at = $item->updated_at ?? '';

    $stm->execute([
        ':id' =>$id, 
        ':valid_from' => $valid_from, 
        ':valid_to' => $valid_to, 
        ':description_pl' => $description->pl, 
        ':description_en' => $description->en, 
        ':description_de' => $description->de, 
        ':description_uk' => $description->uk, 
        ':updated_at' => $updated_at,
    ]);
}