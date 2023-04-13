<?php
include('layouts/header.php'); ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}


if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {

    //pokud uzivatel neni na zadne strance tak se mu zobrazi prvni stranka
    $page_no = 1;
}


//vrat pocet vsech produktu
$stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM objednavky");
$stmt1->execute();
$stmt1->bind_result($total_records);
$stmt1->store_result();
$stmt1->fetch();


//pocet produktu na strance
$per_page = 5;

$offset = ($page_no - 1) * $per_page;

$previous_page = $page_no - 1;
$next_page = $page_no + 1;

$adjecents = "2";

$total_no_of_pages = ceil($total_records / $per_page);

//dej mi vsechny produkty

$stmt2 = $conn->prepare("SELECT * FROM produkty LIMIT $offset, $per_page");
$stmt2->execute();
$produkty = $stmt2->get_result();

?>

<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Administrační panel</h1>

            </div>

            <h2>Produkty</h2>
            <?php if (isset($_GET['edit_success_message'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['edit_success_message']; ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['edit_error_message'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['edit_error_message']; ?>
                </div>
            <?php } ?>


            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID produktu</th>
                            <th>Fotka produktu</th>
                            <th>Jméno produktu</th>
                            <th>Cena produktu</th>
                            <th>Nabídka produktu</th>
                            <th>Kategorie produktu</th>
                            <th>Barva produktu</th>
                            <th>Upravit obrázky</th>
                            <th>Editovat</th>
                            <th>Smazat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produkty as $produkt) { ?>
                            <tr>
                                <td><?php echo $produkt['produkt_id'] ?></td>
                                <td><img src="<?php echo "../assets/img/" . $produkt['produkt_fotka']; ?>" style="width: 70px; height:78px;">
                                </td>
                                <td><?php echo $produkt['produkt_jmeno']; ?></td>
                                <td><?php echo $produkt['produkt_cena']; ?> Kč</td>
                                <td><?php echo $produkt['produkt_spec_nab']; ?> %</td>
                                <td><?php echo $produkt['produkt_kateg']; ?></td>
                                <td><?php echo $produkt['produkt_barva']; ?></td>
                                <td><a class="btn btn-warning" href="<?php echo "edit_images.php?product_id=" . $produkt['produkt_id'] . "&product_name=" . $produkt['produkt_jmeno']; ?>">Upravit fotky</a></td>
                                <td><a href=" edit_product.php?product_id=<?php echo $produkt['produkt_id']; ?>" class="btn btn-primary">Editovat</a></td>
                                <td><a href="delete_product.php?product_id=<?php echo $produkt['produkt_id']; ?>" class="btn btn-danger">Smazat</a></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <nav aria-label="Paginace">
                    <ul class="pagination mt-5">
                        <li class="page-item">
                            <a class="page-link <?php if ($page_no <= 1) {
                                                    echo 'disabled';
                                                } ?>" href="<?php if ($page_no <= 1) {
                                                                echo '#';
                                                            } else {
                                                                echo "?page_no" . $page_no - 1;
                                                            } ?>">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page_no=1">1</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page_no=2">2</a>
                        </li>

                        <?php if ($page_no >= 3) { ?>
                            <li class="page-item">
                                <a class="page-link" href="#">...</a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a>
                            </li>
                        <?php } ?>
                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                                            echo '#';
                                                        } else {
                                                            echo "?page_no=" . $page_no + 1;
                                                        } ?>

          } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>

</div>

<?php include('layouts/footer.php'); ?>