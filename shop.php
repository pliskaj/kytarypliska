<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous" />
  <link rel="stylesheet" href="assets/css/style.css" />
  <script src="https://kit.fontawesome.com/fd1bc553ca.js" crossorigin="anonymous"></script>

  <title>Obchod</title>
  <style>
    .product img {
      width: 100%;
      height: auto;
      box-sizing: border-box;
      object-fit: cover;
    }

    .pagination {
      color: rgb(3, 57, 119);
    }

    .pagination li:hover a {
      color: #fff;
      background-color: rgb(3, 57, 119);
    }
  </style>
</head>

<body>
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
            <a class="nav-link" href="shop.php">Obchod</a>
          </li>
          <!--<li class="nav-item">
              <a class="nav-link" href="#">O nás</a>
            </li> -->
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Kontaktní údaje</a>
          </li>
          <li class="nav-item">
            <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <a href="account.html"> <i class="fa-solid fa-user"></i></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section id="featured" class="my-5 py-5">
    <?php include('server/get_all.php'); ?>
    <div class="container mt-5 py-5">
      <h3>Naše produkty</h3>
      <hr />
      <p>Zde jsou žhavé produkty, které vřele doporučujeme.</p>
    </div>
    <div class="row mx-auto container">
      <?php while ($row = $all_products->fetch_assoc()) { ?>
        <div onclick="window.location.href='single_product.php';" class="product text-center col-lg-3 col-md-4 col-sm-12">
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
          <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Koupit</button></a>

        </div>
      <?php } ?>

      <nav aria-label="Paginace">
        <ul class="pagination mt-5">
          <li class="page-item">
            <a class="page-link" href="#">Previous</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">1</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">3</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="#">Next</a>
          </li>
        </ul>
      </nav>

    </div>
  </section>

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
          <li><a href="obchod.php">Obchod</a></li>
          <li><a href="contact.html">Kontaktní údaje</a></li>
          <li><a href="login.html">Přihlášení</a></li>
          <li><a href="register.html">Registrace</a></li>
          <li><a href="account.html">Přihlášení</a></li>
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
        <h5 class="pb-2">Sociální sítě</h5>
        <div class="row">
          <a href="facebook.com"><i class="fab fa-facebook-f w-25 h-100 m-2"></i></a>
          <a href="instagram.com"><i class="fab fa-instagram w-25 h-100 m-2"></i></a>
          <a href="twitter.com"><i class="fab fa-twitter w-25 h-100 m-2"></i></a>
          <a href="youtube.com"><i class="fab fa-youtube w-25 h-100 m-2"></i></a>
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