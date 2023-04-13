<?php
include('layouts/header.php');

if (isset($_GET['obj_id'])) {

    $obj_id = $_GET['obj_id'];
    $stmt = $conn->prepare("SELECT * FROM objednavky WHERE obj_id = ?");
    $stmt->bind_param('i', $obj_id);
    $stmt->execute();
    $objednavky = $stmt->get_result();
} else if (isset($_POST['edit_btn'])) {

    $obj_id = $_POST['obj_id'];
    $order_status = $_POST['order_status'];

    $stmt = $conn->prepare("UPDATE objednavky SET obj_status = ? WHERE obj_id = ?");
    $stmt->bind_param('si', $order_status, $obj_id);

    if ($stmt->execute()) {
        header('location: dashboard.php?edit_success_message=Objednávka byla upravena!');
    } else {
        header('location: dashboard.php?edit_error_message=Chyba při upravování objednávky!');
    }
}

?>


<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Administrační panel</h1>

            </div>



            <h2>Editace objednávek</h2>

            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="edit-order-form" method="POST" action="edit_order.php">

                        <?php foreach ($objednavky as $objednavka) { ?>
                            <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                                            echo $_GET['error'];
                                                                        } ?></p>


                            <div class="form-group mt-3">

                                <label>ID objednávky</label>
                                <p class="my-4"><?php echo $objednavka['obj_id']; ?></p>
                            </div>
                            <div class="form-group mt-3">

                                <label>Cena objednávky</label>
                                <p class="my-4"><?php echo $objednavka['obj_cena']; ?></p>
                            </div>
                            <input type="hidden" name="obj_id" value="<?php echo $objednavka['obj_id']; ?>">
                            <div class="form-group mt-3">
                                <label>Stav objednávky</label>
                                <select class="form-select" required name="order_status">

                                    <option value="Nezaplaceno" <?php if ($objednavka['obj_status'] == 'Nezaplaceno') {
                                                                    echo "selected";
                                                                } ?>>Nezaplaceno</option>
                                    <option value="Zaplaceno" <?php if ($objednavka['obj_status'] == 'Zaplaceno') {
                                                                    echo "selected";
                                                                } ?>>Zaplaceno</option>
                                    <option value="Zaslano" <?php if ($objednavka['obj_status'] == 'Zasláno') {
                                                                echo "selected";
                                                            } ?>>Zasláno</option>
                                    <option value="Doruceno" <?php if ($objednavka['obj_status'] == 'Doručeno') {
                                                                    echo "selected";
                                                                } ?>>Doručeno</option>
                                </select>
                            </div>
                            <div class="form-group mt-3">

                                <label>Datum zřízení objednávky</label>
                                <p class="my-4"><?php echo $objednavka['obj_datum']; ?></p>
                            </div>
                            <div class="form-group mt-3">
                                <input type="submit" class="btn btn-primary" name="edit_btn" value="Upravit produkt" />
                            </div>
                        <?php } ?>
                    </form>
                </div>


            </div>
        </main>
    </div>

</div>

<?php include('layouts/footer.php'); ?>