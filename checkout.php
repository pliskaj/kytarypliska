<?php
include('layouts/header.php');
//prevence proti poslani formulare bez vyplneni kosiku
if (!empty($_SESSION['cart'])) {
  // pust ho dal


} else {
  header("location: index.php");
}


?>


<!--Nákup-->
<section class="my-5 py-5">
  <div class="container text-center mt-3 pt-5">
    <h2 class="form-weight-bold">Nákup</h2>
    <hr class="mx-auto" />
  </div>

  <div class="mx-auto container">
    <!-- Cesta:  server/place_order.php -->
    <form id="checkout-form" method="POST" action="server/place_order.php">
      <p class="text-center" style="color: red;"><?php if (isset($_GET['error'])) {
                                                    echo $_GET['error'];
                                                  } ?>
        <?php if (isset($_GET['error'])) { ?>
          <a href="login.php" class="btn btn-primary">Přihlásit se</a>
        <?php } ?>
      </p>


      <div class="form-group checkout-small-element">
        <label>Jméno</label>
        <input type="text" class="form-control" id="checkout-name" name="jmeno" placeholder="Zadejte Vaše jméno" required />
      </div>
      <div class="form-group checkout-small-element">
        <label>Email</label>
        <input type="email" class="form-control" id="checkout-email" name="email" placeholder="Zadejte Váš email" required />
      </div>
      <div class="form-group checkout-small-element">
        <label for="phone">Telefon</label>
        <input type="phone" class="form-control" id="checkout-phone" name="telefon" placeholder="Zadejte Vaše telefonní číslo" required />
      </div>
      <div class="form-group checkout-small-element">
        <label>Město</label>
        <input type="text" class="form-control" id="checkout-city" name="mesto" placeholder="Zadejte Vaše město" required />
      </div>
      <div class="form-group checkout-large-element">
        <label>Adresa</label>
        <input type="adress" class="form-control" id="checkout-address" name="adresa" placeholder="Zadejte Vaši adresu" required />
      </div>
      <div class="form-group checkout-btn-container">
        <p>Celková cena: <?php echo $_SESSION['total']; ?> Kč</p>
        <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Objednat nyní" />
      </div>
    </form>
  </div>
</section>

<?php include('layouts/footer.php'); ?>