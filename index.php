<?php include('layouts/header.php'); ?>

<!--Domov-->
<section id="home">
  <div class="container-fluid">
    <h5>Kytary Pliska</h5>
    <h1>Prodáváme <span>hudební</span> nástroje</h1>
    <p>Od houslí po baskytary. Máme široký výběr sortimentu!</p>
    <a href="shop.php"><button>Začněme!</button></a>
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
      <img class="img-fluid" src="assets/img/Dimavery AW-3031.jpg" />
      <div class="details">
        <h2>Dimavery AW-3031</h2>
        <a href="single_product.php?product_id=104"><button class="buy-btn">Objednat</button></a>
      </div>
    </div>
    <!--Dva-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/img/Dimavery DR-612 Westernová elektroakustická kytara12-strunná, přírodní1.jpg" />
      <div class="details">
        <h2>Dimavery DR-612</h2>
        <a href="single_product.php?product_id=106"><button class="buy-btn">Objednat</button></a>
      </div>
    </div>
    <!--Tri-->
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0">
      <img class="img-fluid" src="assets/img/Dimavery ABS kufr pro elektrickou kytaru1.jpg" />
      <div class="details">
        <h2>Dimavery ABS</h2>
        <a href="single_product.php?product_id=114"><button class="buy-btn">Objednat</button></a>
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
    <h4>Kolekce od Dimavery</h4>
    <h1>Do výprodeje zásob slevy až 20%</h1>
    <a href="#guitars"> <button class="text-uppercase"> Objednat</button></a>
    < </div>
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
        <h5 class="p-name"><?php echo $row['produkt_jmeno'] ?></h5>
        <h4 class="p-price"><?php echo $row['produkt_cena'] ?> Kč</h4>
        <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>">Objednat</a>
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
        <img class="img-fluid mb-3" src="assets/img/<?php echo $row['produkt_fotka'] ?>" />
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
        <img class="img-fluid mb-3" src="assets/img/<?php echo $row['produkt_fotka'] ?>" />
        <h5 class="p-name"><?php echo $row['produkt_jmeno'] ?></h5>
        <h4 class="p-price"><?php echo $row['produkt_cena'] ?> Kč</h4>
        <a href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>"><button class="buy-btn">Objednat</button></a>

      </div>
    <?php } ?>
  </div>
</section>

<?php include('layouts/footer.php') ?>