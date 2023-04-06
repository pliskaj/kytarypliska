<?php

session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
  exit;
}

if (isset($_POST['login-btn'])) {

  $email  = $_POST['email'];
  $password = $_POST['password'];

  $stmt = $conn->prepare("SELECT uziv_id, uziv_jmeno, uziv_email, uziv_heslo FROM uzivatele WHERE uziv_email = ? LIMIT 1");

  $stmt->bind_param('s', $email);

  if ($stmt->execute()) {
    $stmt->bind_result($uziv_id, $uziv_jmeno, $uiv_jmeno, $hash_password);
    $stmt->store_result();

    if ($stmt->num_rows() == 1) {
      $row = $stmt->fetch();

      if (password_verify($password, $hash_password)) {
        $_SESSION['uziv_id'] = $uziv_id;
        $_SESSION['uziv_jmeno'] = $name;
        $_SESSION['uziv_email'] = $email;
        $_SESSION['logged_in'] = true;

        header('location: account.php?login_message=Nyní jste přihlášen/a!');
      } else {
        header('location: login.php?error=Špatné heslo!');
      }
    } else {
      header('location: account.php?error=Přihlášení se nezdařilo!');
    }
  } else {
    //errory 

    header('location: login.php?error=Chyba při přihlášení!');
  }
}


?>


<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://kit.fontawesome.com/fd1bc553ca.js" crossorigin="anonymous"></script>

  <title>Hello, world!</title>
</head>

<body>
  <!--Navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-white py-3 fixed-top">
    <div class="container-fluid">
      <img src="assets/img/logo1.png" alt="logo" class="logo" />
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav-buttons" id="navbarTogglerDemo02">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Domů</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="shop.html">Obchod</a>
          </li>
          <!--<li class="nav-item">
              <a class="nav-link" href="#">O nás</a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Kontaktní údaje</a>
          </li>
          <li class="nav-item">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="account.php"> <i class="fa-solid fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Login-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Přihlásit se</h2>
      <hr class="mx-auto" />
    </div>

    <div class="mx-auto container">
      <form id="login-form" method="POST" action="login.php">
        <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                      echo $_GET['error'];
                                                    } ?></p>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="login-email" name="email" placeholder="Zadejte email" required />
        </div>
        <div class="form-group">
          <label for="email">Heslo</label>
          <input type="password" class="form-control" id="login-password" name="password" placeholder="Zadejte heslo" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="login-btn" name="login-btn" value="Přihlásit se" />
        </div>
        <div class="form-group">
          <a id="register-url" href="register.php" class="btn">Zaregistrovat se</a>
        </div>
      </form>
    </div>
  </section>

  <!--Footer-->

  <footer class="mt-5 py-5">
    <div class="row container mx-auto">
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <img src="assets/img/logo.png" class="logo1" />
        <p class="pt-3">
          Prodáváme hudební nástroje, vybavení za dobré peníze.
        </p>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Doporučeno</h5>
        <ul class="text-uppercase">
          <li><a href="#">Men</a></li>
          <li><a href="#">Men</a></li>
          <li><a href="#">Men</a></li>
          <li><a href="#">Men</a></li>
          <li><a href="#">Men</a></li>
        </ul>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Kontakt</h5>
        <div>
          <h6 class="text-uppercase">Adresa</h6>
          <p>Olšinky 510, Ústí nad Labem, 403 22</p>
        </div>
        <div>
          <h6 class="text-uppercase">Telefon</h6>
          <p>+420 777 777 777</p>
        </div>
        <div>
          <h6 class="text-uppercase">Email</h6>
          <p>janpliska@outlook.cz</p>
        </div>
      </div>
      <div class="footer-one col-lg-3 col-md-6 col-sm-12">
        <h5 class="pb-2">Instagram</h5>
        <div class="row">
          <img src="assets/img/footer.jpg" class="img-fluid w-25 h-100 m-2" />
          <img src="assets/img/footer.jpg" class="img-fluid w-25 h-100 m-2" />
          <img src="assets/img/footer.jpg" class="img-fluid w-25 h-100 m-2" />
          <img src="assets/img/footer.jpg" class="img-fluid w-25 h-100 m-2" />
          <img src="assets/img/footer.jpg" class="img-fluid w-25 h-100 m-2" />
        </div>
      </div>
    </div>

    <div class="copyright mt-5">
      <div class="row container mx-auto">
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4">
          <img src="assets/img/payment.png" />
        </div>
        <div class="col-lg-3 col-md-5 col-sm-12 mb-4 text-nowrap mb-5">
          <p>Kytary Pliska @ 2023 Všechna práva vyhrazena</p>
        </div>
      </div>
    </div>
  </footer>
</body>

</html>