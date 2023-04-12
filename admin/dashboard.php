<?php
include('layouts/header.php'); ?>

<?php

if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

if (isset($_SESSION['logged_in'])) {

    $uziv_id = $_SESSION['uziv_id'];
    $stmt = $conn->prepare("SELECT * FROM objednavky WHERE uziv_id = ?");

    $stmt->bind_param('i', $_SESSION['uziv_id']);

    $stmt->execute();

    $objednavky = $stmt->get_result();
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

$stmt2 = $conn->prepare("SELECT * FROM objednavky LIMIT $offset, $per_page");
$stmt2->execute();
$objednavky = $stmt2->get_result();

?>

<div class="container-fluid">
    <div class="row">

        <?php include('layouts/sidebar.php'); ?>


        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>

            </div>



            <h2>Objednávky</h2>
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>ID objednávky</th>
                            <th>Status objednávky</th>
                            <th>ID uživatele</th>
                            <th>Uživatelské tel. číslo</th>
                            <th>Adresa doručení</th>
                            <th>Editovat</th>
                            <th>Smazat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($objednavky as $objednavka) { ?>
                            <tr>
                                <td><?php echo $objednavka['obj_id'] ?></td>
                                <td><?php echo $objednavka['obj_status'] ?></td>
                                <td><?php echo $objednavka['uziv_id'] ?></td>
                                <td><?php echo $objednavka['uziv_tel'] ?></td>
                                <td><?php echo $objednavka['uziv_adresa'] ?></td>
                                <td><a href="edit_order.php?obj_id=<?php echo $objednavka['obj_id']; ?>" class="btn btn-primary">Editovat</a></td>
                                <td><a href="delete_order.php?obj_id=<?php echo $objednavka['obj_id']; ?>" class="btn btn-danger">Smazat</a></td>
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