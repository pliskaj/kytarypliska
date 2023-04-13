<?php
include('layouts/header.php');

if (isset($_GET['product_id'])) {

    $product_id = $_GET['product_id'];
    $product_name = $_GET['product_name'];
} else {

    header('location: products.php');
}



?>


<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Administrační panel</h1>

            </div>



            <h2>Editace obrázků produktu</h2>

            <div class="table-responsive">

                <div class="mx-auto container">
                    <form id="edit-image-form" enctype="multipart/form-data" method="POST" action="update_images.php">
                        <p style="color: red;" class="text-center"><?php if (isset($_GET['error'])) {
                                                                        echo $_GET['error'];
                                                                    } ?></p>
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>" />
                        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>" />


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
                            <input type="submit" class="btn btn-primary" name="add_btn" value="Upravit" />
                        </div>

                    </form>
                </div>
        </main>
    </div>

</div>


<?php include('layouts/footer.php'); ?>