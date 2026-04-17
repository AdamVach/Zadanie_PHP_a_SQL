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

    if (!mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS databaza_knih")) {
        die("Database creation failed: " . mysqli_error($conn));
    }

    if (!mysqli_select_db($conn, "databaza_knih")) {
        die("Select database failed: " . mysqli_error($conn));
    }

    $sql = "CREATE TABLE IF NOT EXISTS pouzivatel (
        pouzivatel_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        meno VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        heslo VARCHAR(255) NOT NULL
    );";
    if (!mysqli_query($conn, $sql)) {
        die("Create table pouzivatel failed: " . mysqli_error($conn));
    }

    $sql = "CREATE TABLE IF NOT EXISTS knihy (
        kniha_ID INT(6) AUTO_INCREMENT PRIMARY KEY,
        nazov VARCHAR(50) NOT NULL,
        autor VARCHAR(50) NOT NULL,
        rok_vydania YEAR NOT NULL
    );";
    if (!mysqli_query($conn, $sql)) {
        die("Create table knihy failed: " . mysqli_error($conn));
    }

    $result = mysqli_query($conn, "SELECT COUNT(pouzivatel_ID) AS pouzivatel_count FROM pouzivatel;");
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    if ($row['pouzivatel_count'] == 0) {
        $defaultUserSql = "INSERT INTO pouzivatel (meno, email, heslo) VALUES 
            ('Ján', 'jan.novak@example.com', '" . password_hash('admin', PASSWORD_DEFAULT) . "'),
            ('Petra', 'petra.kovacova@example.com', '" . password_hash('petra', PASSWORD_DEFAULT) . "');";
        if (!mysqli_query($conn, $defaultUserSql)) {
            die("Error inserting default users: " . mysqli_error($conn));
        }
    }

    $bookResult = mysqli_query($conn, "SELECT COUNT(kniha_ID) AS book_count FROM knihy;");
    if (!$bookResult) {
        die("Query failed: " . mysqli_error($conn));
    }

    $bookRow = mysqli_fetch_assoc($bookResult);
    if ($bookRow['book_count'] == 0) {
        $defaultBooksSql = "INSERT INTO knihy (nazov, autor, rok_vydania) VALUES
            ('Na západe nič nové', 'Erich Maria Remarque', 1929),
            ('1984', 'George Orwell', 1949),
            ('Malý princ', 'Antoine de Saint-Exupéry', 1943);";
        if (!mysqli_query($conn, $defaultBooksSql)) {
            die("Error inserting default books: " . mysqli_error($conn));
        }
    }
    mysqli_close($conn);
    ?>
</body>
</html>