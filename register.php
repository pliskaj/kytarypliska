<?php

include('server/connection.php');
include('layouts/header.php');

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

<?php include('layouts/footer.php'); ?>