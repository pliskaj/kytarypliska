<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://kit.fontawesome.com/fd1bc553ca.js" crossorigin="anonymous"></script>

  <title>Hello, world!</title>
</head>

<body>
  <!--Navigace-->
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
          <!-- <li class="nav-item">
              <a class="nav-link" href="#">O nás</a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Kontaktní údaje</a>
          </li>
          <li class="nav-item">
            <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="account.html"><i class="fa-solid fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!--Domov-->
  <section id="home">
    <div class="container-fluid">
      <h5>Kytary Pliska</h5>
      <h1>Prodáváme <span>hudební</span> nástroje</h1>
      <p>Od houslí po baskytary. Máme široký výběr sortimentu!</p>
      <button>Let's start!</button>
    </div>
  </section>

  <!--Značky-->

  <section id="brand" class="container">
    <div class="row m-8">
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand/washburn.svg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand/gibson.svg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand/fender.svg" />
      <img class="img-fluid col-lg-3 col-md-6 col-sm-12" src="assets/img/brand/ibanez.svg" />
    </div>
  </section>

  <!--Novinky-->

  <selection id="new" class="w-100">
    <div class="row p-0 m-0">
      <!--Prvni-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/img/kyt1.jpg" />
        <div class="details">
          <h2>Washburn 13G3</h2>
          <button class="text-uppercase">Koupit hned</button>
        </div>
      </div>
      <!--Dva-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/img/kyt1.jpg" />
        <div class="details">
          <h2>Washburn 13G3</h2>
          <button class="text-uppercase">Koupit hned</button>
        </div>
      </div>
      <!--Tri-->
      <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
        <img class="img-fluid" src="assets/img/kyt1.jpg" />
        <div class="details">
          <h2>Washburn 13G3</h2>
          <button class="text-uppercase">Koupit hned</button>
        </div>
      </div>
    </div>
  </selection>

  <!--Doporučeno-->
  <section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Doporučeno námi</h3>
      <hr class="mx-auto" />
      <p>Zde jsou žhavé produkty, které vřele doporučujeme.</p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php include('server/get_featured_products.php');
      ?>

      <?php while ($row = $featured_products->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/img/<?php echo $row['produkt_fotka']; ?>" />
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['produkt_jmeno']; ?></h5>
          <h4 class="p-price"><?php echo $row['produkt_cena']; ?> Kč</h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Objednat</button></a>
        </div>

      <?php } ?>
    </div>
  </section>

  <!--Banner-->

  <section id="banner" class="my-5 py-5">
    <div class="container">
      <h4>Kolekce od Ibanez</h4>
      <h1>Do výprodeje zásob slevy až 60%</h1>
      <button class="text-uppercase">Koupit hned</button>
    </div>
  </section>

  <!--Kytary-->

  <section id="guitars" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Akustické kytary</h3>
      <hr class="mx-auto" />
      <p>
        Nabízíme velký sortiment akustických kytar, od menších značek po staré známé
        klasiky.
      </p>
    </div>
    <div class="row mx-auto container-fluid">

      <?php include('server/get_acoustic.php'); ?>
      <?php while ($row = $acoustic->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/img/<?php echo $row['produkt_fotka'] ?>" />
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['produkt_jmeno'] ?></h5>
          <h4 class="p-price"><?php echo $row['produkt_cena'] ?> Kč</h4>
          <button class="buy-btn">Koupit</button>
          <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Objednat</button></a>
        </div>

      <?php } ?>
    </div>
  </section>

  <!--Baskytary-->

  <section id="basses" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Baskytary</h3>
      <hr class="mx-auto" />
      <p>Baskytary a doplňky pro baskytary.</p>
    </div>
    <div class="row mx-auto container-fluid">
      <?php include('server/get_bass.php'); ?>
      <?php while ($row = $bass->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/img<?php echo $row['produkt_fotka'] ?>" />
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['produkt_jmeno'] ?></h5>
          <h4 class="p-price"><?php echo $row['produkt_cena'] ?> Kč</h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Objednat</button></a>
        </div>
      <?php } ?>
    </div>
  </section>

  <!--Doplňky-->

  <section id="addons" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Doplňky</h3>
      <hr class="mx-auto" />
      <p>Hledáte ladičku na kytaru, baskytaru? Nebo snad kvalitní trsátka?</p>
    </div>
    <div class="row mx-auto container-fluid">
      /<?php include('server/get_addons.php'); ?>
      <?php while ($row = $addon->fetch_assoc()) { ?>
        <div class="product text-center col-lg-3 col-md-4 col-sm-12">
          <img class="img-fluid mb-3" src="assets/img/kyt1.jpg" />
          <div class="star">
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
            <i class="fa fa-star"></i>
          </div>
          <h5 class="p-name"><?php echo $row['produkt_jmeno'] ?></h5>
          <h4 class="p-price"><?php echo $row['produkt_cena'] ?> Kč</h4>
          <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Objednat</button></a>

        </div>
      <?php } ?>
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

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>