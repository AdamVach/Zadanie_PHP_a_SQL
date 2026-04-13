    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $conn = mysqli_connect("localhost", "root", "root");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "CREATE DATABASE IF NOT EXISTS pozivatelia;
    USE pouzivatelia;
    CREATE TABLE IF NOT EXISTS user (
        pouzivatel_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        meno VARCHAR(30) NOT NULL,
        priezvisko VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        heslo VARCHAR(255) NOT NULL
    );
    INSERT INTO pouzivatel (id, meno, priezvisko, email) VALUES
    (NULL, 'Ján', 'Novák', 'jan.novak@example.com'),
    (NULL, 'Petra', 'Kováčová', 'petra.kovacova@example.com'),
    (NULL, 'Martin', 'Horváth', 'martin.horvath@example.com'),
    (NULL, 'Lucia', 'Vargová', 'lucia.vargova@example.com');

    CREATE TABLE IF NOT EXISTS knihy (
        kniha_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        nazov VARCHAR(50) NOT NULL,
        autor VARCHAR(50) NOT NULL,
        rok_vydania YEAR NOT NULL
    );
    INSERT INTO knihy (kniha_id, nazov, autor, rok_vydania) VALUES
    (NULL, 'Na západe nič nové', 'Erich Maria Remarque', 1929),
    (NULL, '1984', 'George Orwell', 1949),
    (NULL, 'Malý princ', 'Antoine de Saint-Exupéry', 1943),
    (NULL, 'Pýcha a predsudok', 'Jane Austen', 1813),
    (NULL, 'Zločin a trest', 'Fjodor Michajlovič Dostojevskij', 1866);";
    mysqli_multi_query($conn, $sql);
    mysqli_close($conn);
    ?>
</body>
</html>