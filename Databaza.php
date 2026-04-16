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
   
    $sql = "CREATE DATABASE IF NOT EXISTS databaza_knih;
    USE databaza_knih;
    CREATE TABLE IF NOT EXISTS pouzivatel (
        pouzivatel_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        meno VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        heslo VARCHAR(255) NOT NULL
    );
    

    CREATE TABLE IF NOT EXISTS knihy (
        kniha_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        nazov VARCHAR(50) NOT NULL,
        autor VARCHAR(50) NOT NULL,
        rok_vydania YEAR NOT NULL
    );";
    
    if (mysqli_multi_query($conn, $sql)) {
        $sql = "USE databaza_knih; SELECT COUNT(pouzivatel_ID) AS pouzivatel_count FROM databazy_knih;";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row['pouzivatel_count'] == 0) {
                $defaultUserSql = "USE databaza_knih;
                INSERT INTO pouzivatel (pouzivatel_ID, meno, email, heslo) VALUES 
                (NULL, 'Ján', 'jan.novak@example.com','" . password_hash('admin', PASSWORD_DEFAULT) . "'),
                (NULL, 'Petra', 'petra.kovacova@example.com','" . password_hash('petra', PASSWORD_DEFAULT) . "');

                INSERT INTO knihy (kniha_ID, nazov, autor, rok_vydania) VALUES
                (NULL, 'Na západe nič nové', 'Erich Maria Remarque', 1929),
                (NULL, '1984', 'George Orwell', 1949),
                (NULL, 'Malý princ', 'Antoine de Saint-Exupéry', 1943),
                (NULL, 'Pýcha a predsudok', 'Jane Austen', 1813),
                (NULL, 'Zločin a trest', 'Fjodor Michajlovič Dostojevskij', 1866);";
                if (!mysqli_multi_query($conn, $defaultUserSql)) {
                    die("Error inserting default users: " . mysqli_error($conn));
                }
            }
        }
    }
    
    ?>
</body>
</html>