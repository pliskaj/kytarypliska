<?php

include('server/connection.php');
include('layouts/header.php');

$page_no = 1;
//pokud uzivatel pouziva search tak query pojede jinak
if (isset($_POST['hledani'])) {




  $kategorie = $_POST['kategorie'];
  $cena = $_POST['cena'];

  $stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_kateg = ? AND produkt_cena <= ?");

  $stmt->bind_param('si', $kategorie, $cena);

  $stmt->execute();


  $produkty = $stmt->get_result();
} else {

  //Zjisti na jakym cisle paginace jsme

  if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
  } else {

    //pokud uzivatel neni na zadne strance tak se mu zobrazi prvni stranka
    $page_no = 1;
  }


  //vrat pocet vsech produktu
  $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM produkty");
  $stmt1->execute();
  $stmt1->bind_result($total_records);
  $stmt1->store_result();
  $stmt1->fetch();


  //pocet produktu na strance
  $per_page = 8;

  $offset = ($page_no - 1) * $per_page;

  $previous_page = $page_no - 1;
  $next_page = $page_no + 1;

  $adjecents = "2";

  $total_no_of_pages = ceil($total_records / $per_page);

  //dej mi vsechny produkty

  $stmt2 = $conn->prepare("SELECT * FROM produkty LIMIT $offset, $per_page");
  $stmt2->execute();
  $produkty = $stmt2->get_result();
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
            <input class="form-check-input" value="akustika" type="radio" name="kategorie" id="category1" <?php if (isset($category1) && $category1 == 'akustika') {
                                                                                                            echo 'checked';
                                                                                                          } ?> />
            <label class="form-check-label" for="flexRadioDefault1"> Akustické kytary </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="poloakustika" type="radio" name="kategorie" id="category2" <?php if (isset($category2) && $category2 == 'poloakustika') {
                                                                                                                echo 'checked';
                                                                                                              } ?> />
            <label class="form-check-label" for="flexRadioDefault2">
              Poloakustické kytary
            </label>
          </div>
          <div class="form-check">
            <input class="form-check-input" value="doplnky" type="radio" name="kategorie" id="category3" <?php if (isset($category3) && $category3 == 'doplnky') {
                                                                                                            echo 'checked';
                                                                                                          } ?> />
            <label class="form-check-label" for="flexRadioDefault3">
              Doplňky
            </label>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <p>Cena</p>
          <input type="range" class="form-control-range" name="cena" value="<?php if (isset($cena)) {
                                                                              echo $cena;
                                                                            } else {
                                                                              echo "1000";
                                                                            } ?>" min="1000" max="10000" id="customRange2" />
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
          <a class="page-link <?php if ($page_no <= 1) {
                                echo 'disabled';
                              } ?>" href="<?php if ($page_no <= 1) {
                                            echo '#';
                                          } else {
                                            echo "?page_no" . $page_no - 1;
                                          } ?>">Previous</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=1">1</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="?page_no=2">2</a>
        </li>

        <?php if ($page_no >= 3) { ?>
          <li class="page-item">
            <a class="page-link" href="#">...</a>
          </li>
          <li class="page-item">
            <a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a>
          </li>
        <?php } ?>
        <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                echo 'disabled';
                              } ?>">
          <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                        echo '#';
                                      } else {
                                        echo "?page_no=" . $page_no + 1;
                                      } ?>

          } ?>">Next</a>
        </li>
      </ul>
    </nav>
  </div>
</section>

<?php include('layouts/footer.php'); ?>