<?php

session_start();

include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
  header('location: account.php');
}

if (isset($_POST['register'])) {


  $name = $_POST['jmeno'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];


  // zkontroluj jestli se hesla shoduji
  if ($password !== $confirmPassword) {
    header('location: register.php?error=Hesla se neshodují!');
  }

  //zkontroluj jestli heslo ma alespon 6 znaku
  else if (strlen($password) < 6) {
    header('location: register.php?error=Heslo musí mít alespoň 6 znaků!');
  } else {

    $stmt1 = $conn->prepare("SELECT count(*) FROM uzivatele WHERE uziv_email = ?");
    $stmt1->bind_param('s', $email);
    $stmt1->execute();
    $stmt1->bind_result($num_rows);
    $stmt1->store_result();
    $stmt1->fetch();

    if ($num_rows != 0) {
      header('location: register.php?error=Email je již použit!');
    } else {

      $password = password_hash($password, PASSWORD_DEFAULT);

      $stmt = $conn->prepare("INSERT INTO uzivatele (uziv_jmeno, uziv_email, uziv_heslo) VALUES (?,?,?)");
      $stmt->bind_param('sss', $name, $email, $password);

      if ($stmt->execute()) {

        $uziv_id = $stmt->insert_id;
        $_SESSION['uziv_id'] = $uziv_id;
        $_SESSION['uziv_email'] = $email;
        $_SESSION['uziv_jmeno'] = $name;
        $_SESSION['logged_in'] = true;
        header('location: account.php?register_message=Nyní jste zaregistrován/a!');
      } else {
        header('location: register.php?register_error=Chyba při registraci!');
      }

      $stmt->close();
      $conn->close();
    }
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
            <a class="nav-link" href="index.html">Domů</a>
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

  <!--Register-->

  <section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
      <h2 class="form-weight-bold">Přihlásit se</h2>
      <hr class="mx-auto" />
    </div>

    <div class="mx-auto container">
      <form id="register-form" method="POST" action="register.php">
        <p style="color: red;"><?php if (isset($_GET['error'])) {
                                  echo $_GET['error'];
                                } ?></p>
        <div class="form-group">
          <label>Jméno</label>
          <input type="text" class="form-control" id="register-name" name="jmeno" placeholder="Zadejte Vaše jméno" required />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" class="form-control" id="register-email" name="email" placeholder="Zadejte Váš email" required />
        </div>
        <div class="form-group">
          <label for="password">Heslo</label>
          <input type="password" class="form-control" id="register-password" name="password" placeholder="Zadejte heslo" required />
        </div>
        <div class="form-group">
          <label for="password">Potvrzení hesla</label>
          <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword" placeholder="Potvrďte heslo" required />
        </div>
        <div class="form-group">
          <input type="submit" class="btn" id="register-btn" name="register" value="Zaregistrovat se" />
        </div>
        <div class="form-group">
          <a id="login-url" class="btn">Přihlásit se</a>
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