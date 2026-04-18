<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8">
  <title>Registrácia stránka - Cookies úloha</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
  <?php
  $conn = mysqli_connect("localhost", "root", "root", "databaza_knih");

  if(!$conn){
    echo "Chyba pripojenia" . mysqli_connect_error();
  }
  if (isset($_POST["register"])) {
    $meno = $_POST["meno"];
    $email = $_POST["email"];
    $heslo = password_hash($_POST["helso"], PASSWORD_DEFAULT);
    $sql = "INSERT INTO pouzivatel (meno, email, heslo) VALUES ('$meno', '$email', '$heslo')";
    mysqli_query($conn, $sql);
  }
?>

<div class="container d-flex justify-content-center align-items-center vh-100">
  <div class="card shadow p-4" style="max-width: 400px; width: 100%;">
    
    <h3 class="text-center mb-3">Registrácia používateľa</h3>
      
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Používateľské meno</label>
          <input type="text" class="form-control" name="meno" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" required>
        </div>

        <div class="mb-3">
          <label class="form-label">Heslo</label>
          <input type="password" class="form-control" name="heslo" required>
        </div>

        <button type="submit" name="register" class="btn btn-primary w-100">
          Registrovať sa
        </button>
      </form>
      <?php
      session_start();
        if(isset($_POST["register"])) {
            if(isset($_POST["meno"]) && isset($_POST["heslo"])){
                $sql = "SELECT * FROM pouzivatel";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    if($_POST["meno"] == $row["meno"] && password_verify($_POST["heslo"], $row["heslo"])) {
                        $_SESSION["meno"] = $row["meno"];
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