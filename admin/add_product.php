<?php
include('layouts/header.php');

?>


<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Administrační panel</h1>

            </div>



            <h2>Přidat produkt</h2>

            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="create-form" enctype="multipart/form-data" method="POST" action="create_product.php">
                        <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                                        echo $_GET['error'];
                                                                    } ?></p>



                        <div class="form-group mt-2">

                            <label>Název</label>
                            <input type=" text" class="form-control" id="produkt_jmeno" name="title" placeholder="Jméno produktu" required />

                        </div>
                        <div class=" form-group mt-2">
                            <label>Popis produktu </label>
                            <input type="text" class="form-control" id="produkt_popis" name="description" placeholder="Zadejte popis produktu" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Cena produktu </label>
                            <input type="number" class="form-control" id="produkt_cena" name="price" placeholder="Zadejte cenu produktu" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Barva produktu </label>
                            <input type="text" class="form-control" id="produkt_barva" name="color" placeholder="Zadejte barvu produktu" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Speciální nabídka </label>
                            <input type="number" class="form-control" id="produkt_barva" name="special" placeholder="Zadejte procentuální nabídku" required />
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

                        <div class="form-group mt-2">
                            <label>Fotka 1 </label>
                            <input type="file" class="form-control" id="image1" name="image1" placeholder="Přidat fotku 1" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Fotka 2 </label>
                            <input type="file" class="form-control" id="image2" name="image2" placeholder="Přidat fotku 2" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Fotka 3</label>
                            <input type="file" class="form-control" id="image3" name="image3" placeholder="Přidat fotku 3" required />
                        </div>
                        <div class="form-group mt-2">
                            <label>Fotka 4 </label>
                            <input type="file" class="form-control" id="image4" name="image4" placeholder="Přidat fotku 4" required />
                        </div>
                        <div class="form-group mt-3">
                            <input type="submit" class="btn btn-primary" name="add_btn" value="Přidat produkt" />
                        </div>

                    </form>
                </div>
        </main>
    </div>

</div>
<?php include('layouts/footer.php'); ?>

