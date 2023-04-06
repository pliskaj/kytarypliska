<?php

include('server/connection.php');
include('layouts/header.php');


//pokud uzivatel pouziva search tak query pojede jinak
if (isset($_POST['hledani'])) {


  $kategorie = $_POST['kategorie'];
  $cena = $_POST['cena'];

  $stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg = ? AND produkt_cena <=> ?");

  $stmt->bind_param('si', $kategorie, $cena);

  $stmt->execute();

  $produkty = $stmt->get_result();
} else {

  //pokud uzivatel nepouziva search tak query pojede normalne ze vsech
  $stmt = $conn->prepare("SELECT * FROM produkty ");

  $stmt->execute();

  $produkty = $stmt->get_result();
}





?>






<section id="search" class="my-5 py-5">
  <div class="container mt-5 py-5">
    <h3>Vyhledávání</h3>
    <hr />
    <p>Vyhledejte si zde svůj oblíbený produkt.</p>
  </div>

  <form action="shop.php" method="POST">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <p>Kategorie</p>
          <div class="form-check">
            <input class="form-check-input" value="kytary" type="radio" name="kategorie" id="category1" />
            <label class="form-check-label" for="category1"> Kytary </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="baskytary" type="radio" name="kategorie" id="category2" />
            <label class="form-check-label" for="category2">
              Baskytary
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="doplnky" type="radio" name="kategorie" id="category3" />
            <label class="form-check-label" for="category3">
              Doplňky
            </label>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <p>Cena</p>
          <input type="range" class="form-control-range" name="cena" value="9000" min="1000" max="10000" id="customRange2" />
          <div class="d-flex justify-content-between">
            <span>1 Kč </span>
            <span>10 000 Kč</span>
          </div>
        </div>
      </div>

      <div class="form-group my-3 text-center">
        <input type="submit" name="hledani" value="Hledat" class="btn btn-primary" />
      </div>
    </div>
  </form>
</section>

<section id="shop" class="my-5 py-5">
  <div class="container mt-5 py-5">
    <h3>Naše produkty</h3>
    <hr />
    <p>Zde jsou žhavé produkty, které vřele doporučujeme.</p>
  </div>
  <div class="row mx-auto container">

    <?php while ($row = $produkty->fetch_assoc()) { ?>

      <div onclick="window.location.href='single_product.html';" class="product text-center col-lg-3 col-md-4 col-sm-12">
        <img class="img-fluid mb-3" src="assets/img/<?php echo $row['produkt_fotka']; ?>" />
        <div class="star">
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
          <i class="fa fa-star"></i>
        </div>
        <h5 class="p-name"><?php echo $row['produkt_jmeno']; ?></h5>
        <h4 class="p-price"><?php echo $row['produkt_cena']; ?></h4>
        <a class="btn buy-btn" href="<?php echo "single_product.php?product_id=" . $row['produkt_id']; ?>">Koupit</a>
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

<?php include('layouts/footer.php'); ?>