<?php

session_start();

include('server/connection.php');
include('layouts/header.php');

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

<?php include('layouts/footer.php'); ?>