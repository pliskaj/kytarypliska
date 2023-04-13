<?php

include('server/connection.php');
include('layouts/header.php');

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

<?php include('layouts/footer.php'); ?>