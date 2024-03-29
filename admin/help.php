<?php include('layouts/header.php');


if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
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


            <div class="container">

                Emailová adresa : <span>info@kytary-pliska.cz</span>
                <hr>
                Telefonní číslo : <span>+420 727 911 844</span>
                <hr>
                Adresa : <span>Ústí nad Labem, Olšinky 510, 403 22</span>
                <hr>
            </div>


    </div>
</div>

<?php include('layouts/footer.php'); ?>