<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<?php
$conn = mysqli_connect("localhost", "root", "root", "databaza_knih");
if (!$conn) {
    echo "chyba pripojenia" . mysqli_connect_error();
    die();
}
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
        <h3 class="text-center mb-3">Zmena hesla</h3>


        <form method="post">
            <div class="mb-3">
                <label for="password_now" class="form-label">Aktuálne heslo</label>
                <input type="text" class="form-control" id="password_now" name="password_now" placeholder="Zadajte aktuálne heslo">
            </div>

            <div class="mb-3">
                <label for="password_new1" class="form-label">Nové heslo</label>
                <input type="password" class="form-control" id="password_new1" name="password_new1" placeholder="Zadaj nové heslo">
            </div>

            <div class="mb-3">
                <label for="password_new2" class="form-label">Potvrdenie hesla</label>
                <input type="password" class="form-control" id="password_new2" name="password_new2" placeholder="Zadaj nové heslo">
            </div>

            <div class="mb-3">
                <button type="submit" name="login" class="btn btn-primary w-100">Zmeniť heslo</button>
            </div>
            
        </form>
        <?php
        $heslo_stare = password_hash($_POST["password_now"], PASSWORD_DEFAULT);
        $heslo_nove1 = password_hash($_POST["password_new1"], PASSWORD_DEFAULT);
        $heslo_nove2 = password_hash($_POST["password_new2"], PASSWORD_DEFAULT);
        $pouzivatel = $_SESSION["meno"];
        if ($heslo_nove1 == $heslo_nove2) {
            $sql = "SELECT heslo FROM pouzivatel UPDATE pouzivatel SET heslo = '$heslo_nove2' WHERE meno = '$pouzivatel';";
        } else {
            echo '<div class="alert alert-danger" role="alert">Nové heslá se nezhodujú</div>';
        }
        
        if(isset($_POST["login"])) {
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($_POST["username"] == $row["meno"] && password_verify($_POST["password"], $row["heslo"])) {
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
        
    </div>
</div>


</body>
</html>