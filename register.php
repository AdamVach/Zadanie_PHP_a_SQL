<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <title>Registrácia stránka - Cookies úloha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <?php
  $conn = mysqli_connect("localhost", "root", "root", "pouzivatelia");

  if(!$conn){
    echo "Chyba pripojenia" . mysqli_connect_error();
  }
  if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $sql = "INSERT INTO pouzivatel (meno, heslo) VALUES ('$username', '$password')";
    mysqli_query($conn, $sql);
  }
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    
    <h3 class="text-center mb-3">Registrácia používateľa</h3>
      
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Používateľské meno</label>
          <input type="text" class="form-control" name="username" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Heslo</label>
          <input type="password" class="form-control" name="password" required>
        </div>

        <button type="submit" name="register" class="btn btn-primary w-100">
          Registrovať sa
        </button>
      </form>
      <?php
        if(isset($_POST["register"])) {
            if(isset($_POST["username"]) && isset($_POST["password"])){
                $sql = "SELECT * FROM pouzivatel";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($_POST["username"] == $row["meno"] && password_verify($_POST["password"], $row["heslo"])) {
                        setcookie("logged", "1", time()+3600);
                        $_COOKIE["logged"] = "1";

                        header("Location: Zadanie_PHP_a_SQL.php");
                        exit();
                        break;
                    }
                }
            }
        }
        
        ?>
    <hr class="my-3">

    <div class="text-center">
      <a href="index.php" class="text-decoration-none">Už máte účet? Prihláste sa</a>

    </div>

  </div>
</div>

</body>
</html>