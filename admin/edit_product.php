<?php
include('layouts/header.php');



if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];
    $stmt = $conn->prepare("SELECT * FROM produkty WHERE produkt_id = ?");
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $produkty = $stmt->get_result();
} else if (isset($_POST['edit_btn'])) {

    $product_id = $_POST['product_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $color = $_POST['color'];
    $special = $_POST['special'];
    $category = $_POST['category'];


    $stmt = $conn->prepare("UPDATE produkty SET produkt_jmeno = ?, produkt_popis = ?, produkt_cena = ?, produkt_barva = ?, produkt_spec_nab = ?, produkt_kateg = ? WHERE produkt_id = ?");
    $stmt->bind_param('ssssssi', $title, $description, $price, $color, $special, $category, $product_id);

    if ($stmt->execute()) {
        header('location: products.php?edit_success_message=Produkt byl úspěšně upraven!');
    } else {
        header('location: products.php?edit_error_message=Chyba při úpravě produktu!');
    }
} else {
    header('location: products.php');
    exit;
}
?>


<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Administrační panel</h1>

            </div>



            <h2>Editace produktu</h2>
            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="edit-form" method="POST" action="edit_product.php">
                        <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                                        echo $_GET['error'];
                                                                    } ?></p>
                        <?php foreach ($produkty as $produkt) { ?>


                            <div class="form-group mt-2">

                                <label>Název</label>
                                <input type=" text" class="form-control" id="produkt_jmeno" value="<?php echo $produkt['produkt_jmeno'] ?>" name="title" placeholder="Jméno produktu" required />
                                <input name="product_id" type="hidden" value="<?php echo $produkt['produkt_id'] ?>" />
                            </div>
                            <div class=" form-group mt-2">
                                <label>Popis produktu </label>
                                <input type="text" class="form-control" id="produkt_popis" value="<?php echo $produkt['produkt_popis'] ?>" name="description" placeholder="Zadejte popis produktu" required />
                            </div>
                            <div class="form-group mt-2">
                                <label>Cena produktu </label>
                                <input type="number" class="form-control" id="produkt_cena" value="<?php echo $produkt['produkt_cena'] ?>" name="price" placeholder="Zadejte cenu produktu" required />
                            </div>
                            <div class="form-group mt-2">
                                <label>Barva produktu </label>
                                <input type="text" class="form-control" id="produkt_barva" value="<?php echo $produkt['produkt_barva'] ?>" name="color" placeholder="Zadejte barvu produktu" required />
                            </div>
                            <div class="form-group mt-2">
                                <label>Speciální nabídka </label>
                                <input type="text" class="form-control" id="produkt_barva" value="<?php echo $produkt['produkt_spec_nab'] ?>" name="special" placeholder="Zadejte procentuální nabídku" required />
                            </div>

                            <div class="form-group mt-2">
                                <label> Kategorie produktu</label>
                                <select class="form-select" required name="category">
                                    <option value="akustika">Akustická</option>
                                    <option value="poloakustika">Poloakustická</option>
                                    <option value="basa">Basa</option>
                                    <option value="doplnek">Doplňek</option>
                                </select>
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

<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>


</body>

</html>