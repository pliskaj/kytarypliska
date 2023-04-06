<?php
session_start();
include('layouts/header.php');

if (isset($_POST['order_pay_btn'])) {

    $obj_status = $_POST['obj_status'];
    $order_total_price = $_POST['total_order_price'];
}
?>

<!--Nákup-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Zaplatit</h2>
        <hr class="mx-auto" />
    </div>

    <div class="mx-auto container text-center">

    <?php if(isset($_SESSION['cart']) && $_SESSION != 0) { ?>
<p> Celkem k úhradě: <?php  echo $_SESSION['total']; ?> Kč </p>
<input class="btn btn-primary" type="submit" value="Zaplatit" />
 <?php } else if(isset($_POST['obj_status']) && $_POST['obj_status'] == "Nezaplaceno"){ ?>
                                  
        

        
        <?php if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <input class="btn btn-primary" type="submit" value="Zaplatit" />
        <?php } else { ?>
            <p>Ještě stále máte prázdný košík!</p>
        <?php } ?>

        <p><?php if (isset($_POST['obj_status'])) {
                echo $_POST['obj_status'];
            } ?></p>
        <?php if (isset($_POST['obj_status']) && $_POST['obj_status'] == "Nezaplaceno") { ?>
            <input class="btn btn-primary" type="submit" value="Zaplatit" />
        <?php } ?>
    </div>
</section>

<?php

include('layouts/footer.php');


?>