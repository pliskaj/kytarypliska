<?php

session_start();

if (isset($_POST['pridatDoKosiku'])) {

  //pokud jiz uzivatel pridal produkt do kosiku
  if (isset($_SESSION['cart'])) {

    $produkt_array_idcka = array_column($_SESSION['cart'], 'produkt_id');
    //pokud uz byl produkt pridan do kosiku nebo ne
    if (!in_array($_POST['produkt_id'], $produkt_array_idcka)) {

      $produkt_id = $_POST['produkt_id'];

      $produkt_array = array(
        'produkt_id' => $_POST['produkt_id'],
        'produkt_jmeno' => $_POST['produkt_jmeno'],
        'produkt_cena' => $_POST['produkt_cena'],
        'produkt_fotka' => $_POST['produkt_fotka'],
        'produkt_pocet' => $_POST['produkt_pocet']
      );

      $_SESSION['cart'][$produkt_id] = $produkt_array;

      //produkt je jiz pridan
    } else {

      // echo '<script>alert("Produkt byl již přidán!");</script>';
      // echo '<script>window.location="index.php"</script>';
    }

    //pokud je tohle prvni produkt v kosiku
  } else {

    //z nejakyho duvodu se tohle proste musi hodit do varů..
    $produkt_id = $_POST['produkt_id'];
    $produkt_jmeno = $_POST['produkt_jmeno'];
    $produkt_cena = $_POST['produkt_cena'];
    $produkt_fotka = $_POST['produkt_fotka'];
    $produkt_pocet = $_POST['produkt_pocet'];

    $produkt_array = array(
      'produkt_id' => $produkt_id,
      'produkt_jmeno' => $produkt_jmeno,
      'produkt_cena' => $produkt_cena,
      'produkt_fotka' => $produkt_fotka,
      'produkt_pocet' => $produkt_pocet
    );

    $_SESSION['cart'][$produkt_id] = $produkt_array;
  }

  //zavolame funkci na spocet cele ceny

  PlnaCenaProduktu();



  //odebrat proukt z kosiku 
} else if (isset($_POST['remove_product'])) {

  $produkt_id = $_POST['produkt_id'];

  unset($_SESSION['cart'][$produkt_id]);

  //zavolame funkci na spocet cele ceny
  PlnaCenaProduktu();
} else if (isset($_POST['edit_pocet'])) {

  $produkt_id = $_POST['produkt_id'];

  $produkt_pocet = $_POST['produkt_pocet'];


  $produkt_array = $_SESSION['cart'][$produkt_id];

  $produkt_array['produkt_pocet'] = $produkt_pocet;

  $_SESSION['cart'][$produkt_id] = $produkt_array;

  PlnaCenaProduktu();
} else {
  header("location: index.php");
}

function PlnaCenaProduktu()
{

  $total = 0;

  foreach ($_SESSION['cart'] as $key => $value) {
    $produkt = $_SESSION['cart'][$key];

    $cena = $produkt['produkt_cena'];
    $pocet = $produkt['produkt_pocet'];

    $celkova_cena = $total + ($cena * $pocet);
  }

  $_SESSION['celkove'] = $celkova_cena;
}




?>

<!DOCTYPE html>
<html lang="en">

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
            <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="account.html"> <i class="fa-solid fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Košík-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bold">Váš nákupní košík</h2>
      <hr />
    </div>

    <table class="mt-5 pt-5">
      <tr>
        <th>Produkt</th>
        <th>Počet</th>
        <th>Mezisoučet</th>
      </tr>

      <?php foreach ($_SESSION['cart'] as $key => $value) { ?>


        <tr>
          <td>
            <div class="product-info">
              <img src="assets/img/<?php echo $value['produkt_fotka']; ?>" />
              <div>
                <p><?php echo $value['produkt_jmeno']; ?> </p>
                <small><span><?php echo $value['produkt_cena']; ?></span>Kč</small>
                <br />
                <form method="POST" action="cart.php">
                  <input type="hidden" name="produkt_id" value="<?php echo $value['produkt_id']; ?>" />
                  <input type="submit" name="remove_product" class="remove-btn" value="Odebrat" />
                </form>

              </div>
            </div>
          </td>
          <td>

            <form method="POST" action="cart.php">
              <input type="hidden" name="produkt_id" value="<?php echo $value['produkt_id']; ?>" />
              <input type="number" name="produkt_pocet" value="<?php echo $value['produkt_pocet']; ?>" />
              <input type="submit" class="edit-btn" value="edit" name="edit_pocet" />
            </form>

          </td>

          <td>
            <span class="product-price"><?php echo $value['produkt_pocet'] * $value['produkt_cena']; ?></span>
            <span>Kč</span>
          </td>
        </tr>

      <?php } ?>
    </table>

    <div class="cart-total">
      <table>
        <tr>
          <td>Mezisoučet</td>
          <td>2000 Kč</td>
        </tr>
        <td>Celková cena</td>
        <td><?php echo $_SESSION['celkove']; ?></td>
      </table>
    </div>

    <div class="checkout-container">
      <button class="btn checkout-btn">Objednat</button>
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
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>