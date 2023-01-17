<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {

  $product_id = $_GET['product_id'];


  $stmt = $conn->prepare('SELECT * FROM produkty WHERE produkt_id =?');
  $stmt->bind_param('s', $product_id);

  $stmt->execute();

  $product = $stmt->get_result();
} else {


  // Redirect to the index page
  header("Location: index.php");
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
</head>

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
          <a class="nav-link" href="contact.html">Kontakt</a>
        </li>
        <li class="nav-item">
          <a href="cart.html"><i class="fa-solid fa-cart-shopping"></i></a>
          <a href="account.html"><i class="fa-solid fa-user"></i></a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!--Produkt-->
<section class="single-product my-5 pt-5">
  <div class="row mt-5">

    <?php while ($row = $product->fetch_assoc()) { ?>



      <div class="col-lg-5 col-md-6 col-sm-12">
        <img class="img-fluid w-100 pb-1" src="assets/img/<?php echo $row['produkt_fotka']; ?>" id="mainImg" />
        <div class="small-img-group">
          <div class="small-img-col">
            <img src="assets/img/<?php echo $row['produkt_fotka']; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/img/<?php echo $row['produkt_fotka2']; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/img/<?php echo $row['produkt_fotka3']; ?>" width="100%" class="small-img" />
          </div>
          <div class="small-img-col">
            <img src="assets/img/<?php echo $row['produkt_fotka4']; ?>" width="100%" class="small-img" />
          </div>
        </div>

      </div>


      <div class="col-lg-5 col-md-12 col-sm-12">
        <h6>D'Adarrio OK1</h6>
        <h3 class="py-4"><?php echo $row['produkt_jmeno']; ?></h3>
        <h2><?php echo $row['produkt_cena']; ?> Kč</h2>
        <form method="POST" action="cart.php">
          <input type="hidden" name="produkt_id" value="<?php echo $row['produkt_id']; ?>" />
          <input type="hidden" name="produkt_fotka" value="<?php echo $row['produkt_fotka']; ?>" />
          <input type="hidden" name="produkt_jmeno" value="<?php echo $row['produkt_jmeno']; ?>" />
          <input type="hidden" name="produkt_cena" value="<?php echo $row['produkt_cena']; ?>" />
          <input type="number" name="produkt_pocet" value="1" />
          <button class="buy-btn" type="submit" name="pridatDoKosiku">Přidat do košíku</button>
        </form>

        <h4 class="mt-5">Detaily o produktu</h4>
        <span><?php echo $row['produkt_popis']; ?></span>
      </div>
  </div>


<?php } ?>
</section>

<section id="related-products" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Podobné produkty</h3>
    <hr class="mx-auto" />
  </div>
  <div class="row mx-auto container-fluid">
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/img/kyt1.jpg" />
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Ibanez 234</h5>
      <h4 class="p-price">2000 Kč</h4>
      <button class="buy-btn">Koupit</button>
      <h2>Washburn 13G3</h2>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/img/kyt1.jpg" />
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Ibanez 234</h5>
      <h4 class="p-price">2000 Kč</h4>
      <button class="buy-btn">Koupit</button>
      <h2>Washburn 13G3</h2>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/img/kyt1.jpg" />
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Ibanez 234</h5>
      <h4 class="p-price">2000 Kč</h4>
      <button class="buy-btn">Koupit</button>
      <h2>Washburn 13G3</h2>
    </div>
    <div class="product text-center col-lg-3 col-md-4 col-sm-12">
      <img class="img-fluid mb-3" src="assets/img/kyt1.jpg" />
      <div class="star">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
      </div>
      <h5 class="p-name">Ibanez 234</h5>
      <h4 class="p-price">2000 Kč</h4>
      <button class="buy-btn">Koupit</button>
      <h2>Washburn 13G3</h2>
    </div>
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

<body>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  <script>
    var mainImg = document.getElementById("mainImg");
    var smallImg = document.getElementsByClassName("small-img");

    for (let i = 0; i < 4; i++) {
      smallImg[i].onclick = function() {
        mainImg.src = smallImg[i].src;
      };
    }

    smallImg[0].onclick = function() {
      mainImg.src = smallImg[0].src;
    };
  </script>
</body>

</html>