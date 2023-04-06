<?php

session_start();

include('layouts/header.php');

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
  // header("location: index.php");
}

function PlnaCenaProduktu()
{

  $total = 0;

  foreach ($_SESSION['cart'] as $key => $value) {



    $product = $_SESSION['cart'][$key];

    $cena = $product['produkt_cena'];
    $pocet = $product['produkt_pocet'];

    $total = $total + ($cena * $pocet);
  }

  $_SESSION['total'] = $total;
}




?>



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
            <input type="number" name="produkt_pocet" min="1" value="<?php echo $value['produkt_pocet']; ?>" />
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
      <!--<tr>
          <td>Mezisoučet</td>
          <td>2000 Kč</td>
        </tr> -->
      <td>Celková cena</td>
      <td><?php echo $_SESSION['total']; ?> Kč</td>
    </table>
  </div>

  <div class="checkout-container">
    <form method="POST" action="checkout.php">


      <input type="submit" class="btn checkout-btn" value="Objednat" name="checkout">
    </form>
  </div>
</section>

<!--Footer-->

<?php include('layouts/footer.php'); ?>