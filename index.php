<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
session_start();
include "Databaza.php";
$conn = mysqli_connect("localhost", "root", "root", "databaza_knih");
if (!$conn) {
    echo "chyba pripojenia" . mysqli_connect_error();
    die();
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Prihlásenie používateľa</h3>

        <?php
        $sql = "SELECT * FROM pouzivatel";
        

        if(isset($_POST["login"])) {
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($_POST["username"] == $row["meno"] && password_verify($_POST["password"], $row["heslo"])) {
                        $_SESSION["meno"] = $row["meno"];
                        setcookie("logged", "1", time()+3600);
                        $_COOKIE["logged"] = "1";
                        header("Location: Zadanie_PHP_a_SQL.php");
                        exit();
                        break;
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Neplatné meno alebo heslo, alebo nie ste registrovaný</div>';
                    }
                }
            }
        }
        ?> 

        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Používateľské meno</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Zadaj meno">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Heslo</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Zadaj heslo">
            </div>
            <?php
            echo '<button type="submit" name="login" class="btn btn-primary w-100">Prihlásiť sa</button>';
            ?>
            <a href="register.php">registrovať sa</a>
            <a href="reset_password.php">Zabudnuté heslo</a>
        </form>

        
    </div>
</div>


</body>
</html>