<?php


/*

Nezaplaceno
Zaplaceno
Odesláno
Doručeno

*/


include('server/connection.php');
include('layouts/header.php');

if (isset($_POST['order_details_btn']) && isset($_POST['obj_id'])) {

    $obj_id = $_POST['obj_id'];
    $obj_status = $_POST['obj_status'];

    $stmt = $conn->prepare("SELECT * FROM objednavkaprod WHERE obj_id = ?");

    $stmt->bind_param('i', $obj_id);

    $stmt->execute();

    $objednavky_info = $stmt->get_result();

    $celkovaCenaObjednavky  = plnaCenaObjednavky($objednavky_info);
} else {
    header("location: account.php");
    exit;
}

function plnaCenaObjednavky($objednavky_info)
{

    $total = 0;

    foreach ($objednavky_info as $row) {

        $produkt_cena = $row['produkt_cena'];
        $produkt_pocet = $row['produkt_pocet'];

        $total =  $total + ($produkt_cena * $produkt_pocet);
    }

    return $total;
}



?>


<!-- Detaily objednávky -->

<section id="orders" class="orders container my-5 py-3">
    <div class="container mt-5 ">
        <h2 class="font-weight-bold text-center">Detaily objednávky</h2>
        <hr class="mx-auto" />
    </div>

    <table class="mt-5 pt-5 mx-auto">
        <tr>
            <th>Název produktu</th>
            <th>Cena produktu</th>
            <th>Počet</th>

            <?php foreach ($objednavky_info as $row) { ?>
        </tr>
        <tr>
            <td>
                <div class="product-info">
                    <img src="assets/img/<?php echo $row['produkt_fotka']; ?>" />
                    <div>
                        <p class="mt-3"><?php echo $row['produkt_jmeno']; ?></p>
                    </div>
                </div>
            </td>
            <td>
                <span><?php echo $row['produkt_cena']; ?></span>
            </td>
            <td>
                <span><?php echo $row['produkt_pocet']; ?></span>
            </td>
        </tr>
    <?php } ?>
    </table>

    <?php

    if ($obj_status == "Nezaplaceno") { ?>

        <form style="float: right;" method="POST" action="payment.php">
            <input type="hidden" name="total_order_price" value="<?php echo $order_total_price; ?>">
            <input type="hidden" name="obj_status" value="<?php echo $obj_status; ?>">
            <input type="submit" name="order_pay_btn" class="btn btn-primary" value="Zaplatit nyní" />
        </form>




    <?php } ?>
</section>





<?php include('layouts/footer.php'); ?>