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
    $conn = mysqli_connect("localhost", "root", "root", "databaza_knih");
    if (!$conn) {
        echo "chyba pripojenia" . mysqli_connect_error();
        die();
    }
    ?>

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
            <h3 class="text-center mb-3">Vymazanie účtu</h3>



            <form method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Ste si istý, že chcete svoj účet vymazať?</label>
                </div>

                <div class="mb-3">
                    <button type="submit" name="yes" class="btn btn-primary w-100 mb-2">
                        Áno
                    </button>
                    <button type="submit" name="no" class="btn btn-primary w-100">
                        Nie
                    </button>
                </div>
            </form>
            <?php
            if (isset($_POST["yes"])) {
                $pouzivatel = $_SESSION["meno"];
                $sql = "DELETE FROM pouzivatel WHERE meno = '$pouzivatel';";
                mysqli_query($conn, $sql);
                session_destroy();
                setcookie("logged", "0", time() - 3600*24);
                $_COOKIE["logged"] = "0";
                mysqli_close($conn);
                header("Location: index.php");
                exit();
            } else if (isset($_POST["no"])) {
                header("Location: Zadanie_PHP_a_SQL.php");
                exit();
            }
            ?>

        </div>
    </div>


</body>

</html>