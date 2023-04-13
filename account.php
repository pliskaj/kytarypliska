<?php
include('server/connection.php');
include('layouts/header.php');
if (!isset($_SESSION['logged_in'])) {
  header('location: login.php');
  exit;
}

if (isset($_GET['logout'])) {
  if (isset($_SESSION['logged_in'])) {
    session_destroy();
    unset($_SESSION['logged_in']);
    unset($_SESSION['uziv_jmeno']);
    unset($_SESSION['uziv_email']);
    header('location: login.php');
    exit;
  }
}

if (isset($_POST['changePassword'])) {

  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $email = $_SESSION['uziv_email'];

  // zkontroluj jestli se hesla shoduji
  if ($password !== $confirmPassword) {
    header('location: account.php?error=Hesla se neshodují!');
  }

  //zkontroluj jestli heslo ma alespon 6 znaku
  else if (strlen($password) < 6) {
    header('location: account.php?error=Heslo musí mít alespoň 6 znaků!');
  } else {

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("UPDATE uzivatele SET uziv_heslo = ? WHERE uziv_email = ?");
    $stmt->bind_param('ss', $password_hash, $email);

    if ($stmt->execute()) {

      header('location: account.php?message=Heslo bylo změněno!');
    } else {
      header('location: account.php?error=Chyba při změně hesla!');
    }
  }
}


if (isset($_SESSION['logged_in'])) {

  $uziv_id = $_SESSION['uziv_id'];
  $stmt = $conn->prepare("SELECT * FROM objednavky WHERE uziv_id = ?");

  $stmt->bind_param('i', $_SESSION['uziv_id']);

  $stmt->execute();

  $objednavky = $stmt->get_result();
}




?>

<!--Účet-->

<section class="my-5 py-5">
  <div class="row container mx-auto">
    <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
      <h3 class="font-weight-bold">Informace o účtu</h3>
      <hr class="mx-auto" />
      <div class="account-info">
        <p>Jméno: <span><?php if (isset($_SESSION['uziv_jmeno'])) {
                          echo $_SESSION['uziv_jmeno'];
                        } ?></span></p>
        <p>Email: <span><?php if (isset($_SESSION['uziv_email'])) {
                          echo $_SESSION['uziv_email'];
                        } ?></span></p>
        <p><a href="#orders" id="order-btn">Vaše objednávky</a></p>
        <p><a href="account.php?logout=1" id="logout-btn">Odhlásit se</a></p>
      </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">
      <form id="account-form" method="POST" action="account.php">
        <p class="text-center" style="color:red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                  } ?></p>
        <p class="text-center" style="color:green;"><?php if (isset($_GET['message'])) {
                                                      echo $_GET['message'];
                                                    } ?></p>
        <p class="text-center" style="color:green"><?php if (isset($_GET['register_message'])) {
                                                      echo $_GET['register_message'];
                                                    } ?></p>
        <p class="text-center" style="color:green"><?php if (isset($_GET['login_message'])) {
                                                      echo $_GET['login_message'];
                                                    } ?></p>
        <p class="text-center" style="color:green"><?php if (isset($_GET['payment_message'])) {
                                                      echo $_GET['payment_message'];
                                                    } ?></p>
        <h3>Změnit heslo</h3>
        <hr class="mx-auto" />
        <div class="form-group">
          <label>Heslo</label>
          <input type="password" class="form-control" id="account-password" name="password" placeholder="Heslo" required />
        </div>
        <div class="form-group">
          <label>Potvrďte heslo</label>
          <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Potvrďte heslo" required />
        </div>
        <div class="form-group">
          <input type="submit" value="Změnit heslo" name="changePassword" class="btn" id="change-pass-btn" />
        </div>
      </form>
    </div>
  </div>
</section>

<!--Objednávky-->

<section id="orders" class="orders container my-2 py-3">
  <div class="container mt-2">
    <h2 class="font-weight-bold text-center">Vaše objednávky</h2>
    <hr class="mx-auto" />
  </div>

  <table class="mt-5 pt-5">
    <tr>
      <th>ID objednávky</th>
      <th>Cena</th>
      <th>Stav objednávky</th>
      <th>Datum</th>
      <th> Podrobnosti o objednávce</th>
    </tr>

    <?php while ($row = $objednavky->fetch_assoc()) { ?>
      <tr>
        <td>
          <!--<div class="product-info">
              <!-- <img src="assets/img/kyt1.jpg" /> 
              <div>
                <p class="mt-3"><?php echo $row['obj_id']; ?></p>
              </div>
            </div>  -->
          <span><?php echo $row['obj_id']; ?></span>
        </td>
        <td>
          <span><?php echo $row['obj_cena']; ?> Kč</span>
        </td>
        <td>
          <span><?php echo $row['obj_status']; ?></span>
        </td>
        <td>
          <span><?php echo $row['obj_datum']; ?></span>
        </td>
        <td>
          <form method="POST" action="order_details.php">
            <input type="hidden" value="<?php echo $row['obj_status']; ?>" name="obj_status" />
            <input type="hidden" value="<?php echo $row['obj_id']; ?>" name="obj_id">
            <input class="btn order-btn" name="order_details_btn" type="submit" value="Zobrazit" />
          </form>
        </td>
      </tr>
    <?php } ?>
  </table>
</section>

<?php include('layouts/footer.php'); ?>