<?php
session_start();
include('layouts/header.php');

if (isset($_POST['order_pay_btn'])) {

    $obj_status = $_POST['obj_status'];
    $celkovaCenaObjednavky  = $_POST['celkovaCenaObjednavky'];
}
?>

<!--Nákup-->
<section class="my-5 py-5">
    <div class="container text-center mt-3 pt-5">
        <h2 class="form-weight-bold">Zaplatit</h2>
        <hr class="mx-auto" />
    </div>

    <div class="mx-auto container text-center">


        <?php if (isset($_POST['obj_status']) && $_POST['obj_status'] == "Nezaplaceno") { ?>
            <?php $mnozstvi = strval($celkovaCenaObjednavky); ?>
            <?php $obj_id = $_POST['obj_id']; ?>
            <p>Celkem k uhrazení: <?php echo $celkovaCenaObjednavky; ?> Kč</p>
            <!-- <input class="btn btn-primary" type="submit" value="Zaplatit nyní" /> -->
            <div id="paypal-button-container"></div>


        <?php } else if (isset($_SESSION['total']) && $_SESSION['total'] != 0) { ?>
            <?php $mnozstvi = strval($_SESSION['total']); ?>
            <?php $obj_id = $_SESSION['obj_id']; ?>
            <p>Celkem k uhrazení: <?php echo $_SESSION['total']; ?> Kč</p>
            <!-- <input class="btn btn-primary" type="submit" value="Zaplatit nyní" /> -->
            <div id="paypal-button-container"></div>




        <?php } else { ?>

            <p>Nemáte zřízenu, žádnou objednávku</p>

        <?php } ?>




    </div>
</section>

<!-- TED PRICHAZI PLATEBNI BRANA :) -->

<!-- Replace "test" with your own sandbox Business account app client ID -->

<script src="https://www.paypal.com/sdk/js?client-id=AcYrKfIS008_vFxy6nGLxMimImMkhmAv32O8Ec2Cxh71qTaqOYwxL4Jmz7X6S6yAy03PDXqGFME5GkmE&currency=CZK"></script>

<!-- Set up a container element for the button -->

<script>
    paypal.Buttons({

        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: "<?php echo $mnozstvi; ?>"
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                console.log(details);
                var transakce_id = details.id;
                alert('Transaction completed by ' + details.payer.name.given_name + '!');
                window.location.href = 'server/payment_complete.php?transakce_id=' + transakce_id + '&obj_id=<?php echo $obj_id; ?>';
                // Redirect to thank you page
            });
        }
    }).render('#paypal-button-container');
</script>a

<?php
include('layouts/footer.php');
?>